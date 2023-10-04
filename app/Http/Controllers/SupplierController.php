<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //
    public function getSupplierList(){
        $suppliers=Supplier::orderBy('created_at', 'desc')->get();
        return view('admin.suppliers.admin-supplier',compact('suppliers'));
    }
    public function getSupplierAdd(){
        return view('admin.suppliers.admin-add-supplier');
    }
    public function postSupplierAdd(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:suppliers,name',
            'address'=>'required',
            'phone_number'=>'required|numeric',

        ],[
            'name.required'=>'Bạn chưa nhập tên nhà cung cấp',
            'name.unique'=>'Nhà cung cấp đã tồn tại',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'phone_number.required'=>'Bạn chưa nhập số điện thoại',
            'phone_number.numeric'=>'Số điện thoại phải là kiểu số',
        ]);
        $supplier=new Supplier();
        $supplier->name=$request->name;
        $supplier->address=$request->address;
        $supplier->phone_number=$request->phone_number;
        $supplier->save();
        return redirect()->route('admin.getSupplierList')->with('success','Bạn đã thêm thành công!');  
    }
    public function getSupplierEdit(string $id){
        $supplier=Supplier::where('id',$id)->get();
        return view('admin.suppliers.admin-edit-supplier',array('supplier'=>$supplier));
    }
    public function postSupplierEdit(Request $request,string $id){
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'phone_number'=>'required',

        ],[
            'name.required'=>'Bạn chưa nhập tên nhà cung cấp',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'phone_number.required'=>'Bạn chưa nhập số điện thoại',
        ]);
        $supplier=Supplier::find($id);
        $supplier->name=$request->name;
        $supplier->address=$request->address;
        $supplier->phone_number=$request->phone_number;
        $supplier->save();
        return redirect()->route('admin.getSupplierList')->with('success','Bạn đã sửa thành công!');  
    }
    public function deletetSupplier(string $id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('admin.getSupplierList')->with('success','Bạn đã xóa thành công!');
    }
    public function search(Request $request)
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        if ($search) {
            $results = Supplier::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $results = [];
        }
        return view('admin.suppliers.admin-supplier', compact('suppliers','results', 'search'));
    }
}
