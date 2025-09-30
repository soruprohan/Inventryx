<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\WareHouse;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    public function AllPurchase()
    {
        $allData = Purchase::OrderBy('id', 'DESC')->get();
        return view('admin.backend.purchase.all_purchase', compact('allData'));
    }

    //End Method
    public function AddPurchase()
    {
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.purchase.add_purchase', compact('suppliers', 'warehouses'));
    }

    public function PurchaseProductSearch(Request $request)
    {
        $query = $request->input('query');
        $warehouse_id = $request->input('warehouse_id');
        $products = Product::where(function ($q) use ($query, $warehouse_id) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('code', 'LIKE', "%{$query}%");
        })
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                $q->where('warehouse_id', $warehouse_id);
            })
            ->select('id', 'name', 'code', 'price', 'product_qty')
            ->limit(10)
            ->get();

        return response()->json($products);
    }

    //End Method
    public function StorePurchase(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            'supplier_id' => 'required',
        ]);

        try {

            DB::beginTransaction();
            $grandTotal = 0;

            $purchase = Purchase::create([
                'date' => $request->date,
                'supplier_id' => $request->supplier_id,
                'warehouse_id' => $request->warehouse_id,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'status' => $request->status,
                'note' => $request->note,
                'grand_total' => 0
            ]);

            ///Store Purchase Item and Update Product Stock

            foreach ($request->products as $productData) {
                $product = Product::find($productData['id']);
                $netUnitCost = $productData['net_unit_cost'] ?? $product->price;

                if (($netUnitCost == null)) {
                    throw new \Exception("Net unit cost is missing for product ID: " . $productData['id']);
                }

                $subtotal = ($netUnitCost * $productData['quantity']) - ($productData['discount'] ?? 0);
                $grandTotal += $subtotal;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productData['id'],
                    'quantity' => $productData['quantity'],
                    'net_unit_cost' => $netUnitCost,
                    'stock' => $product->product_qty + $productData['quantity'],
                    'quantity' => $productData['quantity'],
                    'discount' => $productData['discount'] ?? 0,
                    'subtotal' => $subtotal
                ]);
                // Update Product Stock
                $product->increment('product_qty', $productData['quantity']);
            }

            // Update Grand Total in Purchase
            $purchase->update(['grand_total' => $grandTotal + ($request->shipping ?? 0) - ($request->discount ?? 0)]);
            DB::commit();
            $notification = array(
                'message' => 'Purchase Stored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to store purchase: ' . $e->getMessage()], 500);
        }
    }

    //End Method

    public function EditPurchase($id)
    {
        $editData = Purchase::with('purchaseItems.product')->findOrFail($id);
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.purchase.edit_purchase', compact('editData', 'suppliers', 'warehouses'));
    }

    //End Method

    public function UpdatePurchase(Request $request, $id)
    {

        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $purchase = Purchase::findOrFail($id);

            $purchase->update([
                'date' => $request->date,
                'warehouse_id' => $request->warehouse_id,
                'supplier_id' => $request->supplier_id,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'status' => $request->status,
                'note' => $request->note,
                'grand_total' => $request->grand_total,
            ]);

            /// Get Old Purchase Items 
            $oldPurchaseItems = PurchaseItem::where('purchase_id', $purchase->id)->get();

            /// Loop for old purchase items and decrement product qty
            foreach ($oldPurchaseItems as $oldItem) {
                $product = Product::find($oldItem->product_id);
                if ($product) {
                    $product->decrement('product_qty', $oldItem->quantity);
                    // Decrement old quantity 
                }
            }

            /// Delete old Purchase Items 
            PurchaseItem::where('purchase_id', $purchase->id)->delete();

            // loop for new products and insert new purchase items

            foreach ($request->products as $product_id => $productData) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product_id,
                    'net_unit_cost' => $productData['net_unit_cost'],
                    'stock' => $productData['stock'],
                    'quantity' => $productData['quantity'],
                    'discount' => $productData['discount'] ?? 0,
                    'subtotal' => $productData['subtotal'],
                ]);

                /// Update product stock by incremeting new quantity 
                $product = Product::find($product_id);
                if ($product) {
                    $product->increment('product_qty', $productData['quantity']);
                    // Increment new quantity
                }
            }

            DB::commit();

            $notification = array(
                'message' => 'Purchase Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // End Method 

    public function DetailsPurchase($id)
    {
        $purchase = Purchase::with('purchaseItems.product')->findOrFail($id);
        return view('admin.backend.purchase.details_purchase', compact('purchase'));
    }
    //End Method

    public function InvoicePurchase($id)
    {
        $purchase = Purchase::with('purchaseItems.product')->findOrFail($id);

        $pdf = Pdf::loadView('admin.backend.purchase.invoice_purchase', compact('purchase'));
        return $pdf->download('purchase_invoice_' . $id . '.pdf');
    }
    //End Method

    public function DeletePurchase($id)
    {
        try {
            DB::beginTransaction();
            $purchase = Purchase::findOrFail($id);
            $purchaseItems = PurchaseItem::where('purchase_id', $id)->get();

            // Decrement product stock based on purchase items
            foreach ($purchaseItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('product_qty', $item->quantity);
                }
            }

            // Delete purchase items
            PurchaseItem::where('purchase_id', $id)->delete();
            // Delete purchase
            $purchase->delete();
            DB::commit();

            $notification = array(
                'message' => 'Purchase Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete purchase: ' . $e->getMessage()], 500);
        }
    }
    //End Method
}
