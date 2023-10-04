<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::check()) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('admin.getLogin');
        }
        $users = User::all();
        return view('admin.quanlyuser.user', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = DB::table('users')->where('id', $id)->get();
        return view('admin.quanlyuser.edit', array('user' => $user));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request) {
            $user = User::find($id);
            $user->level = $request->level;
            $user->save();
            return redirect()->route('admin.getUserList')->with('success', 'Bạn đã sửa thành công!');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.getUserList')->with('success', 'Bạn đã xóa thành công!');
    }
    public function getLogin()
    {
        return view('product.sign-in');
    }
    public function postLogin(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự'
            ]
        );

        $credentials = array('email' => $req->email, 'password' => $req->password);
        if (Auth::attempt($credentials)) {
            $email = $req->email;
            $tk = DB::table('users')->where('email', $email)->first();
            Session::put('tk', $tk);
            return redirect('/admin/category/admin-category')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->withInput()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công. Kiểm tra lại thông tin đăng nhập.']);
        }
    }
    public function getLogout(Request $request)
    {
        Auth::logout();
        Session::forget('tk');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
    public function getInputEmail()
    {
        return view('emails.input-email');
    }
    public function postInputEmail(Request $req)
    {
        
        $email = $req->email;
        //validate

        // kiểm tra có user có email như vậy không
        $user = User::where('email', $email)->first();
        $Verification = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        //dd($user);
        if ($user) {
            //gửi mật khẩu reset tới email
            $sentData = [
                'title' => 'Mã xác nhận',
                'body' => $Verification,
            ];

            Mail::to($email)->send(new SendMail($sentData));
            Session::flash('message', 'Gữi mail thành công!');
            Session::put('Verification', $Verification);
            Session::put('email',$email);
            return  redirect()->route('getVerification'); //về lại trang đăng nhập của khách
        } else {
            return redirect()->route('getInputEmail')->with('message', 'Địa chỉ email của bạn không tồn tại');
        }
    }
    public function getVerification()
    {
        return view('emails.input-verification');
    }
    public function postVerification(Request $req)
    {
        $Verification1=Session::get('Verification');
        $Verification2=$req->verification;
        if($Verification1 === $Verification2){
            return redirect()->route('getNewPassword');
        }
        else{
            return redirect()->back()->with('success', 'Mã không chính xác');
        }
    }
    public function getNewPassword()
    {
        return view('emails.input-newpassword');
    }
    public function postNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:20',
            'return_password' => 'required|same:password',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu mới không được quá 20 ký tự.',
            'return_password.same' => 'Mật khẩu xác nhận không khớp',
        ]);
        $email=Session::get('email');
        $user=User::where('email',$email)->first();
        $user->password = Hash::make($request->password);
        $user->save();        
        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
    public function getMyprofile()
    {
        $user = Auth::user();
        return view('product.profile-edit', compact('user'));
    }
    public function postEditprofile(Request $request, $id)
    {
        $name = '';
        // Validate dữ liệu
        if ($request->hasfile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,gif,jpeg|max:2048',
                'email' => 'required|email',
                'name' => 'required',
                'phone' => 'required|min:10',
            ], [
                'image.image' => 'Chỉ chấp nhận file hình ảnh',
                'image.mimes' => 'Chỉ chấp nhận các định dạng hình ảnh: jpg, png, gif, jpeg',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'phone.required' => 'Phải nhập số điện thoại',
                'phone.min' => 'Số điện thoại ít nhất 10 kí tự',
                'name.required' => 'Chưa nhập họ tên',
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/HCI/image/users'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name);
        } else {
            $request->validate([
                'email' => 'required|email',
                'name' => 'required',
                'phone' => 'required|min:10',
            ], [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'phone.required' => 'Phải nhập số điện thoại',
                'phone.min' => 'Số điện thoại ít nhất 10 kí tự',
                'name.required' => 'Chưa nhập họ tên',
            ]);
        }
        // Lấy người dùng từ ID
        $user = User::find($id);

        // Cập nhật thông tin người dùng
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Xử lý hình ảnh (nếu có)
        if ($name == '') {
            $name = $user->image;
        } else {
            $duongDanThuMuc = public_path('/HCI/image/users');
            $tenTepTin = $user->image;
            if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
                unlink($duongDanThuMuc . '/' . $tenTepTin);
            };
            $user->image = $name;
        }

        // Lưu thông tin người dùng
        $user->save();

        // Chuyển hướng về trang hồ sơ cá nhân hoặc trang khác tùy theo yêu cầu của bạn
        return redirect()->route('admin.getMyprofile')->with('success1', 'Cập nhật thông tin thành công!');
    }
    public function changepassword(Request $request, $id)
    {
        // Lấy người dùng từ ID
        $user = User::find($id);

        // Sử dụng validation để kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|max:20',
            're_new_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.max' => 'Mật khẩu mới không được quá 20 ký tự.',
            're_new_password.same' => 'Mật khẩu xác nhận không khớp',
        ]);

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác.');
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        $tk = Auth::user();
        Session::put('tk', $tk);

        return redirect()->back()->with('success2', 'Mật khẩu đã được thay đổi thành công.');
    }
    public function getUserList(){
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.admin-user', compact('users'));
    }
    public function getUserEdit(string $id)
    {
        $user = User::where('id', $id)->get();
        return view('admin.users.admin-edit-user', array('user' => $user));
    }
    public function postUserEdit(Request $request, $id)
    {
        //
        if($request){
            $user=User::find($id);
            $user->level=$request->level;
            $user->save();
            return redirect()->route('admin.getUserList')->with('success','Bạn đã sửa thành công!');
        }
    }
}
