@extends('admin.suppliers.layout.master')
@section('css')
@endsection
@section('content3')
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Sửa nhà cung cấp</h4>
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
                        @isset($supplier)
                           <div class="iq-card-body" >
                              <form action="{{route('admin.postSupplierEdit',$supplier[0]->id)}}" method="post" enctype="multipart/form-data">
                                 @csrf
                                 @method('put')
                                 <div class="form-group">
                                 <label>Tên nhà cung cấp:</label>
                                 <input type="text" class="form-control" name="name" value="{{isset($supplier[0]->name)?$supplier[0]->name:''}}">
                              </div>                  
                              <div class="form-group">
                                 <label>Địa chỉ:</label>
                                 <input type="text" class="form-control" name="address" value="{{isset($supplier[0]->address)?$supplier[0]->address:''}}">
                              </div>
                              <div class="form-group">
                                 <label>Số điện thoại:</label>
                                 <input type="number" class="form-control" name="phone_number" value="{{isset($supplier[0]->phone_number)?$supplier[0]->phone_number:''}}">
                              </div>
                              <button type="submit" class="btn btn-primary">Gửi</button>
                              <a href="{{ route('admin.getSupplierList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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