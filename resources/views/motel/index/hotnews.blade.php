@foreach($getListRoomsPin as $itemRoomsPin)
@php
  $ngayHetHanPin = strtotime($itemRoomsPin->ngayHetHanPin); 
  $slug = Str::slug($itemRoomsPin->name_room);
  $publicImages = 'http://localhost/Motel/storage/app/public/files';  
@endphp
<div class="col-md-4 mb-2" >
<div class="row" style="border:1px solid rgb(197, 102, 102);  margin-left:1px; background:rgb(231, 222, 222);">
  <div class="col-md-4 pl-2 pr-2 pt-2"> 
    <a href="{{route('motel.room.detail',[$slug,$itemRoomsPin->id_room])}}">
      <img src="{{$publicImages}}/{{$itemRoomsPin->images[0]->name_images}}" alt="" style="width: 120px; height:85px;">
    </a>
  </div>

  <div class="col-md-7">
    <a href="{{route('motel.room.detail',[$slug,$itemRoomsPin->id_room])}}" class="m-0 p-0" style="color: rgb(197, 102, 102);display:block">Phòng cho thuê</a>
    <a href="{{route('motel.room.detail',[$slug,$itemRoomsPin->id_room])}}" class="text-success m-0 p-0" style="display:block">
      Giá: {{number_format($itemRoomsPin->price_last,0,',','.')}} vnđ/tháng
    </a>
    @foreach($getListUser as $itemUser)
      <a href="{{route('motel.room.detail',[$slug,$itemRoomsPin->id_room])}}" class="text-success m-0 p-0" style="display:block">
        @if($itemUser->id == $itemRoomsPin->MaTaiKhoan)
          Liên hệ: {{$itemUser->Admin->SDT}}
        @endif
      </a>
    @endforeach
    
  </div>
  <img src="http://localhost/Motel/public/templates/motel/hot-icon.gif" id="hot" alt="" class="mt-1" width="30" height="30">
  <div class="col-md-12 p-0 ml-2">
    @foreach($getListUser as $itemUser)
        <a href="{{route('motel.room.detail',[$slug,$itemRoomsPin->id_room])}}" style="color:  rgb(134, 133, 133);display:block; font-size:13px;word-wrap:break-word;">
          @if($itemUser->id == $itemRoomsPin->MaTaiKhoan)
            Địa chỉ: {{$itemUser->Admin->diaChi}}
          @endif
        </a>
    @endforeach
  </div>
</div>

</div>

<script>
function ajax(){
    var  idRoom = {{$itemRoomsPin->id_room}};
        $.ajax({
            url:'{{route("motel.room.timePinRooms")}}', 
            method:"POST",
            data:{
            "_token":'{{ csrf_token() }}',
            "idRoom":idRoom,
            },
            success: function(data){
                $('#PinRoom').html(data);
            }
    });
}
var readtime = setInterval(myTimer, 1000);
function myTimer() {
    var ngayHetHanPin = "{{$ngayHetHanPin}}";
    var aestTime = new Date().toLocaleString("en-US", {timeZone: "Asia/SaiGon"});
    var ngayHienTai = new Date(aestTime);  
    var ngayHienTai = Date.parse(ngayHienTai)/1000;
    //alert(ngayHienTai);
    if( ngayHienTai >= ngayHetHanPin ) {
        ajax();
        window.location.reload();
    clearInterval(myTimer,300);
    }
}

</script>

@endforeach