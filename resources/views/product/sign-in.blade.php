@extends('layout.master')
@section('css')
@endsection
@section('content')
<!-- loader Start -->
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
              <h3 class="mb-0 text-center text-white">Đăng nhập</h3>
              <p class="text-center text-white">Nhập địa chỉ email và mật khẩu của bạn để truy cập bảng quản trị.</p>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              @if(session('message'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif
              <form class="mt-4 form-text" action="{{route('admin.getLogin')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Nhập email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mật khẩu</label>
                  <a href="{{route('getInputEmail')}}" class="float-right text-dark">Quên mật khẩu?</a>
                  <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Mật khẩu">
                </div>
                <div class="sign-info text-center">
                  <button type="submit" class="btn btn-white d-block w-100 mb-2">Đăng nhập</button>
                  <span class="text-dark dark-color d-inline-block line-height-2">Bạn không có tài khoản? <a href="{{route('getSignup')}}" class="text-white">Đăng kí</a></span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Sign in END -->
<!-- color-customizer -->

<!-- color-customizer END -->
<!-- Optional JavaScript -->
@endsection