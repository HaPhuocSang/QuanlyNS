@extends('layout.master')
@section('css')
@endsection
@section('content')
<section class="sign-in-page">
    <div class="container p-0">
        <div class="row no-gutters height-self-center">
            <div class="col-sm-12 align-self-center page-content rounded">
                <div class="row m-0">
                    <div class="col-sm-12 sign-in-page-data">
                        <div class="sign-in-from bg-primary rounded">
                            @if(session('success')) 
                              <div class="alert alert-success">
                                  {{ session('success') }}
                              </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <h3 class="mb-0 text-center text-white">Nhập mật khẩu mới</h3>
                            <p class="text-center text-white"></p>
                            <form class="mt-4 form-text" action="{{route('postNewPassword')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Mật khẩu mới</label>
                                    <input type="password" name="password" class="form-control mb-0" id="exampleInputEmail2" placeholder="Nhập mật khẩu mới" value="{{isset($request->txtEmail)?$request->txtEmail:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Nhập lại mật khẩu</label>
                                    <input type="password" name="return_password" class="form-control mb-0" id="exampleInputEmail2" placeholder="Nhập lại mật khẩu" value="{{isset($request->txtEmail)?$request->txtEmail:''}}">
                                </div>
                                <div class="sign-info text-center">
                                    <button type="submit" class="btn btn-white d-block w-100 mb-2">Xác nhận</button>                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection