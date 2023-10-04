@extends('admin.books.layout.master')
@section('css')
@endsection
@section('content4')
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Sửa sách</h4>
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
               @isset($book)
               <div class="iq-card-body">
                  <form action="{{route('admin.postBookEdit',$book[0]->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group">
                        <label>Tên sách:</label>
                        <input type="text" class="form-control" name="name" value="{{isset($book[0]->name)?$book[0]->name:''}}">
                     </div>
                     <div class="form-group">
                        <label>Danh mục sách:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="id_type">
                           <option value="{{$book[0]->Typebook->id}}">{{$book[0]->Typebook->name}}</option>
                           @isset($typebooks)
                              @foreach($typebooks as $typebook)
                                 @if($typebook->id != $book[0]->Typebook->id)
                                    <option value="{{$typebook->id}}">{{$typebook->name}}</option>
                                 @endif
                              @endforeach
                           @endisset
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Tác giả:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="id_author">
                           <option value="{{$book[0]->Author->id}}">{{$book[0]->Author->name}}</option>
                           @isset($authors)
                                 @foreach($authors as $author)
                                    @if($author->id != $book[0]->Author->id)
                                       <option value="{{$author->id}}">{{$author->name}}</option>
                                    @endif
                                 @endforeach
                           @endisset
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Nhà cung cấp:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="id_supplier">
                           <option value="{{$book[0]->Supplier->id}}">{{$book[0]->Supplier->name}}</option>
                           @isset($suppliers)
                              @foreach($suppliers as $supplier)
                                 @if($supplier->id != $book[0]->Supplier->id)
                                    <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                                 @endif
                              @endforeach
                           @endisset
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Hình ảnh:</label>
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="customFile" name="image" onchange="previewImage(this);">
                           <label class="custom-file-label" for="customFile">Chọn tập tin</label>
                        </div>
                     </div>
                     <div class="form-group" style="height: 200px;">
                        <label>Hình ảnh cũ:</label>
                        <div style="display:flex;flex-direction:column;">
                           <img src="{{ asset('/HCI/image/books/'.$book[0]->image) }}" width="200" height="50" style="position: absolute;width: 200px;height: 150px;display: block;background-size: cover;" class="img-thumbnail" />
                        </div>
                     </div>
                     <div class="form-group" style="height: 200px;">
                        <label>Hình ảnh mới:</label>
                        <div style="display:flex;flex-direction:column;">
                           <img id="preview" width="200" height="50" style="position: absolute;width: 200px;height: 150px;display: block;background-size: cover;" class="img-thumbnail" />
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Giá sách:</label>
                        <input type="text" class="form-control" name="unit_price" value="{{isset($book[0]->unit_price)?$book[0]->unit_price:''}}">
                     </div>
                     <div class="form-group">
                        <label>Giá sách sau khi giảm:</label>
                        <input type="text" class="form-control" name="promotion_price" value="{{isset($book[0]->promotion_price)?$book[0]->promotion_price:''}}">
                     </div>
                     <div class="form-group">
                        <label>Nội dung:</label>
                        <textarea class="form-control" rows="4" name="description">{{isset($book[0]->description)?$book[0]->description:''}}</textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Gửi</button>
                     <a href="{{ route('admin.getBookList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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