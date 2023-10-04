@extends('admin.authors.layout.master')
@section('css')
@endsection
@section('content2')
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Thêm tác giả</h4>
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
                        <div class="iq-card-body">
                           <form action="{{ route('admin.postAuthorAdd') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label>Tên tác giả:</label>
                                 <input type="text" class="form-control" name="name">
                              </div>                  
                              <div class="form-group">
                                 <label>Mô tả:</label>
                                 <textarea class="form-control" rows="4" name="description"></textarea>
                              </div>
                              <div class="form-group">
                                 <label>Hình ảnh tác giả:</label>
                                 <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="image" onchange="previewImage(this);">
                                    <label class="custom-file-label" for="customFile" >Chọn tập tin</label>
                                 </div>
                              </div>
                              <div class="form-group" style="height: 200px;">
                                 <label>Hình ảnh được chọn:</label>
                                 <div style="display:flex;flex-direction:column;">
                                    <img id="preview" width="200" height="50" style="position: absolute;width: 200px;height: 150px;display: block;background-size: cover;" class="img-thumbnail"/>
                                 </div>                                 
                              </div>
                              <button type="submit" class="btn btn-primary">Gửi</button>
                              <a href="{{ route('admin.getAuthorList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      @endsection