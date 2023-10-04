<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Author;

class AuthorController extends Controller
{
    //
    public function getAuthorList()
    {
        $authors = Author::orderBy('created_at', 'desc')->get();
        return view('admin.authors.admin-author', compact('authors'));
    }
    public function getAuthorAdd()
    {
        return view('admin.authors.admin-add-author');
    }
    public function postAuthorAdd(Request $request)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'name' => 'required|unique:authors,name',
                'description' => 'required',
            ], [
                'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'name.required' => 'Bạn chưa nhập tên tác giả',
                'name.unique' => 'Tên tác giả đã tồn tại',
                'description.required' => 'Bạn chưa nhập mô tả',
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/HCI/image/authors'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        } else {
            $this->validate($request, [
                'name' => 'required|unique:authors,name',
                'description' => 'required',
            ], [
                'name.required' => 'Bạn chưa nhập tên tác giả',
                'name.unique' => 'Tên tác giả đã tồn tại',
                'description.required' => 'Bạn chưa nhập mô tả',
            ]);
        }
        $authors = new Author();
        $authors->name = $request->name;
        $authors->description = $request->description;
        $authors->image = $name;
        $authors->save();
        return redirect()->route('admin.getAuthorList')->with('success', 'Bạn đã thêm thành công!');
    }
    public function getAuthorEdit(string $id)
    {
        $author = Author::where('id', $id)->get();
        return view('admin.authors.admin-edit-author', array('author' => $author));
    }
    public function postAuthorEdit(Request $request, string $id)
    {
        $name = '';
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'name' => 'required',
                'description' => 'required',
            ], [
                'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'name.required' => 'Bạn chưa nhập tên tác giả',
                'description.required' => 'Bạn chưa nhập mô tả',
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/HCI/image/authors'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        } else {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ], [
                'name.required' => 'Bạn chưa nhập tên tác giả',
                'description.required' => 'Bạn chưa nhập mô tả',
            ]);
        }
        $author = Author::find($id);
        $author->name = $request->name;
        $author->description = $request->description;
        if ($name == '') {
            $name = $author->image;
        } else {
            $duongDanThuMuc = public_path('/HCI/image/authors');
            $tenTepTin = $author->image;
            if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
                unlink($duongDanThuMuc . '/' . $tenTepTin);
            };
            $author->image = $name;
        }
        $author->save();
        return redirect()->route('admin.getAuthorList')->with('success', 'Bạn đã sửa thành công!');
    }
    public function deletetAuthor(string $id)
    {
        $author = Author::find($id);
        $duongDanThuMuc = public_path('/HCI/image/authors');
        $tenTepTin = $author->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        }
        $author->delete();
        return redirect()->route('admin.getAuthorList')->with('success', 'Bạn đã xóa thành công!');
    }
    public function search(Request $request)
    {
        $authors = Author::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        if ($search) {
            $results = Author::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $results = [];
        }
        return view('admin.authors.admin-author', compact('authors', 'results', 'search'));
    }
}
