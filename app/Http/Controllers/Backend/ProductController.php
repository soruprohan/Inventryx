<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function AllCategory()
    {
        $category = ProductCategory::latest()->get();
        return view('admin.backend.category.all_category', compact('category'));
    }

    //End Method

    public function StoreCategory(Request $request)
    {
        ProductCategory::create([
           'category_name' => $request->category_name,
           'category_slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //End Method

    public function EditCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        return response()->json($category);
    }

    //End Method

    public function UpdateCategory(Request $request)
    {
        ProductCategory::findOrFail($request->cat_id)->update([
           'category_name' => $request->category_name,
           'category_slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //End Method

    public function DeleteCategory($id)
    {
        ProductCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //End Method
}
