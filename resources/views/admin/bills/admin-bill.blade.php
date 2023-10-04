@extends('admin.bills.layout.master')
@section('css')
@endsection
@section('content9')
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Danh sách đơn hàng</h4>
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
                                       <th style="width: 15%;">Người đặt</th>
                                       <th style="width: 15%;">Người nhận</th>
                                       <td style="width: 10%;">Số điện thoại</td>
                                       <td style="width: 15%;">Địa chỉ</td>
                                       <td style="width: 15%;">Loại địa chỉ</td>
                                       <td style="width: 10%;">Trạng thái</td>
                                       <th style="width: 15%;">Hoạt động</th>
                                    </tr>
                                 </thead>         
                                 <tbody>
                                    @isset($bills)
                                       @php
                                             $i=1;
                                             $ds=[];
                                             if(isset($results))
                                                $ds=$results;
                                             else
                                                $ds=$bills;
                                       @endphp
                                       @foreach($ds as $bill)
                                          <tr>
                                             <td>{{$i}}</td>
                                             <td>{{$bill->user->full_name}}</td>
                                             <td>{{$bill->name}}</td>
                                             <td>
                                                <p class="mb-0">{{$bill->phone_number}}</p>
                                             </td>
                                             <td>
                                                <p class="mb-0">{{$bill->address}}</p>
                                             </td>
                                             <td>
                                                <p class="mb-0">{{$bill->address_type}}</p>
                                             </td>
                                             <td>
                                                <p class="mb-0">{{$bill->status}}</p>
                                             </td>
                                             <td>
                                                <div style="justify-content:space-around;align-Items:center;display:flex;width: 100px">
                                                   <a class="bg-primary" style="width:30px;border:none;border-radius: 10px;padding: 2px 7px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('admin.getBillEdit',$bill->id)}}"><i class="ri-pencil-line"></i></a>
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
      