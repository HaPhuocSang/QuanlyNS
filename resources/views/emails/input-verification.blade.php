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
                            <h3 class="mb-0 text-center text-white">Xác nhận Mã</h3>
                            <p class="text-center text-white"></p>
                            <form class="mt-4 form-text" action="{{route('postVerification')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Mã xác nhận</label>
                                    <input type="number" name="verification" class="form-control mb-0" id="exampleInputEmail2" placeholder="Nhập mã xác nhận của bạn" value="{{isset($request->txtEmail)?$request->txtEmail:''}}">
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
@endsectionF