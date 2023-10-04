@extends('admin.warehouses.layout.master')
@section('css')
@endsection
@section('content6')
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Sửa sản phẩm</h4>
                  </div>
               </div>
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               @isset($warehouse)
               <div class="iq-card-body">
                  <form action="{{route('admin.postWarehouseEdit',$warehouse[0]->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group">
                        <label>Tên sách:</label>
                        <input type="text" class="form-control" name="id_book" value="{{isset($warehouse[0]->Book->name)?$warehouse[0]->Book->name:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Số lượng:</label>
                        <input type="text" class="form-control" name="quantity" value="{{isset($warehouse[0]->quantity)?$warehouse[0]->quantity:''}}">
                     </div>
                     <button type="submit" class="btn btn-primary">Gửi</button>
                     <a href="{{ route('admin.getWarehouseList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
                  </form>
               </div>
               @endisset
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- Wrapper END -->
<!-- Footer -->
@endsection