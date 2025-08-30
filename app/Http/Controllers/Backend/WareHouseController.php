<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WareHouse;

class WareHouseController extends Controller
{
    public function AllWareHouse()
    {
        $warehouse = WareHouse::latest()->get();
        return view('admin.backend.warehouse.all_warehouse', compact('warehouse'));
    }

    //End Method

    public function AddWareHouse()
    {
        return view('admin.backend.warehouse.add_warehouse');
    }
    //End Method 

    public function StoreWareHouse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ware_houses,email|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
        ]);

        WareHouse::create([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'phone' => $validated['phone'],
           'city' => $validated['city'],
        ]);

        $notification = array(
            'message' => 'Warehouse Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.warehouse')->with($notification);
    }
    //End Method

    public function EditWareHouse($id)
    {
        $warehouse = WareHouse::findOrFail($id);
        return view('admin.backend.warehouse.edit_warehouse', compact('warehouse'));
    }

    //End Method
    public function UpdateWareHouse(Request $request)
    {
        $ware_id = $request->id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ware_houses,email|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
        ]);

        WareHouse::find($ware_id)->update([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'phone' => $validated['phone'],
           'city' => $validated['city'],
        ]);

        $notification = array(
            'message' => 'Warehouse Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.warehouse')->with($notification);
    }
    //End Method

    public function DeleteWareHouse($id)
    {
        WareHouse::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Warehouse Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
