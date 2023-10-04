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
                              <h4 class="card-title">Danh sách sách</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="{{route('admin.getBookAdd')}}" class="btn btn-primary">Thêm sách</a>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              @if(session('success'))
                                 <br>
                                 <div class="alert alert-success">
                                    {{ session('success') }}
                                 </div>
                                 <br>
                              @endif
                              <table class="data-tables table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 2%;">STT</th>
                                        <th style="width: 14%;">Tên sách</th>
                                        <th style="width: 13%;">Thể loại sách</th>
                                        <th style="width: 15%;">Nhà cung cấp</th>
                                        <th style="width: 13%;">Tác giả</th>
                                        <th style="width: 10%;">Hình ảnh</th>
                                        <th style="width: 9%;">Giá</th>
                                        <th style="width: 9%;">Giá giảm</th>
                                        <th style="width: 15%;">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @isset($books)
                                    @php
                                          $i=1;
                                          $ds=[];
                                          if(isset($results))
                                             $ds=$results;
                                          else
                                             $ds=$books;
                                    @endphp
                                  @foreach($ds as $book)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$book->name}}</td>
                                        <td>{{$book->Typebook->name}}</td>
                                        <td>{{$book->Supplier->name}}</td>
                                        <td>{{$book->Author->name}}</td>
                                        <td>
                                          <img src="{{ asset('/HCI/image/books/'.$book->image) }}" class="img-fluid avatar-50 rounded" alt="author-profile">
                                        </td>
                                        <td>{{$book->unit_price}}đ</td>
                                        <td>{{$book->promotion_price}}đ</td>                                        
                                        <td>
                                          <div style="justify-content:space-around;align-Items:center;display:flex;width: 100px">
                                             <a class="bg-primary" style="width:30px;border:none;border-radius: 10px;padding: 2px 7px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('admin.getBookEdit',$book->id)}}"><i class="ri-pencil-line"></i></a>
                                             <form action="{{route('admin.deletetBook',$book->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                   <button class="bg-primary" style="width:30px;border:none;border-radius: 10px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xoá" type="submit"><i class="ri-delete-bin-line"></i></button>
                                             </form>
                                          </div>
                                        </td>
                                    </tr>        
                                    @php
                                      $i=$i+1;
                                    @endphp
                                  @endforeach 
                                @endisset                                                             
                                </tbody>
                              </table>

                           </div>
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