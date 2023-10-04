@extends('layout.master')
@section('css')
@endsection
@section('content')
<!-- loader Start -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Sign in Start -->
<section class="sign-in-page">
    <div class="container p-0">
        <div class="row no-gutters height-self-center">
            <div class="col-sm-12 align-self-center page-content rounded">
                <div class="row m-0">
                    <div class="col-sm-12 sign-in-page-data">
                        <div class="sign-in-from bg-primary rounded">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if(session('success'))
                            <br>
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            <br>
                            @endif
                            <h3 class="mb-0 text-center text-white">Đăng kí</h3>
                            <p class="text-center text-white">Nhập địa chỉ email và mật khẩu của bạn để truy cập bảng quản trị.</p>
                            <form class="mt-4 form-text" action="{{route('postSignup')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và tên</label>
                                    <input type="text" name="full_name" class="form-control mb-0" id="exampleInputEmail1" placeholder="Nhập họ tên">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Email</label>
                                    <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Số điện thoại</label>
                                    <input type="number" name="phone" class="form-control mb-0" id="exampleInputEmail2" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Nhập mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhâp lại mật khẩu</label>
                                    <input type="password" name="repassword" class="form-control mb-0" id="exampleInputPassword1" placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="sign-info text-center">
                                    <button type="submit" class="btn btn-white d-block w-100 mb-2">Đăng ký</button>
                                    <span class="text-dark d-inline-block line-height-2">Đã có tài khoản? <a href="{{route('admin.getLogin')}}" class="text-white">Đăng nhập</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- color-customizer END -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

@endsection