<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Mã Đơn Đặt</th>
          <th scope="col">Tên khách hàng</th>
          <th scope="col">số điện thoại</th>
          <th scope="col">Ngày Đến</th>
          <th scope="col">Ngày Đi</th>
          <th scope="col">Tên phòng</th>
          <th scope="col">Tầng</th>
          <th scope="col">Giá Phòng</th>
          <th scope="col">Tiền Cộc</th>
          <th scope="col">Tiền Còn Lại</th>
          <th scope="col">Trạng Thái</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
            @foreach($listOrderRoom as $itemOrder) 
                @php 
                  if($itemOrder->trangThaiDonThue == 0){
                    $status_text = "btn btn-success btn-sm";
                    $tinhTrang = "Xác nhận";
                  }else{
                    $status_text = "btn btn-warning btn-sm";
                    $tinhTrang = "Đang thuê";
                    
                  }


                  if($itemOrder->customer->gender == 0){
                    $gender = "Nữ";
                  }else{
                    $gender = "Nam";
                  }

              @endphp
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      {{$itemOrder->id_order}}
                    </div>
                  </th>
                  <td>
                    {{$itemOrder->customer->fullname}}
                  </td>
                  <td>
                    {{$itemOrder->customer->phone}}
                  </td>
                  <td>
                    {{date('d-m-Y', strtotime($itemOrder->date_start))}}
                  </td>
                  <td>
                    {{date('d-m-Y', strtotime($itemOrder->date_end))}}
                  </td>
                  <td>
                    {{$itemOrder->room->name_room}}
                  </td>
                  <td>
                    {{$itemOrder->room->floor->name_floor}}
                  </td>
                  <td>
                    {{number_format($itemOrder->price_room,0,',','.')}} VND
                  </td>
                  <td>
                    {{number_format($itemOrder->deposits,0,',','.')}} VND
                  </td>
                  <td>
                    {{number_format($itemOrder->money_last,0,',','.')}} VND
                  </td>
                  
                  <td>
                    <span class="badge mr-4 statusOrder-{{$itemOrder->id_order}}">
                      <label class="{{$status_text}}" @if($itemOrder->trangThaiDonThue == 0) onclick="changeStatus({{$itemOrder->id_order}},{{$itemOrder->tinhTrangDonThue}})" @else onclick="message()" @endif>     
                          {{$tinhTrang}}
                    </label>
                    </span>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="javascript:void(0)" onclick="showDetailOrder({{$itemOrder->id_order}})">Xem Thông Tin</a>
                          <a class="dropdown-item" href="">Xóa</a>
                      </div>
                    </div>
                  </td>
                </tr>
              {{-- modal chi tiet phòng --}}
              <div class="modal " id="order-{{$itemOrder->id_order}}">
                <div class="modal-dialog modal-lg" style="border:1px solid #cec6c6; padding:5px; border-radius:5px; height:650px;  overflow-y: scroll;">
                  <div class="modal-content">     
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom:1px solid lightgray">
                      <h3 class="modal-title">Thông tin chi tiết đơn đặt phòng</h3>
                      <button type="button" class="btn-sm btn-success" id="closeX-{{$itemOrder->id_order}}">&times;</button>
                    </div>    
                    
                    <!-- Modal body -->
                    <div class="modal-body" style="text-align: center;">

                      <div class="row">
                        <div class="col-lg-6" >
                          <label class="float-left"><b>Mã đặt phòng:</b> {{$itemOrder->id_order}}</label> 
                        </div>
                        <div class="col-lg-6" >
                          <label class="float-right"><b>Giá phòng:</b> {{number_format($itemOrder->price_room,0,',','.')}} VND</label> 
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-lg-6" >
                          <label class="float-left"><b>Tiền cộc:</b> {{number_format($itemOrder->deposits,0,',','.')}} VND</label> 
                        </div>
                        <div class="col-lg-6" >
                          <label class="float-right"><b>Tiền còn lại:</b> {{number_format($itemOrder->money_last,0,',','.')}} VND</label> 
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-lg-6" >
                          <label class="float-left"><b>Ngày đến:</b> {{date('d-m-Y', strtotime($itemOrder->date_start))}}</label> 
                        </div>
                        <div class="col-lg-6" >
                          <label class="float-right"><b>Ngày đi:</b> {{date('d-m-Y', strtotime($itemOrder->date_end))}}</label> 
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-lg-6" >
                          <label class="float-left text-black"></label> 
                        </div>
                        <div class="col-lg-6">
                          <label class="float-right text-black"><b>Trạng thái:</b> {{$tinhTrang}}</label> 
                        </div>
                      </div>
                      <hr class="my-4" />
                      <h4>Thông tin khách hàng</h4>
                      <div class="row mt-3">
                        <div class="col-lg-6" >
                          <label class="float-left text-black"><b>Tên Khách hàng:</b> {{$itemOrder->customer->fullname}}</label> 
                        </div>
                        <div class="col-lg-6" >
                          <label class="float-right text-black"><b>Số điện thoại:</b> {{$itemOrder->customer->phone}}</label> 
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-lg-12" >
                          <label class="float-left text-black"><b>Địa chỉ:</b> {{$itemOrder->customer->address}}</label> 
                        </div>
                      </div>
                      
                      <div class="row mt-2">
                        <div class="col-lg-6" >
                          <label class="float-left text-black"><b>Giới tính:</b> {{$gender}}<label> 
                        </div>
                        <div class="col-lg-6" >
                          <label class="float-right text-black"><b>Số CMND:</b> {{$itemOrder->customer->identity_number}}</label> 
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-lg-6" >
                          <label class="float-left text-black"><b>Ngày Cấp:</b>{{date('d-m-Y', strtotime($itemOrder->customer->ngayCap))}} <label> 
                        </div>
                        <div class="col-lg-6" >
                          <label class="float-right text-black"><b>Nơi Cấp:</b> {{$itemOrder->customer->noiCap}} </label> 
                        </div>
                      </div>
                      
                     
                      {{-- hình ảnh --}}
                      <div class="row mt-2">
                      @foreach($itemOrder->customer->imagesCustomer as $key => $item)
                      @php 
                          $adminImages = 'http://localhost/Motel/storage/app/public/filesCustomer';
                          
                          $anh = $adminImages.'/'.$item['name_images'];  
                      @endphp
                        <div class="col-lg-6" >
                            <img class="d-block" width="100%" height="350" src="{{$anh}}" >
                        </div>
                        @endforeach
                      </div>
                      <hr class="my-4" />
                      <h4>Thông tin phòng</h4>
                      <div class="row mt-3">
                        <div class="col-lg-4" >
                          <label class="float-left text-black"><b>Tên phòng:</b> {{$itemOrder->room->name_room}}<label> 
                        </div>
                        <div class="col-lg-4" >
                          <label class=" text-black"><b>Loại phòng:</b> {{$itemOrder->room->roomType->name_roomtype}}</label> 
                        </div>
                        <div class="col-lg-4" >
                          <label class="float-right text-black"><b>Tầng:</b> {{$itemOrder->room->floor->name_floor}}</label> 
                        </div>
                      </div>
                      {{-- hình ảnh --}}
                      <div class="row mt-2">
                        <div class="col-lg-12 pl-5 pr-5 pt-2" >
                          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                              @php $dem = 0; 
                                  $adminImages = 'http://localhost/Motel/storage/app/public/files'; 
                              @endphp
                              @foreach($itemOrder->room->images as $img)
                              <div class="carousel-item @if($dem == 0) active @endif">
                                <img class="d-block" width="100%" height="350" src="{{$adminImages}}/{{$img->name_images}}" >
                              </div>
                              @php $dem++; @endphp
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-3">
                        <div class="col-lg-12">
                          <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#home">Các thiết bị có trong phòng</a>
                            </li>
                          </ul>
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                              <div class="form-group">
                                <div class="row mt-4">             
                                  @foreach($itemOrder->orderRoomDetail as $itemDetail)
                                    <div class="col-lg-3">
                                      @foreach($listService as $item)
                                      @if($item->id_service == $itemDetail->id_service)
                                      <input type="checkbox"
                                        @if($item->id_service == $itemDetail->id_service)
                                          checked=""  
                                        @endif >  {{$item->name_service}}
                                      @endif
                                      @endforeach
                                    </div>
                                  @endforeach
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

            @endforeach
        </tbody>
    </table>
  </div>