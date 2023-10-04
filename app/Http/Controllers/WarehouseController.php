<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Book;
use Carbon\Carbon;


class WarehouseController extends Controller
{
    //
    public function getWarehouseList()
    {
        $warehouses = Warehouse::orderBy('created_at', 'desc')->get();
        return view('admin.warehouses.admin-warehouse', compact('warehouses'));
    }
    public function getWarehouseAdd()
    {
        $books = Book::all();
        return view('admin.warehouses.admin-add-warehouse', compact('books'));
    }
    public function postWarehouseAdd(Request $request)
    {
        $this->validate($request, [
            'id_book' => 'required|unique:warehouses',
            'quantity' => 'required',
        ], [
            'id_book.required' => 'Bạn chưa nhập tên sách',
            'id_book.unique' => 'Sách này đã tồn tại',
            'quantity.required' => 'Bạn chưa nhập số lượng',
        ]);

        $currentTime = Carbon::now();
        $warehouses = new Warehouse();
        $warehouses->id_book = $request->id_book;
        $warehouses->quantity = $request->quantity;
        $warehouses->update_date = $currentTime;
        $warehouses->save();

        return redirect()->route('admin.getWarehouseList')->with('success', 'Bạn đã thêm thành công!');
    }
    public function getWarehouseEdit(string $id)
    {
        $warehouse = Warehouse::where('id', $id)->get();
        $books = Book::all();
        return view('admin.warehouses.admin-edit-warehouse', array('warehouse' => $warehouse), compact('books'));
    }
    public function postWarehouseEdit(Request $request, string $id)
    {
        $this->validate($request, [
            'quantity' => 'required',
        ], [
            'quantity.required' => 'Bạn chưa nhập số lượng',
        ]);
        $warehouse = Warehouse::find($id);
        $warehouse->quantity = $request->quantity;
        $warehouse->save();
        return redirect()->route('admin.getWarehouseList')->with('success', 'Bạn đã sửa thành công!');
    }
    public function deletetWarehouse(string $id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        return redirect()->route('admin.getWarehouseList')->with('success', 'Bạn đã xóa thành công!');
    }
}
