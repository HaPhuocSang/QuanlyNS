@extends('admin.importproducts.layout.master')
@section('css')
@endsection
@section('content7')
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
               @isset($warehouse)
               <div class="iq-card-body">
                  <form action="{{route('admin.postWarehouseEdit',$warehouse[0]->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group">
                        <label>Tên sách:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="id_book">
                           <option value="{{$warehouse[0]->id_book}}">{{$warehouse[0]->Book->name}}</option>
                           @isset($books)
                              @foreach($books as $book)
                                 @if($book->id != $warehouse[0]->id_book)
                                    <option value="{{$book->id}}">{{$book->name}}</option>
                                 @endif
                              @endforeach
                           @endisset
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Số lượng:</label>
                        <input type="text" class="form-control" name="quantity" value="{{isset($warehouse[0]->quantity)?$warehouse[0]->quantity:''}}">
                     </div>
                     <button type="submit" class="btn btn-primary">Gửi</button>
                     <a href="{{ route('admin.getImportproductList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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