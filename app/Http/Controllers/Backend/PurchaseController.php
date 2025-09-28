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
class PurchaseController extends Controller
{
    public function AllPurchase()
    {
        $allData = Purchase::OrderBy('id','DESC')->get();
        return view('admin.backend.purchase.all_purchase', compact('allData'));
    }

    //End Method
    public function AddPurchase()
    {
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.purchase.add_purchase', compact('suppliers','warehouses'));
    }

    public function PurchaseProductSearch(Request $request)
    {
       $query = $request->input('query');
       $warehouse_id = $request->input('warehouse_id');
       $products = Product::where(function($q) use ($query, $warehouse_id) {
               $q->where('name', 'LIKE', "%{$query}%")
                 ->orWhere('code', 'LIKE', "%{$query}%");
           })
            ->when($warehouse_id, function($q) use ($warehouse_id) {
                $q->where('warehouse_id', $warehouse_id);
            })
            ->select('id', 'name', 'code', 'price', 'product_qty')
            ->limit(10)
            ->get();

       return response()->json($products);
    }

    //End Method
}
