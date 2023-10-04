@extends('admin.users.layout.master')
@section('css')
@endsection
@section('content10')
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Danh sách người dùng</h4>
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
                                        <th style="width: 20%;">Email</th>
                                        <td style="width: 20%">Họ và tên</td>
                                        <td style="width: 20%">Số điện thoại</td>
                                        <td style="width: 20%">Level</td>
                                        <th style="width: 15%;">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @isset($users)
                                  @php
                                       $i=1;
                                       $ds=[];
                                       if(isset($results))
                                          $ds=$results;
                                       else
                                          $ds=$users;
                                  @endphp
                                  @foreach($ds as $user)
                                    <tr>
                                       <td>{{$i}}</td>
                                       <td>{{$user->email}}</td>
                                       <td>{{$user->full_name}}</td>        
                                       <td>{{$user->phone}}</td>             
                                       <td>{{$user->level}}</td>                 
                                       <td>
                                          <div style="justify-content:space-around;align-Items:center;display:flex;width: 100px">
                                             <a class="bg-primary" style="width:30px;border:none;border-radius: 10px;padding: 2px 7px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa" href="{{route('admin.getUserEdit',$user->id)}}"><i class="ri-pencil-line"></i></a>
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