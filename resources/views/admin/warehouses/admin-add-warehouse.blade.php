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
                              <h4 class="card-title">Thêm sản phẩm</h4>
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
                           <form action="{{route('admin.postWarehouseAdd')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label>Tên sách:</label>
                                 <select class="form-control" id="exampleFormControlSelect1" name="id_book">
                                    @isset($books)
                                       @foreach($books as $book)
                                          <option value="{{$book->id}}">{{$book->name}}</option>
                                       @endforeach
                                    @endisset
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Số lượng:</label>
                                 <input type="text" class="form-control" name="quantity">
                              </div>       
                              <button type="submit" class="btn btn-primary">Gửi</button>
                              <a href="{{ route('admin.getWarehouseList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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