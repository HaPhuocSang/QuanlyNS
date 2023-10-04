<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Import_product;
use App\Models\Book;
use Carbon\Carbon;
use App\Models\Warehouse;

class ImportproductController extends Controller
{
    //
    public function getImportproductList()
    {
        $importproducts = Import_product::orderBy('created_at', 'desc')->get();
        return view('admin.importproducts.admin-importproduct', compact('importproducts'));
    }
    public function getImportproductAdd()
    {
        $books = Book::all();
        return view('admin.importproducts.admin-add-importproduct', compact('books'));
    }
    public function postImportproductAdd(Request $request)
    {
        $this->validate($request, [
            'id_book' => 'required',
            'quantity' => 'required',
        ], [
            'id_book.required' => 'Bạn chưa nhập tên sách',
            'quantity.required' => 'Bạn chưa nhập số lượng',
        ]);

        $currentTime = Carbon::now();
        $importproducts = new Import_product();
        $importproducts->id_book = $request->id_book;
        $importproducts->quantity = $request->quantity;
        $importproducts->date_added = $currentTime;
        $importproducts->save();

        // Tìm bản ghi Warehouse dựa trên id_book
        $warehouse = Warehouse::where('id_book', $request->id_book)->first();

        // Kiểm tra xem Warehouse có tồn tại không
        if ($warehouse) {
            // Cộng thêm quantity mới vào tổng quantity hiện tại
            $warehouse->quantity += $request->quantity;
            $warehouse->update_date = $currentTime;
            $warehouse->save();
        }

        return redirect()->route('admin.getImportproductList')->with('success', 'Bạn đã thêm thành công!');
    }
    public function deletetImportproduct(string $id)
    {
        $importproduct = Import_product::find($id);
        $importproduct->delete();
        return redirect()->route('admin.getImportproductList')->with('success', 'Bạn đã xóa thành công!');
    }
}
