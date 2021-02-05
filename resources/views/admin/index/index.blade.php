@extends('templates.admin.master')
@section('main-content')
   <div class="row">
         <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="row">
              <div class="col-xl-12">
              <select name="year" id="year" class="btn btn-sm float-left">
                @for($i = 2018; $i<=2029; $i++)
                    <option @if($i == $year) selected  @endif  value="{{$i}}"> {{$i}}</option>
                @endfor
              </select>
              <input type="submit" onclick="getYear()" value="Tìm kiếm" class="float-left btn-sm btn btn-success">
              </div>
            </div>
            <div id="doanhThu">
              @include('admin.index.revenue')
            </div>
        </div>
        
        <div class="col-xl-4">
          
          <div class="row">
            <div class="col-xl-12">
              <input type="submit" onclick="getYearOrder()"  value="Tìm kiếm" class="float-right btn-sm btn btn-success ml-1">
              <select name="year" id="yearOrder" class="btn btn-sm float-right">
                @for($i = 2018; $i<=2029; $i++)
                    <option @if($i == $year) selected  @endif  value="{{$i}}"> {{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
          <div id="datPhong">
            @include('admin.index.totalOrder')
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col" >
                  <h3 class="btn btn-white text-blue" style="text-align: center">
                    <i class="fas fa-layer-group text-blue"></i>
                    Danh sách phòng đang ở</h3>
                </div>
              </div>
            </div>
            <hr class="my-1" />
            <div class="table-responsive">
              <!-- Projects table -->
              <div style=" padding:5px; border-radius:5px; height:300px;  overflow-y: scroll;overflow-x: scroll;">  
                @foreach($listFloor as $itemFloor)
                    @foreach($itemFloor->floor_room as $itemRoom)
                        @if($itemRoom->checkOrder($itemRoom->id_room,$idUser))
                        <div class="row">
                        <div class="col-lg-12 mb-2">
                            <label class="btn btn-sm btn-white">
                            <i class="ni ni-building text-info"></i> 
                            {{$itemFloor->name_floor}}
                            </label>
                        </div>
                        </div>
                        @break
                        @endif
                    @endforeach
                    <div class="row mb-5 mt-3 ml-2" >
                    @foreach($listOrderRoom as $itemOrder)
                            @if($itemFloor->id_floor == $itemOrder->room->floor->id_floor)
                            <div class="col-lg-2 " style="font-size:12px;">
                                <i  class="ni ni-check-bold text-info"></i>{{$itemOrder->room->name_room}}
                                <i  class="fas fa-door-closed fa-2x text-red" onclick="showRoom({{$itemOrder->id_order}})"></i>
                            </div>
                           
                            {{-- modal chi tiet phòng --}}
                            <div class="modal" id="live-{{$itemOrder->id_order}}" >
                                <div class="modal-dialog modal-md">
                                <div class="modal-content">     
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-purple">
                                    <h4 class="modal-title">Thông tin phòng đang thuê</h4>
                                    <button type="button" class="btn-sm btn btn-white text-blue" id="closeLive-{{$itemOrder->id_order}}">&times;</button>
                                    </div> 
                                    @php
                                        if($itemOrder->trangThaiDonThue == 1){
                                          $trangThai = "Đang Thuê";
                                        }
                                    @endphp
                                    <!-- Modal body -->
                                    <div class="modal-body " >
                                      <h4>Thông tin phòng:</h4>
                                      <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <h5>Phòng: {{$itemOrder->room->name_room}} </h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <h5>Tầng: {{$itemOrder->room->floor->name_floor}} </h5>
                                        </div>
                                        <div class="col-lg-4 float-left">
                                            <h5>Loại phòng: {{$itemOrder->room->roomtype->name_roomtype}} </h5>
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <h5>Ngày đến: {{date('d-m-Y', strtotime($itemOrder->date_start))}} </h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <h5>Ngày đi: {{date('d-m-Y', strtotime($itemOrder->date_end))}} </h5>
                                        </div>
                                        <div class="col-lg-4 float-left">
                                            <h5>Tình Trạng: {{$trangThai}} </h5>
                                        </div>
                                      </div>
                                      <hr class="my-1">
                                      <h4>Thông tin khách hàng:</h4>
                                      <div class="row mb-3">
                                        <div class="col-lg-6">
                                          <h5>Tên: {{$itemOrder->customer->fullname}} </h5>
                                        </div>
                                        <div class="col-lg-6 float-right">
                                          <h5>Số điện thoại: {{$itemOrder->customer->phone}} </h5>
                                        </div>
                                      </div>
    
                                      <div class="row mb-3">
                                        <div class="col-lg-12">
                                          <h5>Địa chỉ: {{$itemOrder->customer->address}} </h5>
                                        </div>
                                      </div>
                                      <hr class="my-1">
                                      <div class="row">
                                            <div class="col-lg-6">
                                                <label class="btn btn-sm btn-white text-green" onclick="showPaymentRoom({{$itemOrder->id_order}})">Thanh toán tiền phòng</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="btn btn-sm btn-white text-green float-right" onclick="showPayment({{$itemOrder->id_order}})">Thanh toán tiền điện nước</label>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                </div>
                            </div> 
                             {{-- modal thanh toán diện nước --}}
                            <div class="modal " id="payment-{{$itemOrder->id_order}}">
                                <div class="modal-dialog modal-md" >
                                <div class="modal-content">     
                                    <!-- Modal Header -->
                                    <div class="modal-header" style="border-bottom:1px solid lightgray">
                                    <h3 class="modal-title">Thanh Toán Điện Nước</h3>
                                    <button type="button" class="btn-sm btn-success" id="closepay-{{$itemOrder->id_order}}">&times;</button>
                                    </div>    
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body" style="text-align: center;">
                                  
                                    <div class="row"> 
                                        {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Tháng</label>
                                            <select name="month" id="month-{{$itemOrder->id_order}}" onchange="datePayment({{$itemOrder->id_order}})"  class="form-control form-control-sm form-control-alternative ">
                                            <option selected="" >-- chọn tháng/năm --</option>
                                                @for($i = 1 ; $i<=12 ; $i++)
                                                <option value="{{$i}}">Tháng {{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                        <div class="form-group datePayment-{{$itemOrder->id_order}}">
                                        @php $isset = false; @endphp
                                        @foreach($itemOrder->Payment as $itemPay)
                                            @if($itemPay->idThuePhong == $itemOrder->id_order)
                                            @if($itemPay->tinhTrang == 0)
                                            <form action="{{route('admin.order_room.printFast')}}" method="post" >
                                              @csrf
                                            <div class="thanhToanDienNuoc-{{$itemOrder->id_order}}">
                                              <input type="text" class="form-control form-control-sm " hidden value="" name="idThanhToan" >
                                              <div class="row">
                                                <div class="col-lg-12">
                                                  <div class="form-group">
                                                    <label  class="btn btn-primary btn-sm " onclick="thanhToanDienNuoc({{$itemPay->idThanhToan}},{{$itemOrder->id_order}})" >Thanh toán tiền điện nước</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            </form>
                                            @php $isset = true; @endphp
                                            @break
                                            @else
                                              <h5 class="text-green">Tiền điện, nước đã được thanh toán</h5>
                                            @php $isset = true; @endphp
                                            @endif
                                            @endif
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                    @if($isset == false)
                                    <form action="{{route('admin.order_room.payment')}}" method="post">
                                      @csrf
                                    <input type="text" class="form-control form-control-sm " hidden value="{{$itemOrder->id_order}}" name="idOrder" >
                                    <div class="row">
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Số điện ban đầu</label>
                                            <input type="texts" class="form-control form-control-sm soDienBanDau-{{$itemOrder->id_order}}" readonly value="{{$itemOrder->room->chiSoDienBanDau}}" name="soDienBanDau" >
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Số điện hiện tại</label>
                                            <input type="text" class="form-control form-control-sm soDienHienTai-{{$itemOrder->id_order}}" required name="soDienHienTai" onchange="thayDoiSoDien({{$itemOrder->id_order}})" placeholder="nhập vào đây">
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Số điện cuối</label>
                                            <input type="text" class="form-control form-control-sm soDienCuoi-{{$itemOrder->id_order}}" name="soDienCuoi"  readonly>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Số nước ban đầu</label>
                                            <input type="text" class="form-control form-control-sm soNuocBanDau-{{$itemOrder->id_order}}" name="soNuocBanDau" readonly value="{{$itemOrder->room->chiSoNuocBanDau}}" >
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Số nước hiện tại</label>
                                            <input type="number" class="form-control form-control-sm soNuocHienTai-{{$itemOrder->id_order}}" required onchange="thayDoiSoNuoc({{$itemOrder->id_order}})" name="soNuocHienTai" placeholder="nhập vào đây ">
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" style="font-size: 12px !important;">Số nước cuối</label>
                                            <input type="text" class="form-control form-control-sm soNuocCuoi-{{$itemOrder->id_order}}" name="soNuocCuoi" readonly value="">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-sm " value="Lập Hoá Đơn">
                                        </div>
                                        </div>        
                                    </div>
                                    </form>
                                    @endif
                                    </div>  
                                </div>
                                </div>
                            </div>
    
                              {{-- modal thanh toán tiền phòng --}}
                              <div class="modal" id="paymentroom-{{$itemOrder->id_order}}">
                                <div class="modal-dialog modal-md">
                                <div class="modal-content">     
                                    <!-- Modal Header -->
                                    <div class="modal-header" style="border-bottom:1px solid lightgray">
                                    <h3 class="modal-title">Thanh Tiền Phòng</h3>
                                    <button type="button" class="btn-sm btn-success" id="closepayroom-{{$itemOrder->id_order}}">&times;</button>
                                    </div>    
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body" style="text-align: center;">
                                    @php $check = false; @endphp
                                    @foreach($itemOrder->PaymentRoom as $itemPaymentRoom)
                                    @if($itemPaymentRoom->idThuePhong == $itemOrder->id_order)
                                    @if($itemPaymentRoom->tinhTrang == 0)
                                    <form action="{{route('admin.order_room.print')}}" method="post" >
                                      @csrf
                                    <div class="thanhToan-{{$itemOrder->id_order}}">
                                    <input type="text" class="form-control form-control-sm " hidden value="{{$itemPaymentRoom->idThanhToan}}" name="idThanhToan" >
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <div class="form-group">
                                          <label  class="btn btn-primary btn-sm " onclick="thanhToanPhong({{$itemPaymentRoom->idThanhToan}},{{$itemOrder->id_order}})" >Thanh toán tiền phòng</label>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                    </form>
                                    @php $check = true; @endphp
                                    @break
                                    @else
                                      <h5 class="text-green">Tiền phòng đã được thanh toán</h5>
                                    @php $check = true; @endphp
                                    @endif
                                    @endif
                                    @endforeach
                                    @if($check == false)
                                    <form action="{{route('admin.order_room.paymentRoom')}}" method="post" class="thanhToan-{{$itemOrder->id_order}}">
                                      @csrf
                                      <input type="text" class="form-control form-control-sm " hidden value="{{$itemOrder->id_order}}" name="idOrder" >
                                      
                                      
                                      <div class="row mb-5">
                                          <div class="col-lg-4">
                                              giá phòng: {{number_format($itemOrder->price_room)}} VND
                                          </div>  
                                          <div class="col-lg-4">
                                              Tiền cọc: {{number_format($itemOrder->deposits)}} VND
                                          </div>  
                                          <div class="col-lg-4">
                                              Tiền còn lại: {{number_format($itemOrder->money_last)}} VND
                                          </div>        
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-sm " value="Lập Hoá Đơn">
                                        </div>
                                        </div>        
                                      </div>
                                    </form>
                                    @endif
                                 
                                    </div>  
                                </div>
                                </div>
                            </div>
    
                        @endif
                    @endforeach
                    </div>
                  @endforeach
            </div>

            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="btn btn-white text-green" style="text-align: center">
                    <i class="fas fa-door-open text-green"></i>
                    Danh sách phòng đang trống</h3>
                </div>
              </div>
            </div>
            <hr class="my-1" />
            <div class="table-responsive">
              <!-- Projects table -->
              <div style=" padding:5px; border-radius:5px; height:300px;  overflow-y: scroll;overflow-x: scroll;"> 
                @foreach($listFloor as $itemFloor)
                @foreach($itemFloor->floor_room  as $itemRoom)
                  @if($itemRoom->id_floor)
                    <div class="row">
                    <div class="col-lg-12">
                        <label class="btn btn-sm btn-white">
                        <i class="ni ni-building text-info"></i> 
                        {{$itemFloor->name_floor}}
                        </label>
                    </div>
                    </div>
                    @break
                    @endif
                @endforeach
                <div class="row mb-5 mt-3 ml-2" >
                @foreach($listRoomShare as $itemRoom)
                        @if($itemFloor->id_floor == $itemRoom->floor->id_floor)
                        <div class="col-lg-4 mb-4" style="font-size:12px;">
                            <i  class="ni ni-check-bold text-info"></i>{{$itemRoom->name_room}}
                            <i  class="fas fa-door-open fa-2x text-blue"></i>
                        </div>
                        @endif
                @endforeach
                        </div>
              @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
<script>  
  function getYear(){
    var year = $('#year').val();
    //alert(year);
        $.ajax({
            url:'{{route("admin.index.revenueAjax")}}', 
            method:"POST",
            data:{
                "_token":'{{ csrf_token() }}',
                "year":year
            },
            success: function(data){
                
                $("#doanhThu").html(data);
                //window.location.reload();
              
            }
        });     
  }

  function getYearOrder(){
    var year = $('#yearOrder').val();
    //alert(year);
        $.ajax({
            url:'{{route("admin.index.yearOrderAjax")}}', 
            method:"POST",
            data:{
                "_token":'{{ csrf_token() }}',
                "year":year
            },
            success: function(data){
                
                $("#datPhong").html(data);
                //window.location.reload();
              
            }
        });     
  }

  function showRoom(id_order){
    var modalShow = "#live-"+id_order;
    var closeRoom = '#closeLive-'+id_order;
    $(modalShow).show(600,function(){
      $(closeRoom).click(function(){
        $(modalShow).hide(600);
      });
    });
  }

  function showPayment(id_order){
    var modalShow = "#payment-"+id_order;
    var closeRoom = '#closepay-'+id_order;
    $(modalShow).show(600,function(){
      $(closeRoom).click(function(){
        $(modalShow).hide(600);
      });
    });
  }

  function showPaymentRoom(id_order){
    var modalShow = "#paymentroom-"+id_order;
    var closeRoom = '#closepayroom-'+id_order;
    $(modalShow).show(600,function(){
      $(closeRoom).click(function(){
        $(modalShow).hide(600);
      });
    });
  }

  function thayDoiSoNuoc(id_order){
    var soNuocBanDau = '.soNuocBanDau-'+id_order;
    var soNuocBanDau = $(soNuocBanDau).val();

    var soNuocHienTai = '.soNuocHienTai-'+id_order;
    var soNuocHienTai = $(soNuocHienTai).val();
    
    var soCuoi = soNuocHienTai - soNuocBanDau;
    var soNuocCuoi = '.soNuocCuoi-'+id_order;
    var soNuocCuoi = $(soNuocCuoi).val(soCuoi);
      
  }

  function thayDoiSoDien(id_order){
    var soDienBanDau = '.soDienBanDau-'+id_order;
    var soDienBanDau = $(soDienBanDau).val();

    var soDienHienTai = '.soDienHienTai-'+id_order;
    var soDienHienTai = $(soDienHienTai).val();
    
    var soCuoi = soDienHienTai - soDienBanDau;
    var soDienCuoi = '.soDienCuoi-'+id_order;
    var soDienCuoi = $(soDienCuoi).val(soCuoi);  
  }

  function thanhToanPhong(idThanhToan,idOrder){
    
    $.ajax({
      url:'{{route("admin.order_room.thanhToan")}}', 
      method:"POST",
      data:{
        "_token":'{{ csrf_token() }}',
        "idThanhToan":idThanhToan,
        
      },
      success: function(data){
          var status = '.thanhToan-'+idOrder;
          $(status).html(data);
        //alert(data);
      }
    });
  }

  function thanhToanDienNuoc(idThanhToan,idOrder){
    
    $.ajax({
      url:'{{route("admin.order_room.paymentAjax")}}', 
      method:"POST",
      data:{
        "_token":'{{ csrf_token() }}',
        "idThanhToan":idThanhToan,
        
      },
      success: function(data){
          var status = '.thanhToanDienNuoc-'+idOrder;
          $(status).html(data);
        //alert(data);
      }
    });
  }
  function message(){
    swal("", "Chức năng này không hoạt động!", "warning");
  }
</script>
@endsection