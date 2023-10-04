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
                     <h4 class="card-title">Sửa đơn hàng</h4>
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
               @isset($bill)
               <div class="iq-card-body">
                  <form action="{{route('admin.postBillEdit',$bill[0]->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group">
                        <label>Người đặt:</label>
                        <input type="text" class="form-control" name="full_name" value="{{isset($bill[0]->user->full_name)?$bill[0]->user->full_name:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Người nhận:</label>
                        <input type="text" class="form-control" name="name" value="{{isset($bill[0]->name)?$bill[0]->name:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Số điện thoại:</label>
                        <input type="number" class="form-control" name="phone_number" value="{{isset($bill[0]->phone_number)?$bill[0]->phone_number:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Địa chỉ:</label>
                        <input type="status" class="form-control" name="address" value="{{isset($bill[0]->address)?$bill[0]->address:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Loại Địa chỉ:</label>
                        <input type="status" class="form-control" name="address_type" value="{{isset($bill[0]->address_type)?$bill[0]->address_type:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Trạng thái:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="status">
                           <option value="{{$bill[0]->status}}">{{$bill[0]->status}}</option>
                           @if($bill[0]->status == "đơn hàng mới")
                           <option value="đang giao hàng">Đang giao hàng</option>
                           <option value="đã giao hàng">Đã giao hàng</option>
                           <option value="đơn hàng đã hủy">Đơn hàng đã hủy</option>
                           @elseif($bill[0]->status == "đang giao hàng")
                           <option value="đơn hàng mới">Đơn hàng mới</option>
                           <option value="đã giao hàng">Đã giao hàng</option>
                           <option value="đơn hàng đã hủy">Đơn hàng đã hủy</option>
                           @elseif($bill[0]->status == "đã giao hàng")
                           <option value="đơn hàng mới">Đơn hàng mới</option>
                           <option value="đang giao hàng">Đang giao hàng</option>
                           <option value="đơn hàng đã hủy">Đơn hàng đã hủy</option>
                           @else
                           <option value="đơn hàng mới">Đơn hàng mới</option>
                           <option value="đang giao hàng">Đang giao hàng</option>
                           <option value="đã giao hàng">Đã giao hàng</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Tổng tiền:</label>
                        <input type="number" class="form-control" name="total" value="{{isset($bill[0]->total)?$bill[0]->total:''}}" disabled>
                     </div>
                     <div class="form-group">
                        <label>Phương thức thanh toán:</label>
                        <input type="text" class="form-control" name="payment" value="{{isset($bill[0]->payment)?$bill[0]->payment:''}}" disabled>
                     </div>
                     <table class="data-tables table table-striped table-bordered" style="width:100%">
                        <thead>
                           <tr>
                              <th style="width: 10%;">STT</th>
                              <th style="width: 40%;">Tên sách</th>
                              <th style="width: 20%;">Số lượng</th>
                              <th style="width: 15%;">Giá</th>
                              <th style="width: 15%;">Hình ảnh</th>
                           </tr>
                        </thead>
                        <tbody>
                           @isset($bill_details)
                              @php
                                 $i=1;
                                 $ds=[];
                                 if(isset($results))
                                    $ds=$results;
                                 else
                                    $ds=$bill_details;
                              @endphp
                           @foreach($ds as $bill_detail)
                              <tr>
                                 <td>{{$i}}</td>
                                 <td>{{$bill_detail->book->name}}</td>
                                 <td>{{$bill_detail->quantity}}</td>
                                 <td>{{$bill_detail->unit_price}} Đ</td>
                                 <td>
                                    <img src="{{ asset('/HCI/image/books/'.$bill_detail->book->image) }}" class="img-fluid avatar-50 rounded" alt="author-profile">
                                 </td>
                              </tr>
                                 @php
                                    $i=$i+1;
                                 @endphp
                           @endforeach
                           @endisset
                        </tbody>
                     </table>
                     <button type="submit" class="btn btn-primary">Gửi</button>
                     <a href="{{ route('admin.BillList') }}" class="btn btn-danger">
                        <font color="white">Trở lại</font>
                     </a>
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