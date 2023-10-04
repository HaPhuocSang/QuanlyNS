@extends('admin.users.layout.master')
@section('css')
@endsection
@section('content10')
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Sửa thông tin người dùng</h4>
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
               @if(session('success1'))
               <div class="alert alert-success">
                  {{ session('success1') }}
               </div>
               @endif
               @isset($user)
               <div class="iq-card-body">
                  <form action="{{route('admin.postUserEdit',$user[0]->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group row align-items-center">
                        <div class="col-md-12">
                           <div class="profile-img-edit" style="width: 150px;height: 150px;border: radius 100px; overflow:hidden; justify-content:space-between;align-items:center">
                              @if($user[0]->image != "daidien.jpg")
                              <img class="profile-pic" src="{{ asset('/HCI/image/users/'.$user[0]->image) }}" style="position: relative; width: 150px;height: 150px;border: radius 100px;" alt="profile-pic">
                              @else
                              <img class="profile-pic" src="{{asset('/HCI/images/booking/'.$user[0]->image)}}" style="position: relative; width: 150px;height: 150px;border: radius 100px;" alt="profile-pic">
                              @endif
                              <div class="p-image">
                                 <i class="ri-pencil-line upload-button"></i>
                                 <input class="file-upload" disabled type="file" name="image" style="position: relative; width: 150px;height: 150px;border: radius 100px;" accept="image/*" />
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-sm-12">
                        <label for="name">Họ tên:</label>
                        <input type="text" class="form-control" disabled name="name" id="name" value="{{isset( $user[0]->full_name)?$user[0]->full_name:''}}">
                     </div>
                     <div class="form-group col-sm-12">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" disabled name="phone" value="{{ isset($user[0]->phone)?$user[0]->phone:'' }}">
                     </div>
                     <div class="form-group col-sm-12">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" disabled name="email" value="{{ isset($user[0]->email)?$user[0]->email:'' }}">
                     </div>
                     <div class="form-group col-sm-12">
                        <label for="">Level</label>
                        <select class="form-control" name="level" id="">
                           <option value="{{$user[0]->level}}">{{$user[0]->level}}</option>
                           @if($user[0]->level=='1')
                              <option value='3'>3</option>
                           @else
                              <option value='1'>1</option>
                           @endif
                        </select>
                     </div>
                     <button type="submit" style="margin-left: 15px;" class="btn btn-primary mr-2">Gửi</button>
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