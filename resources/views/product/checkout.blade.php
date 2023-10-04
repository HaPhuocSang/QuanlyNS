@extends('layout.master')
@section('css')
@endsection
@section('content')s
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid checkout-content">
      <div class="row">
         @if(session('error'))
            <br>
               <div class="alert alert-danger">
                  {{ session('error') }}
               </div>
            <br>
         @endif
         @if(session('success'))
            <br>
               <div class="alert alert-success">
                  {{ session('success') }}
               </div>
            <br>
         @endif         
         <div id="cart" class="card-block show p-0 col-12">
            <div class="row align-item-center">
               <div class="col-lg-8">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between iq-border-bottom mb-0">
                        <div class="iq-header-title">
                           <h4 class="card-title">Giỏ hàng</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <ul class="list-inline p-0 m-0">
                           @isset($productCarts)
                           @foreach($productCarts as $product)
                           <li class="checkout-product">
                              <div class="row align-items-center">
                                 <div class="col-sm-2">
                                    <span class="checkout-product-img">
                                       <a href="{{route('getBookpage',$product ['item']->id)}}"><img class="img-fluid rounded" src="{{ asset('/HCI/image/books/'.$product['item']->image) }}" alt=""></a>
                                    </span>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="checkout-product-details">
                                       <h5>{{$product ['item']->name}}</h5>
                                       <p class="text-success">Còn hàng</p>
                                       <div class="price">
                                          <h5>{{$product ['item']->promotion_price !=0? $product['item']-> promotion_price:$product['item']->unit_price}}</h5>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="row">
                                       <div class="col-sm-10">
                                          <div class="row align-items-center mt-2">
                                             <div class="col-sm-7 col-md-6" style="display: flex;">
                                                <form action="{{route('decreaseQuantity',$product ['item']->id)}}" method="get">
                                                   @csrf
                                                   <button type="submit" class="fa fa-minus qty-btn" id="btn-minus"></button>
                                                </form>
                                                <input type="text" id="quantity" value="{{$product['qty'] }}" min="1" disabled>
                                                <form action="{{route('increaseQuantity',$product ['item']->id)}}" method="get">
                                                   @csrf
                                                   <button type="submit" class="fa fa-plus qty-btn" id="btn-plus"></button>
                                                </form>
                                             </div>
                                             <div class="col-sm-5 col-md-6">
                                                <span class="product-price">{{$product ['item']->promotion_price !=0? $product['item']-> promotion_price*$product['qty'] :$product['item']->unit_price*$product['qty']}}</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-sm-2">
                                          <a href="{{route('delToCart',$product['item']->id)}}" class="text-dark font-size-20"><i class="ri-delete-bin-7-fill"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           @endforeach
                           @endisset
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="iq-card">
                     <div class="iq-card-body">
                        <p><b>Chi tiết</b></p>
                        <div class="d-flex justify-content-between mb-1">
                           <span>Tổng</span>
                           <span>{{isset($totalPrice)?$totalPrice:0}}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                           <span>Phí vận chuyển</span>
                           <span class="text-success">Miễn phí</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                           <span class="text-dark"><strong>Tổng</strong></span>
                           <span class="text-dark"><strong>{{isset($totalPrice)?$totalPrice:0}}</strong></span>
                        </div>
                        <button id="place-order" class="btn btn-primary d-block mt-3 next">Đặt hàng</button>
                     </div>
                  </div>
                  <div class="iq-card ">
                     <div class="card-body iq-card-body p-0 iq-checkout-policy">
                        <ul class="p-0 m-0">
                           <li class="d-flex align-items-center">
                              <div class="iq-checkout-icon">
                                 <i class="ri-checkbox-line"></i>
                              </div>
                              <h6>Chính sách bảo mật (Thanh toán an toàn và bảo mật.)</h6>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="iq-checkout-icon">
                                 <i class="ri-truck-line"></i>
                              </div>
                              <h6>Chính sách giao hàng (Giao hàng tận nhà.)</h6>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="iq-checkout-icon">
                                 <i class="ri-arrow-go-back-line"></i>
                              </div>
                              <h6>Chính sách hoàn trả</h6>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="address" class="card-block p-0 col-12">
            <div class="row align-item-center">
               <div class="col-lg-8">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Địa chỉ người nhận</h4>
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
                        <form action="{{route('postCheckout')}}" method="post">
                           @csrf
                           <div class="row mt-3">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Họ và tên người nhận: *</label>
                                    <input type="text" class="form-control" name="name" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Số điện thoại: *</label>
                                    <input type="number" class="form-control" name="phone_number" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Địa chỉ: *</label>
                                    <input type="text" class="form-control" name="address" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="addtype">Loại địa chỉ</label>
                                    <select class="form-control" name="address_type" id="addtype">
                                       <option value="Nhà riêng">Nhà riêng</option>
                                       <option value="Công ty">Công ty</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <div style="position: relative; width: 100%;">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Lựa chọn thanh toán</h4>
                                       </div>
                                       <div class="card-lists">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="payment_cash_on_delivery" name="payment" class="custom-control-input" value="Thanh toán khi giao hàng" checked>
                                             <label class="custom-control-label" for="payment_cash_on_delivery" >Thanh toán khi giao hàng</label>
                                          </div>
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="payment_momo_zalopay" name="payment" class="custom-control-input" value="Momo/ZaloPay">
                                             <label class="custom-control-label" for="payment_momo_zalopay">Momo/ZaloPay</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 @if(Session::has('tk'))
                                    <button id="savenddeliver" type="submit" class="btn btn-primary">Thanh toán</button>
                                 @endif
                              </div>
                           </div>
                        </form>

                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="iq-card">
                     <div class="iq-card-body">
                        <h4 class="mb-2">Chi tiết</h4>
                        <div class="d-flex justify-content-between">
                           <span>Giá @if(Session::has('cart')){{Session('cart')->totalQty}}@else 0 @endif sản phẩm</span>
                           <span><strong>{{isset($totalPrice)?$totalPrice:0}}</strong></span>
                        </div>
                        <div class="d-flex justify-content-between">
                           <span>Phí vận chuyển</span>
                           <span class="text-success">Miễn phí</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                           <span>Số tiền phải trả</span>
                           <span><strong>{{isset($totalPrice)?$totalPrice:0}}</strong></span>
                        </div>
                     </div>
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