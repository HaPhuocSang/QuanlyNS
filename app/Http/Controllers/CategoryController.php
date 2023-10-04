<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_book;

class CategoryController extends Controller
{
    //
    public function getCategoryList(){
        $type_books=Type_book::orderBy('created_at', 'desc')->get();
        return view('admin.categories.admin-category',compact('type_books'));
    }
    public function getCategoryAdd(){
        return view('admin.categories.admin-add-category');
    }
    public function postCategoryAdd(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:type_books,name',
            'description'=>'required',
        ],[
            'name.required'=>'Bạn chưa nhập tên loại danh mục',
            'name.unique'=>'Danh mục đã tồn tại',
            'description.required'=>'Bạn chưa nhập mô tả',
        ]);
        $type_book=new Type_book();
        $type_book->name=$request->name;
        $type_book->description=$request->description;
        $type_book->save();
        return redirect()->route('admin.getCategoryList')->with('success','Bạn đã thêm thành công!');  
    }
    public function getCategoryEdit(string $id){
        $type_book=Type_book::where('id',$id)->get();
        return view('admin.categories.admin-edit-category',array('type_book'=>$type_book));
    }
    public function postCategoryEdit(Request $request,string $id){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'Bạn chưa nhập tên loại danh mục',
            'description.required'=>'Bạn chưa nhập mô tả',
        ]);
        $type_book=Type_book::find($id);
        $type_book->name=$request->name;
        $type_book->description=$request->description;
        $type_book->save();
        return redirect()->route('admin.getCategoryList')->with('success','Bạn đã sửa thành công!');  
    }
    public function deletetCategory(string $id){
        $type_book = Type_book::find($id);
        $type_book->delete();
        return redirect()->route('admin.getCategoryList')->with('success','Bạn đã xóa thành công!');
    }
    public function search(Request $request)
    {
        $type_books = Type_book::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        if ($search) {
            $results = Type_book::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $results = [];
        }
        return view('admin.categories.admin-category', compact('type_books','results', 'search'));
    }
}
