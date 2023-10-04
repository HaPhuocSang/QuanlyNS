<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Banner;


class BannerController extends Controller
{
    //
    public function getBannerList()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('admin.banners.admin-Banner', compact('banners'));
    }
    public function getBannerAdd()
    {
        return view('admin.banners.admin-add-banner');
    }
    public function postBannerAdd(Request $request)
    {
        $name = '';
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png,gif,jpeg|max: 2048',
        ], [
            'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
            'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
            'image.required' => 'Bạn chưa chọn ảnh',
        ]);
        $file = $request->file('image');
        $name = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('/HCI/image/banners'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
        $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car

        $banner = new Banner();
        $banner->image = $name;
        $banner->save();
        return redirect()->route('admin.getBannerList')->with('success', 'Bạn đã thêm thành công!');
    }
    public function getBannerEdit(string $id){
        $banner=Banner::where('id',$id)->get();
        return view('admin.banners.admin-edit-banner',array('banner'=>$banner));
    }
    public function postBannerEdit(Request $request, string $id){
        $name='';
        if($request->hasfile('image')){
            $this->validate($request,[
                'image'=>'mimes:jpg,png,gif,jpeg|max: 2048',
            ],[
                'image.mimes'=>'Chỉ chấp nhận file hình ảnh',
                'image.max'=>'Chỉ chấp nhận hình ảnh dưới 2Mb',
            ]);
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('/HCI/image/banners'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        }
        $banner=Banner::find($id);
        if($name=='')
        {
            $name=$banner->image;
        }
        else{
            $duongDanThuMuc = public_path('/HCI/image/banners');
            $tenTepTin=$banner->image;
            if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
                unlink($duongDanThuMuc . '/' . $tenTepTin);
            };
            $banner->image=$name;
        }
        $banner->save();
        return redirect()->route('admin.getBannerList')->with('success','Bạn đã sửa thành công!');  
    }
    public function deletetBanner(string $id){
        $banner = Banner::find($id);
        $duongDanThuMuc = public_path('/HCI/image/banners');
        $tenTepTin=$banner->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        };
        $banner->delete();
        return redirect()->route('admin.getBannerList')->with('success','Bạn đã xóa thành công!');
    }
}
