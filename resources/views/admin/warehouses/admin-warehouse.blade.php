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
                              <h4 class="card-title">Kho hàng</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="{{route('admin.getWarehouseAdd')}}" class="btn btn-primary">Thêm sản phẩm</a>
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
                                        <th style="width: 43%;">Tên sách</th>
                                        <th style="width: 15%;">Số lượng</th>
                                        <th style="width: 25%;">Ngày cập nhật</th>
                                        <th style="width: 15%;">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @isset($warehouses)
                                    @php
                                          $i=1;
                                          $ds=[];
                                          if(isset($results))
                                             $ds=$results;
                                          else
                                             $ds=$warehouses;
                                    @endphp
                                  @foreach($ds as $warehouse)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$warehouse->Book->name}}</td>
                                        <td>{{$warehouse->quantity}}</td>
                                        <td>{{$warehouse->update_date}}</td>                                       
                                        <td>
                                          <div style="justify-content:space-around;align-Items:center;display:flex;width: 100px">
                                             <a class="bg-primary" style="width:30px;border:none;border-radius: 10px;padding: 2px 7px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('admin.getWarehouseEdit',$warehouse->id)}}"><i class="ri-pencil-line"></i></a>
                                             <form action="{{route('admin.deletetWarehouse',$warehouse->id)}}" method="post">
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