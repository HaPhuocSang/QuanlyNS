@extends('admin.categories.layout.master')
@section('css')
@endsection
@section('content1')
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Sửa danh mục</h4>
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
                        @isset($type_book)
                            <div class="iq-card-body">
                            <form action="{{route('admin.postCategoryEdit',$type_book[0]->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put') 
                                <div class="form-group">
                                    <label>Tên danh mục:</label>
                                    <input type="text" name="name" value="{{isset($type_book[0]->name)?$type_book[0]->name:''}}" class="form-control">
                                </div>
                                <div class="form-group"> 
                                    <label>Mô tả:</label>
                                    <textarea class="form-control" name="description" rows="4">{{ isset($type_book[0]->description)?$type_book[0]->description:'' }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                                <a href="{{ route('admin.getCategoryList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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