<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Customer;
use App\Models\WareHouse;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Transfer;
use App\Models\TransferItem;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransferController extends Controller
{
    public function AllTransfer()
    {
        $allData = Transfer::with(['transferItems.product', 'fromWarehouse', 'toWarehouse'])->orderBy('id', 'desc')->get();
        return view('admin.backend.transfer.all_transfer', compact('allData'));
    }
    // End Method 

    public function AddTransfer()
    {
        $warehouses = WareHouse::all();
        return view('admin.backend.transfer.add_transfer', compact('warehouses'));
    }
    // End Method 


    public function StoreTransfer(Request $request)
    {

        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $transfer = Transfer::create([
                'date' => $request->date,
                'from_warehouse_id' => $request->from_warehouse_id,
                'to_warehouse_id' => $request->to_warehouse_id,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'status' => $request->status,
                'note' => $request->note,
                'grand_total' => 0,

            ]);

            /// Store Transfer Items & Update Stock 
            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['id']);
                $netUnitCost = $productData['net_unit_cost'] ?? $product->price;
                $subtotal = ($netUnitCost * $productData['quantity']) - ($productData['discount'] ?? 0);
                
                TransferItem::create([
                    'transfer_id' => $transfer->id,
                    'product_id' => $productData['id'],
                    'net_unit_cost' => $netUnitCost,
                    'stock' => $product->product_qty,
                    'quantity' => $productData['quantity'] ?? 0,
                    'discount' => $productData['discount'] ?? 0,
                    'subtotal' => $subtotal,
                ]);

                // Decrement stock from 'from_warehouse'
                Product::where('id', $productData['id'])
                        ->where('warehouse_id', $request->from_warehouse_id) // Ensure stock is decremented from the correct warehouse
                        ->decrement('product_qty', $productData['quantity'] ?? 0);

                // If the product exists in the 'to_warehouse', increment stock

                $existingProduct= Product::where('id', $productData['id'])
                        ->where('warehouse_id', $request->to_warehouse_id)
                        ->first();
                if ($existingProduct) {
                    $existingProduct->increment('product_qty', $productData['quantity'] ?? 0);
                } else {
                    // If the product doesn't exist in the 'to_warehouse', create a new record
                    $newProduct = Product::create([
                        'name' => $product->name,
                        'code' => $product->code,
                        'category_id' => $product->category_id,
                        'brand_id' => $product->brand_id,
                        'warehouse_id' => $request->to_warehouse_id,
                        'supplier_id' => $product->supplier_id,
                        'price' => $product->price,
                        'stock_alert' => $product->stock_alert,
                        'note' => $product->note,
                        'product_qty' => $productData['quantity'] ?? 0,
                        'status' => $product->status,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Copy product images from original product
                    $productImages = ProductImage::where('product_id', $product->id)->get();
                    foreach ($productImages as $originalImage) {
                        // Create new image record for the new product
                        ProductImage::create([
                            'product_id' => $newProduct->id,
                            'image' => $originalImage->image // Reference the same image file
                        ]);
                    }
                }
            }

            DB::commit();

            $notification = array(
                'message' => 'Transfer Completed Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.transfer')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // End Method 

    // public function EditSaleReturn($id)
    // {
    //     $editData = SaleReturn::with('saleReturnItems.product')->findOrFail($id);
    //     $customers = Customer::all();
    //     $warehouses = WareHouse::all();
    //     return view('admin.backend.return_sale.edit_return_sale', compact('editData', 'customers', 'warehouses'));
    // }

    // //End Method

    // public function UpdateSaleReturn(Request $request, $id)
    // {

    //     $request->validate([
    //         'date' => 'required|date',
    //         'status' => 'required',
    //     ]);

    //     DB::beginTransaction();

    //     try {

    //         $sale = SaleReturn::findOrFail($id);

    //         $sale->update([
    //             'date' => $request->date,
    //             'warehouse_id' => $request->warehouse_id,
    //             'customer_id' => $request->customer_id,
    //             'discount' => $request->discount ?? 0,
    //             'shipping' => $request->shipping ?? 0,
    //             'status' => $request->status,
    //             'note' => $request->note,
    //             'grand_total' => $request->grand_total,
    //             'paid_amount' => $request->paid_amount,
    //             'due_amount' => $request->due_amount,
    //             'full_paid' => $request->full_paid,
    //         ]);

    //         /// Get Old Sale Return Items 
    //         $oldSaleItems = SaleReturnItem::where('sale_return_id', $sale->id)->get();

    //         /// Loop for old sale return items and decrement product qty
    //         foreach ($oldSaleItems as $oldItem) {
    //             $product = Product::find($oldItem->product_id);
    //             if ($product) {
    //                 $product->decrement('product_qty', $oldItem->quantity);
    //                 // Increment old quantity
    //             }
    //         }

    //         /// Delete old Sale Return Items 
    //         SaleReturnItem::where('sale_return_id', $sale->id)->delete();

    //         // loop for new products and insert new sale return items

    //         foreach ($request->products as $product_id => $productData) {
    //             SaleReturnItem::create([
    //                 'sale_return_id' => $sale->id,
    //                 'product_id' => $product_id,
    //                 'net_unit_cost' => $productData['net_unit_cost'],
    //                 'stock' => $productData['stock'],
    //                 'quantity' => $productData['quantity'],
    //                 'discount' => $productData['discount'] ?? 0,
    //                 'subtotal' => $productData['subtotal'],
    //             ]);

    //             /// Update product stock by incrementing new quantity
    //             $product = Product::find($product_id);
    //             if ($product) {
    //                 $product->increment('product_qty', $productData['quantity']);
    //                 // Increment new quantity
    //             }
    //         }

    //         DB::commit();

    //         $notification = array(
    //             'message' => 'Sale Return Updated Successfully',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->route('all.sale.return')->with($notification);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    // // End Method

    // public function DetailsSaleReturn($id)
    // {
    //     $sale = SaleReturn::with('saleReturnItems.product')->findOrFail($id);
    //     return view('admin.backend.return_sale.details_return_sale', compact('sale'));
    // }
    // //End Method

    // public function InvoiceSaleReturn($id)
    // {
    //     $sale = SaleReturn::with('saleReturnItems.product')->findOrFail($id);

    //     $pdf = Pdf::loadView('admin.backend.return_sale.invoice_return_sale', compact('sale'));
    //     return $pdf->download('return_sale_invoice_' . $id . '.pdf');
    // }
    // //End Method

    // public function DeleteSaleReturn($id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $sale = SaleReturn::findOrFail($id);
    //         $saleItems = SaleReturnItem::where('sale_return_id', $id)->get();

    //         // Decrement product stock based on sale return items
    //         foreach ($saleItems as $item) {
    //             $product = Product::find($item->product_id);
    //             if ($product) {
    //                 $product->decrement('product_qty', $item->quantity);
    //             }
    //         }

    //         // Delete sale return items
    //         SaleReturnItem::where('sale_return_id', $id)->delete();
    //         // Delete sale return
    //         $sale->delete();
    //         DB::commit();

    //         $notification = array(
    //             'message' => 'Sale Return Deleted Successfully',
    //             'alert-type' => 'success'
    //         );

    //         return redirect()->back()->with($notification);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Failed to delete purchase: ' . $e->getMessage()], 500);
    //     }
    // }
    // //End Method
}
