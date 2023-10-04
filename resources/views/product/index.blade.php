@extends('layout.master')
@section('css')
@endsection
@section('content')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height rounded">
               <div class="newrealease-contens">
                  <ul id="newrealease-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                     @isset($banners)
                        @foreach($banners as $banner)
                        <li class="item">
                           <a href="javascript:void(0);">
                              <img src="{{ asset('/HCI/image/banners/'.$banner->image) }}" class="img-fluid w-100 rounded" alt="">
                           </a>
                        </li>
                        @endforeach
                     @endisset
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-12">
            @if(session('error'))
               <br>
                  <div class="alert alert-danger">
                     {{ session('error') }}
                  </div>
               <br>
            @endif
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                  <div class="iq-header-title">
                     <h4 class="card-title mb-0">Tất cả sách</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="row">
                     @isset($books)
                        @php
                           $i=1;
                           $ds=[];
                           if(isset($books))
                              $ds=$books;
                           else
                              $ds=$cars;
                        @endphp
                        @foreach ($ds as $book)
                           <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent mb-sm-0 mb-md-0 mb-lg-0">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="{{ asset('/HCI/image/books/'.$book->image) }}" width="100px" height="200px" alt=""></a>
                                             <div class="view-book">
                                                <a href="{{route('getBookpage',$book->id)}}" class="btn btn-sm btn-white">xem sách</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">{{$book->name}}</h6>
                                                <p class="font-size-13 line-height mb-1">{{$book->Author->name}}</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>
                                                </div>
                                             </div>
                                             @if($book->promotion_price > 0)
                                             <div class="price d-flex align-items-center">
                                                <span class="pr-1 old-price">{{$book->unit_price}}Đ</span>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>{{$book->promotion_price}}Đ</b></h6>
                                             </div>
                                             @else
                                             <div class="price d-flex align-items-center">
                                                <h6><b>{{$book->unit_price}}Đ</b></h6>
                                             </div>
                                             @endif
                                             <div class="iq-product-action">
                                                <a href="{{ route('addToCart',$book->id) }}"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @php
                              $i++;
                           @endphp
                        @endforeach
                     @endisset
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