@extends('admin.banners.layout.master')
@section('css')
@endsection
@section('content5')
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Sửa banner</h4>
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
               @isset($banner)
               <div class="iq-card-body">
                  <form action="{{route('admin.postBannerEdit',$banner[0]->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('put')                     
                     <div class="form-group">
                        <label>Hình ảnh:</label>
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="customFile" name="image" onchange="previewImage(this);">
                           <label class="custom-file-label" for="customFile">Chọn tập tin</label>
                        </div>
                     </div>
                     <div class="form-group" style="height: 300px;">
                        <label>Hình ảnh cũ:</label>
                        <div style="display:flex;flex-direction:column;">
                           <img src="{{ asset('/HCI/image/banners/'.$banner[0]->image) }}" width="200" height="250" style="position: absolute;width: 200px;height: 250px;display: block;background-size: cover;" class="img-thumbnail" />
                        </div>
                     </div>
                     <div class="form-group" style="height: 300px;">
                        <label>Hình ảnh mới:</label>
                        <div style="display:flex;flex-direction:column;">
                           <img id="preview" width="200" height="250" style="position: absolute;width: 200px;height: 250px;display: block;background-size: cover;" class="img-thumbnail" />
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary">Gửi</button>
                     <a href="{{ route('admin.getBannerList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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