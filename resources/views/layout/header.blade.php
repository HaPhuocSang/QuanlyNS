
   <body>
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
               <a href="{{route('getHomepage')}}" class="header-logo">
                  <div class="logo-title">
                     <span class="text-primary text-uppercase">NHÀ SÁCH SƠN TRÀ</span>
                  </div>
               </a>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="active active-menu">
                        <a href="{{route('getHomepage')}}" class="iq-waves-effect" ><span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Trang Chủ</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                        </ul>
                     </li>
                     <li>
                        <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="lab la-elementor iq-arrow-left"></i><span>Danh mục sản phẩm</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        @if($type_book)
                           @foreach($type_book as $type)
                              <li class="elements">
                                 <a href="{{route('getTypebook',$type->id)}}"><i class="ri-play-circle-line"></i><span>{{ $type->name }}</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                              </li>
                           @endforeach
                        @endif                                             
                        </ul>
                     </li>
                     <li><a href="{{route('getContact')}}"><i class="ri-question-answer-line"></i>Liên hệ</a></li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-menu-bt d-flex align-items-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="las la-bars"></i></div>
                     </div>
                     <div class="iq-navbar-logo d-flex justify-content-between">
                        <a href="{{route('getHomepage')}}" class="header-logo">
                           <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
                           <div class="logo-title">
                              <span class="text-primary text-uppercase">img01</span>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="navbar-breadcrumb">
                     <h5 class="mb-0">Trang Chủ</h5>
                  </div>
                  <div class="iq-search-bar">
                     <form action="{{route('search')}}" class="searchbox" method="get">
                        @csrf
                        <input type="text" class="text search-input" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ isset($search) ? $search : '' }}" />
                        <button style="background-color:#ffffff;border:none;top: 3px;" class="search-link" type="submit"><i class="ri-search-line"></i></button>
                     </form>
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item nav-icon dropdown">
                           <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                           <i class="ri-shopping-cart-2-line"></i>
                           <span class="badge badge-danger count-cart rounded-circle">@if(Session::has('cart')){{Session('cart')->totalQty}}
											@else 0 @endif</span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 toggle-cart-info">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white">Giỏ Hàng<small class="badge  badge-light float-right pt-1">@if(Session::has('cart')){{Session('cart')->totalQty}}@else 0 @endif</small></h5>
                                    </div>
                                    @isset($productCarts)
								               @foreach($productCarts as $product)
                                          <a href="{{route('delToCart',$product['item']->id)}}" class="iq-sub-card">
                                          <div class="media align-items-center">
                                                <div class="">
                                                   <img class="rounded" src="{{ asset('/HCI/image/books/'.$product['item']->image) }}" alt="">
                                                </div>
                                                <div class="media-body ml-3">
                                                   <h6 class="mb-0 " style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;width: 80px;" >{{$product['item']['name']}}</h6>
                                                   <p class="mb-0">{{$product['qty'] }}*{{$product ['item']->promotion_price !=0? $product['item']-> promotion_price:$product['item']->unit_price}}</p>
                                                </div>
                                                <div class="float-right font-size-24 text-danger" >
                                                   <i class="ri-close-fill"></i>
                                                </div>
                                             </div>
                                          </a>        
                                       @endforeach
							               @endisset                            
                                    <div class="d-flex align-items-center text-center p-3">
                                       <a class="btn btn-primary iq-sign-btn" href="{{route('getCheckout')}}" role="button">Thanh Toán</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="line-height pt-3">
                           @if(Auth::check())
                              @php
                                 $tk = Auth::user();
                              @endphp
                                 <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                    @if($tk->image != "daidien.jpg")
                                       <img src="{{asset('/HCI/image/users/'.$tk->image)}}" class="img-fluid rounded-circle mr-3" alt="user">
                                    @else
                                       <img src="{{asset('/HCI/images/booking/daidien.jpg')}}" class="img-fluid rounded-circle mr-3" alt="user">
                                    @endif   
                                    <div class="caption">
                                       <h6 class="mb-1 line-height">{{$tk->full_name}}</h6>
                                       <p class="mb-0 text-primary"></p>
                                    </div>
                                 </a>
                                 <div class="iq-sub-dropdown iq-user-dropdown">
                                    <div class="iq-card shadow-none m-0">
                                       <div class="iq-card-body p-0 ">
                                          <div class="bg-primary p-3">
                                             <h5 class="mb-0 text-white line-height">Xin Chào {{$tk->full_name}}</h5>
                                          </div>
                                          @if($tk->level === 1)
                                             <a href="{{route('admin.getCategoryList')}}" class="iq-sub-card iq-bg-primary-hover">
                                                <div class="media align-items-center">
                                                   <div class="rounded iq-card-icon iq-bg-primary">
                                                      <i class="las la-home iq-arrow-left"></i>
                                                   </div>
                                                   <div class="media-body ml-3">
                                                      <h6 class="mb-0 ">Admin</h6>
                                                   </div>
                                                </div>
                                             </a> 
                                          @endif 
                                          <a href="{{route('admin.getMyprofile')}}" class="iq-sub-card iq-bg-primary-hover">
                                             <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                   <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                   <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                                </div>
                                             </div>
                                          </a>                                          
                                          <div class="d-inline-block w-100 text-center p-3">
                                             <a class="bg-primary iq-sign-btn" href="{{route('admin.getLogout')}}" role="button">Đăng xuất<i class="ri-login-box-line ml-2"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                           @else
                                 <a href="{{route('admin.getLogin')}}" class="search-toggle iq-waves-effect d-flex align-items-center">
                                    <img src="{{asset('/HCI/images/booking/daidien.jpg')}}" class="img-fluid rounded-circle mr-3" alt="user">
                                    <div class="caption">
                                       <h6 class="mb-1 line-height">Đăng nhập</h6>
                                       <p class="mb-0 text-primary"></p>
                                    </div>
                                 </a>
                           @endif                           
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>