@extends('admin.importproducts.layout.master')
@section('css')
@endsection
@section('content7')
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
                              <a href="{{route('admin.getImportproductAdd')}}" class="btn btn-primary">Thêm sản phẩm</a>
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
                                        <th style="width: 25%;">Ngày nhập hàng</th>
                                        <th style="width: 15%;">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @isset($importproducts)
                                    @php
                                          $i=1;
                                          $ds=[];
                                          if(isset($results))
                                             $ds=$results;
                                          else
                                             $ds=$importproducts;
                                    @endphp
                                  @foreach($ds as $importproduct)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$importproduct->Warehouse->Book->name}}</td>
                                        <td>{{$importproduct->quantity}}</td>
                                        <td>{{$importproduct->date_added}}</td>                                       
                                        <td>
                                          <div style="justify-content:space-around;align-Items:center;display:flex;width: 100px">
                                             <form action="{{route('admin.deletetImportproduct',$importproduct->id)}}" method="post">
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