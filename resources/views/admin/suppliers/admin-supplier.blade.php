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
                              <h4 class="card-title">Danh sách nhà cung cấp</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="{{route('admin.getSupplierAdd')}}" class="btn btn-primary">Thêm nhà cung cấp</a>
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
                                       <th style="width: 5%;">STT</th>
                                       <th style="width: 20%;">Tên nhà cung cấp</th>
                                       <th style="width: 40%;">Địa chỉ</th>
                                       <th style="width: 20%;">Số điện thoại</th>
                                       <th style="width: 15%;">Hoạt động</th>
                                    </tr>
                                 </thead>         
                                 <tbody>
                                    @isset($suppliers)
                                       @php
                                             $i=1;
                                             $ds=[];
                                             if(isset($results))
                                                $ds=$results;
                                             else
                                                $ds=$suppliers;
                                       @endphp
                                       @foreach($ds as $supplier)
                                          <tr>
                                             <td>{{$i}}</td>                                             
                                             <td>{{$supplier->name}}</td>
                                             <td>
                                                <p class="mb-0">{{$supplier->address}}</p>
                                             </td>
                                             <td>{{$supplier->phone_number}}</td>
                                             <td>
                                                <div style="justify-content:space-around;align-Items:center;display:flex;width: 100px">
                                                <a class="bg-primary" style="width:30px;border:none;border-radius: 10px;padding: 2px 7px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('admin.getSupplierEdit',$supplier->id)}}"><i class="ri-pencil-line"></i></a>
                                                <form action="{{route('admin.deletetSupplier',$supplier->id)}}" method="post">
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