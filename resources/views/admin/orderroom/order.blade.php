<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-purple">
          <h3 class="modal-title">Thông tin đặt phòng</h3>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="{{route('admin.index.addCheckRoom')}}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
              <div class="col-lg-12">
                <h5>Thông tin khách hàng</h5>
                <div class="row">
                  <div class="col-lg-4" >
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Tên đầy đủ</label>
                      <input type="text" class="form-control form-control-sm " name="fullname" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Số điện thoại</label>
                      <input type="number" class="form-control form-control-sm" name="phone" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">email</label>
                      <input type="email" class="form-control form-control-sm" name="email" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6" >
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Thành phố/Tỉnh</label>
                      <input type="text" class="form-control form-control-sm " name="city" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Quận/huyện</label>
                      <input type="text" class="form-control form-control-sm" name="district" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6" >
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Phường/xã</label>
                      <input type="text" class="form-control form-control-sm " name="ward" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Địa chỉ cụ thể</label>
                      <input type="text" class="form-control form-control-sm" name="address" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6" >
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Ngày sinh</label>
                      <input type="date" class="form-control form-control-sm " name="birthday" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email">Giới tính</label><br>  
                      <input type="radio"  name="gender" value="1" checked=""> Nam 
                      <input type="radio"  name="gender" value="0"> Nữ
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Số CMND</label>
                      <input type="number" class="form-control form-control-sm" name="identity" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Ngày cấp</label>
                      <input type="date" class="form-control form-control-sm" name="ngayCap" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Nơi cấp</label>
                      <input type="text" class="form-control form-control-sm" name="noiCap" placeholder="Điền vào đây" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6" >
                    <div class="form-group">
                      <label class="form-control-label" style="font-size: 12px !important;">Ảnh CMND mặt trước</label>
                      <div class="file-upload">
                        <div class="image-upload-wrap">
                          <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*"  name="fileCMND1"/>
                          <div class="drag-text">
                            <h5>Chọn ảnh CMND mặt trước vào đây</h5>
                          </div>
                        </div>
                        <div class="file-upload-content">
                          <img class="file-upload-image" src="#" alt="your image" />
                          <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Gỡ <span class="image-title"></span></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" style="font-size: 12px !important;">Ảnh CMND mặt sau</label>
                        <div class="file-upload-1">
                          <div class="image-upload-wrap-1">
                            <input class="file-upload-input-1" type='file' onchange="readURL1(this);" accept="image/*" name="fileCMND2"/>
                            <div class="drag-text-1">
                              <h5>Chọn ảnh CMND mặt sau vào đây</h5>
                            </div>
                          </div>
                          <div class="file-upload-content-1">
                            <img class="file-upload-image-1" src="#" alt="your image" />
                            <div class="image-title-wrap-1">
                              <button type="button" onclick="removeUpload1()" class="remove-image-1">Gỡ <span class="image-title-1"></span></button>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <h5>Thông tin phòng</h5>
                <div class="row">
                    <div class="col-lg-12 ">
                      <div class="form-group">
                        <label class="form-control-label" style="font-size: 12px !important;">Danh sách phòng đang trống</label>
                        <div style="border:1px solid #cec6c6; padding:5px; border-radius:5px; height:300px;  overflow-y: scroll;overflow-x: scroll;">
                         
                          @foreach($listFloorShare as $itemFloor)
                          @foreach($itemFloor->floor_room  as $itemRoom)
                          @if($itemRoom->id_floor)
                            <div class="row">
                            <div class="col-lg-12 mb-2">
                                <label class="btn btn-sm btn-white">
                                  <i  class="ni ni-building text-info"></i> 
                                  {{$itemFloor->name_floor}}
                                </label>
                            </div>
                            </div>
                            @break
                            @endif
                            @endforeach
                          <div class="row mb-5 mt-3" >
                            @foreach($listRoomShare as $itemRoom)
                              @if($itemFloor->id_floor == $itemRoom->id_floor)
                                <div class="col-lg-2 text-blue" >
                                  <input onchange="checkOutRoom({{$itemRoom->id_room}})" class="checkout" type="radio" value="{{$itemRoom->id_room}}" name="idRoom"> 
                                  {{$itemRoom->name_room}} 
                                  <i  class="fas fa-door-open fa-2x " onclick="showDetailRoom({{$itemRoom->id_room}})"></i>
                                </div>
                                {{-- modal chi tiet phòng --}}
                                <div class="modal " id="login-{{$itemRoom->id_room}}">
                                  <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">     
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Thông tin chi tiết phòng</h4>
                                        <button type="button" class="btn-sm btn-danger" id="close-{{$itemRoom->id_room}}">&times;</button>
                                      </div>    
                                      <!-- Modal body -->
                                      <div class="modal-body " style="text-align: center;">
                                        <div class="row">
                                          <div class="col-lg-4">Tên phòng : <b>{{$itemRoom->name_room}}</b></div>
                                          <div class="col-lg-4">Loại phòng : <b>{{$itemRoom->roomtype->name_roomtype}}</b></div>
                                          <div class="col-lg-4">Tầng : <b>{{$itemRoom->floor->name_floor}}</b></div>
                                        </div>
                                        <div class="row mt-4">
                                          <div class="col-lg-5">Số người ở phù hợp  : <br>  <b>{{$itemRoom->person_quantity}} người</b></div>
                                          <div class="col-lg-2"></div>
                                          <div class="col-lg-5">Diện tích căn phòng :<b> {{$itemRoom->area_room}}m2</b></div>
                                        </div>

                                        <div class="row mt-5">
                                          <div class="col-lg-6" id="me-{{$itemRoom->id_room}}">Giá phòng : <b>{{number_format($itemRoom->price_last,0,',','.')}} VND</b> </div>
                                          <div class="col-lg-6">
                                          </div>
                                        </div>

                                        {{-- hình ảnh --}}
                                        <div class="row">
                                          <div class="col-lg-12 p-5" >
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                              <div class="carousel-inner">
                                                @php $dem = 0; 
                                                    $adminImages = 'http://localhost/Motel/storage/app/public/files'; 
                                                @endphp
                                                @foreach($itemRoom->images as $img)
                                                <div class="carousel-item @if($dem == 0) active @endif">
                                                  <img class="d-block" width="100%" height="350" src="{{$adminImages}}/{{$img->name_images}}" >
                                                </div>
                                                @php $dem++; @endphp
                                                @endforeach
                                              
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        {{-- các dịch vụ --}}
                                        <div class="row">
                                          <div class="col-lg-12">
                                            <ul class="nav nav-tabs">
                                              <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#home">Dịch vụ </a>
                                              </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                              <div class="tab-pane container active" id="home">
                                                <div class="form-group">
                                                  <div class="row">             
                                                    @foreach($listServiceShare as $itemService)
                                                      <div class="col-lg-3">
                                                        <input type="checkbox" value="{{$itemService->id_service}}" 
                                                        @foreach($itemRoom->serviceRoom as $item)
                                                          @if($item->pivot->id_service == $itemService->id_service)
                                                            checked="" 
                                                            disabled  
                                                          @endif  
                                                        @endforeach
                                                        name="service-{{$itemRoom->id_room}}[]"> {{$itemService->name_service}}
                                                      </div>
                                                    @endforeach
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <hr class="my-4" />
                                        <div class="row">
                                          <div class="col-lg-12">
                                          <label class="btn btn-sm btn-success" onclick="updateService({{$itemRoom->id_room}},{{$itemRoom->price_last}})">Cập nhật dịch vụ</label>
                                          </div>
                                        </div>
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
              </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label" style="font-size: 12px !important;">Thời gian thuê phòng</label>
                        <select name="status" onchange="getPriceRoom()" id="rentalform" class="form-control form-control-alternative form-control-sm ">
                          <option > Mốc thời gian thuê</option>
                          @for($i = 1; $i<=12; $i++)
                              <option value="{{$i}}"> {{$i}} tháng</option>
                          @endfor
                          </select>
                    </div>
                </div>
           
                <div class="col-lg-3">
                    <div class="form-group" >
                        <label class="form-control-label" style="font-size: 12px !important;">Tiền phòng</label>
                        <input type="text" class="form-control form-control-sm " name="total" value="" id="total" readonly>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label" style="font-size: 12px !important;">Tiền cộc</label>
                        <input type="text" class="form-control form-control-sm " value="" id="money" onchange="InputMoney()" name="deposits" >
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label" style="font-size: 12px !important;">Tiền còn lại</label>
                        <input type="text" class="form-control form-control-sm " readonly name="moneyLast" id="moneylast" name="dateEnd" value="">
                    </div>
                </div>
            </div>
            
            <input type="submit" class="btn-sm btn-success "   value="Đặt phòng">  
          </form>
        </div>
      </div>
    </div>
  </div>



  <script>

    //show chi tiet phong
    function showDetailRoom(id_room){
      var modalShow = "#login-"+id_room;
      var closeRoom = '#close-'+id_room;
      $(modalShow).show(function(){
        $(closeRoom).click(function(){
          $(modalShow).hide(300);
        });
      });
    }

    ///dich vu
    function updateService(idRoom,price_room){
      var a = 'input[name="service-'+idRoom+'[]"]:checked';
      var text= new Array(); 
      $(a).each(function(){ 
        text.push($(this).val()); 
      });
       
      $.ajax({
          url:'{{route("admin.index.serviceUpdateAjax")}}', 
          method:"POST",
          data:{
              "_token":'{{ csrf_token() }}',
              "service":text,
              "idRoom":idRoom,
              "price_room":price_room
          },
          success:function(data){
             var status = '#me-'+idRoom;
              $(status).html(data);  
              //alert(data);
                  
          }
      });
    }
      
  
    //chonj phong
    function checkOutRoom(id_room){
      swal({
        text: "Chọn phòng thành công!",
        icon: "success",
        button: "Chấp nhận!",
      });  
    }

    //lay gia tri va tien database
    function getPriceRoom(){
        var rentalForm = $('#rentalform').val();
        var selected = $("input[type='radio'][name='idRoom']:checked");
        if (selected.length > 0) {
            var idRoom = selected.val(); 
            //alert(idRoom);
            $.ajax({
                url:'{{route("admin.index.ajaxRentalForm")}}', 
                method:"POST",
                data:{
                    "_token":'{{ csrf_token() }}',
                    "rentalForm":rentalForm,
                    "idRoom":idRoom
                },
                success:function(data){
                    $("#total").val(data);  
                    tinhTienPhong();
                    
                }
            });
            
        }else{
            swal({
                text: "Bạn chưa chọn phòng!",
                icon: "warning",
                button: "Chấp nhận!",
            });  
        }
    }

    function tinhTienPhong(){
      var input = $("#money").val();
        if(input.length > 0){
        var input = input.split(' ')[0];
        var input = input.replace(/\D/gm,"");
        var Total = $("#total").val();
        var TotalString = Total.split(' ')[0];
        var Total = Total.replace(/\D/gm,"");
        var moneyLast = Total - input;
        var moneyLast = moneyLast.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+' VND';
        $("#moneylast").val(moneyLast);
      }else{
        var Total = $("#total").val();
        var TotalString = Total.split(' ')[0];
        var Total = Total.replace(/\D/gm,"");
        var moneyLast = Total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+' VND';
        $("#moneylast").val(moneyLast);
      }
    }


    function InputMoney(){
        //$("#money").removeAttr('type','number');
        var input = $("#money").val();
        var regex=/^[0-9]+$/;
        //alert(regex);
        if(input.match(regex)){
            var output = input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+' VND';
            //$("#money").attr('type','text');
            $("#money").val(output);

             var Total = $("#total").val();
             var TotalString = Total.split(' ')[0];
             var Total = Total.replace(/\D/gm,"");
             var moneyLast = Total - input;
             var moneyLast = moneyLast.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+' VND';
             $("#moneylast").val(moneyLast);
        }else{
            

            var input = $("#money").val();
            var input = input.split(' ')[0];
            var input = input.replace(/\D/gm,"");

            var Total = $("#total").val();
            var Total = Total.split(' ')[0];
            var Total = Total.replace(/\D/gm,"");

            var moneyLast = Total - input;
            var moneyLast = moneyLast.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+' VND';
            $("#moneylast").val(moneyLast);
        }      
     }   
  </script>