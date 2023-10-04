@extends('admin.contacts.layout.master')
@section('css')
@endsection
@section('content8')
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Chi tiết liên hệ</h4>
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
               @isset($contact)
               <div class="iq-card-body">
                  <div class="form-group">
                     <label>Tên người liên hệ:</label>
                     <input type="text" class="form-control" name="name" value="{{isset($contact[0]->name)?$contact[0]->name:''}}" disabled>
                  </div>
                  <div class="form-group">
                     <label>Email:</label>
                     <input type="text" class="form-control" name="email" value="{{isset($contact[0]->email)?$contact[0]->email:''}}" disabled>
                  </div>
                  <div class="form-group">
                     <label>Số điện thoại:</label>
                     <input type="text" class="form-control" name="phone_number" value="{{isset($contact[0]->phone_number)?$contact[0]->phone_number:''}}" disabled>
                  </div>
                  <div class="form-group">
                     <label>Nội dung:</label>
                     <textarea class="form-control" rows="4" name="content" disabled>{{ isset($contact[0]->content)?$contact[0]->content:'' }}</textarea>
                  </div>
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