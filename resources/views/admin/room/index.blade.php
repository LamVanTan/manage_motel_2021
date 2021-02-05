@extends('templates.admin.master')
@section('main-content')
<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0 bg-green">
              <h3 class="mb-0">Danh sách phòng</h3>
              <a href="{{route('admin.room.add')}}" class="btn btn-sm float-right btn-white text-green">Thêm Mới</a>
            </div>
            @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
            @endif
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Tên phòng</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tầng</th>
                    <th scope="col">Loại phòng</th>
                    <th scope="col">Giá phòng</th>
                    <th scope="col">Diện Tích</th>
                    <th scope="col">Số lượng người phù hợp</th>
                    <th scope="col">Đưa Top</th>
                    <th scope="col">Dịch vụ</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listRoom as $itemRoom)
                  @php
                      $idRoom = $itemRoom->id_room;
                      $nameRoom = $itemRoom->name_room;
                      $areaRoom = $itemRoom->area_room;
                      $personRoom = $itemRoom->person_quantity;
                      $priceRoom = $itemRoom->price_room;
                      if($itemRoom->status_room == 1){
                        $statusRoom = 'Hiện';
                        $online = "bg-success";
                        $status_text = "btn btn-success btn-sm";
                      }else{
                        $statusRoom = 'Ẩn';
                        $online = "bg-warning";
                        $status_text = "btn btn-warning btn-sm";
                      }

                      if($itemRoom->condition_room == 0){
                        $conditionRoom = 'Trống';

                        $statusText = "btn btn-success btn-sm";
                      }else{
                        $conditionRoom = 'Đã thuê';
                        $statusText = "btn btn-warning btn-sm";
                      }

                      if($itemRoom->PinRooms == 0){
                        $pinRooms = "Đưa top";
                        $pin = "btn btn-danger btn-sm";
                      }else{
                        $pinRooms = "Đã pin";
                        $pin = "btn btn-success btn-sm";
                      }

                      $adminImages = '/public/templates';
                      
                  @endphp
                    
                  <tr>
                    <td>
                      {{$nameRoom}}
                    </td>
                    <td>
                     
                      <div class="slider-img">
                       @php $dem = 1; @endphp
                       @foreach($itemRoom->images as $img) 
                          <a href="#slide-{{$idRoom}}-{{$dem}}">{{$dem}}</a>
                          @php $dem +=1; @endphp
                       @endforeach
                       <div class="slides-img">
                        @php $i = 1; @endphp
                        @foreach($itemRoom->images as $img)
                          <div id="slide-{{$idRoom}}-{{$i}}">
                            <img class="rounded" src="{{$adminImages}}/{{$img->name_images}}" style="width: 165px; height:120px;" >
                          </div>
                        @php $i++; @endphp
                        @endforeach
                         </div>
                       </div>
                      
                    </td>
                    <td>
                      {{$itemRoom->floor->name_floor}}
                    </td>
                    <td>
                      {{$itemRoom->roomType->name_roomtype}}
                    </td>
                    <td>
                      {{number_format($priceRoom,0,',','.')}}VND
                    </td>
                    <td>
                      {{$areaRoom}}/m2
                    </td>
                    <td>
                      {{$personRoom}} Người/Phòng
                    </td>
                    @php 
                      if($itemRoom->condition_room == 1){
                        $pinRooms = "vô hiệu";
                        $pin = "btn btn-white btn-sm";
                      }
                    @endphp
                    
                    <td>
                      <span class="badge mr-4 pinRooms-{{$idRoom}}">
                        <label class="{{$pin}}" @if($itemRoom->PinRooms == 0 && $itemRoom->condition_room == 0 ) onclick="statusPin({{$idRoom}},{{$itemRoom->PinRooms}})" @endif >{{$pinRooms}}</label>
                      </span>
                    </td>
                    
                    <td>
                      @foreach($itemRoom->serviceRoom as $item)  
                        <label class="btn btn-success btn-sm" style="display: block;width:65px">{{$item->name_service}}</label>
                      @endforeach
                    </td>
                    
                    <td>
                      <span class="badge mr-4 ">
                        <label class="{{$statusText}}">{{$conditionRoom}}</label>
                      </span>
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4 statusRoom-{{$idRoom}}">
                        <i class="{{$online}}"></i> 
                        <label class="{{$status_text}}" onclick=" statusRoom({{$idRoom}},{{$itemRoom->status_room}})">
                          {{$statusRoom}}
                        </label>
                      </span>
                    </td>
                    
                  
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="{{route('admin.room.edit',[$idRoom])}}">Sửa</a>
                          <a class="dropdown-item" href="{{route('admin.room.delete',[$idRoom])}}">Xóa</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  {{$listRoom->links()}}
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
   
      <script type="text/javascript">
        function statusRoom(idRoom,statusRoom){
          $.ajax({
          url:'{{route("admin.room.ajaxstatus")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "idRoom":idRoom,
            "statusRoom":statusRoom
          },
          success: function(data){
              var status = '.statusRoom-'+idRoom;
              $(status).html(data);
            //alert(data);
          }
        });
        }
        function statusPin(idRoom,pinRooms){
            $.ajax({
            url:'{{route("admin.room.pinRooms")}}', 
            method:"POST",
            data:{
              "_token":'{{ csrf_token() }}',
              "idRoom":idRoom,
              "pinRooms":pinRooms
            },
            success: function(data){
                var status = '.pinRooms-'+idRoom;
                if(data == 1){
                  alert('Số dư trong tài khoản thực hiện chức năng Pin phòng này.\ Mong bạn nạp tiền để thực hiện chức năng này - 5000/lượt');
                }else{
                  $(status).html(data);
                    alert('Bài viết của bạn đã được pin thời gian pin trong vòng 3 ngày');
                }   
                myVar = setTimeout(load, 1500);
            },
            error: function(data){
              alert(data);
            },
          });
        }

        function load() {
          window.location.reload();
        }

        
      </script>
@endsection