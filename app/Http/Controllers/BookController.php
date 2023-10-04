<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Book;
use App\Models\Author;
use App\Models\Banner;
use App\Models\Type_book;
use App\Models\Supplier;

class BookController extends Controller
{
    //
    public function getBookList()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('admin.books.admin-book', compact('books'));
    }
    public function getBookAdd()
    {
        $authors = Author::All();
        $typebooks = Type_book::All();
        $suppliers = Supplier::All();
        return view('admin.books.admin-add-book', compact('authors', 'typebooks', 'suppliers'));
    }
    public function postBookAdd(Request $request)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'name' => 'required|unique:books,name',
                'description' => 'required',
                'unit_price' => 'required|numeric',
                'promotion_price' => 'required|numeric',
            ], [
                'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'name.required' => 'Bạn chưa nhập tên sách',
                'name.unique' => 'Tên sách đã tồn tại',
                'description.required' => 'Bạn chưa nhập mô tả',
                'unit_price.required' => 'Bạn chưa nhập giá tiền',
                'unit_price.numeric' => 'Giá tiền phải là kiểu số',
                'promotion_price.required' => 'Bạn chưa nhập giá giảm',
                'promotion_price.numeric' => 'Giá giảm phải là kiểu số',
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/HCI/image/books'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        } else {
            $this->validate($request, [
                'name' => 'required|unique:books,name',
                'description' => 'required',
                'unit_price' => 'required|numeric',
                'promotion_price' => 'required|numeric',
            ], [
                'name.required' => 'Bạn chưa nhập tên sách',
                'name.unique' => 'Tên sách đã tồn tại',
                'description.required' => 'Bạn chưa nhập mô tả',
                'unit_price.required' => 'Bạn chưa nhập giá tiền',
                'unit_price.numeric' => 'Giá tiền phải là kiểu số',
                'promotion_price.required' => 'Bạn chưa nhập giá giảm',
                'promotion_price.numeric' => 'Giá giảm phải là kiểu số',
            ]);
        }
        $book = new Book();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->image = $name;
        $book->id_type = $request->id_type;
        $book->id_supplier = $request->id_supplier;
        $book->id_author = $request->id_author;
        $book->unit_price = $request->unit_price;
        $book->promotion_price = $request->promotion_price;
        $book->save();
        return redirect()->route('admin.getBookList')->with('success', 'Bạn đã thêm thành công!');
    }
    public function getBookEdit(string $id)
    {
        $book = Book::where('id', $id)->get();
        $authors = Author::All();
        $typebooks = Type_book::All();
        $suppliers = Supplier::All();
        return view('admin.books.admin-edit-book', array('book' => $book), compact('authors', 'typebooks', 'suppliers'));
    }
    public function postBookEdit(Request $request, string $id)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'name' => 'required',
                'description' => 'required',
                'unit_price' => 'required|numeric',
                'promotion_price' => 'required|numeric',
            ], [
                'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'name.required' => 'Bạn chưa nhập tên sách',
                'description.required' => 'Bạn chưa nhập mô tả',
                'unit_price.required' => 'Bạn chưa nhập giá tiền',
                'unit_price.numeric' => 'Giá tiền phải là kiểu số',
                'promotion_price.required' => 'Bạn chưa nhập giá giảm',
                'promotion_price.numeric' => 'Giá giảm phải là kiểu số',
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/HCI/image/books'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        } else {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'unit_price' => 'required|numeric',
                'promotion_price' => 'required|numeric',
            ], [
                'name.required' => 'Bạn chưa nhập tên sách',
                'description.required' => 'Bạn chưa nhập mô tả',
                'unit_price.required' => 'Bạn chưa nhập giá tiền',
                'unit_price.numeric' => 'Giá tiền phải là kiểu số',
                'promotion_price.required' => 'Bạn chưa nhập giá giảm',
                'promotion_price.numeric' => 'Giá giảm phải là kiểu số',
            ]);
        }
        $book = Book::find($id);
        $book->name = $request->name;
        $book->description = $request->description;
        $book->id_type = $request->id_type;
        $book->id_supplier = $request->id_supplier;
        $book->id_author = $request->id_author;
        $book->unit_price = $request->unit_price;
        $book->promotion_price = $request->promotion_price;
        if ($name == '') {
            $name = $book->image;
        } else {
            $duongDanThuMuc = public_path('/HCI/image/books');
            $tenTepTin = $book->image;
            if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
                unlink($duongDanThuMuc . '/' . $tenTepTin);
            };
            $book->image = $name;
        }
        $book->save();
        return redirect()->route('admin.getBookList')->with('success', 'Bạn đã sửa thành công!');
    }
    public function deletetBook(string $id)
    {
        $book = Book::find($id);
        $duongDanThuMuc = public_path('/HCI/image/books');
        $tenTepTin = $book->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        };
        $book->delete();
        return redirect()->route('admin.getBookList')->with('success', 'Bạn đã xóa thành công!');
    }
    public function search(Request $request)
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        if ($search) {
            $results = Book::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $results = [];
        }
        return view('admin.books.admin-book', compact('books', 'results', 'search'));
    }
}
