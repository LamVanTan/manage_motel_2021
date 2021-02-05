@extends('templates.motel.master')
@section('main-content')
<!-- @php 
	  if(Session::has('msg')){
         $mess = Session::get('msg');
     }
 @endphp -->
  
    <section class="site-section pb-5">
      <div class="container">
        <h5>Tin nổi bật</h5><p id="demo"></p>

        <div class="row align-items-center" id="PinRoom">
          @include('motel.index.hotnews')       
          
        </div>

      </div>
    </section>
    <!-- END section -->

    {{-- <section class="site-section bg-light pt-4">
      <div class="container">
        <div class="row align-items-center">
          @foreach($getListRooms as $itemRooms)
          @php
            $publicImages = 'http://localhost/Motel/storage/app/public/files';  
            $slug = Str::slug($itemRooms->name_room);
          @endphp
          <div class="col-md-4 mb-2">
            <div class="row" style="border:1px solid rgb(172, 209, 216);  margin-left:1px; background:rgb(231, 222, 222);">
              <div class="col-md-4 pl-2 pr-2 pt-2"> 
                <a href="{{route('motel.room.detail',[$slug,$itemRooms->id_room])}}">
                  <img src="{{$publicImages}}/{{$itemRooms->images[0]->name_images}}" alt="" style="width: 120px; height:85px;">
                </a>
              </div>
            
              <div class="col-md-7">
                <a href="{{route('motel.room.detail',[$slug,$itemRooms->id_room])}}" class="m-0 p-0" style="color: rgb(197, 102, 102);display:block">Phòng cho thuê</a>
                <a href="{{route('motel.room.detail',[$slug,$itemRooms->id_room])}}" class="text-success m-0 p-0" style="display:block">
                  Giá: {{number_format($itemRooms->price_last,0,',','.')}} vnđ/tháng
                </a>
                @foreach($getListUser as $itemUser)
                  <a href="{{route('motel.room.detail',[$slug,$itemRooms->id_room,])}}" class="text-success m-0 p-0" style="display:block">
                    @if($itemUser->id == $itemRooms->MaTaiKhoan)
                      Liên hệ: {{$itemUser->Admin->SDT}}
                    @endif
                  </a>
                @endforeach
                
              </div>
             
              <div class="col-md-12 p-0 ml-2">
                @foreach($getListUser as $itemUser)
                    <a href="{{route('motel.room.detail',[$slug,$itemRooms->id_room])}}" style="color:  rgb(134, 133, 133);display:block; font-size:13px;word-wrap:break-word;">
                      @if($itemUser->id == $itemRooms->MaTaiKhoan)
                        Địa chỉ: {{$itemUser->Admin->diaChi}}
                      @endif
                    </a>
                @endforeach
              </div>
            </div>
            
            </div>
            
          @endforeach
          
        </div>
      </div>
    </section> --}}
  <script>
    var myVar = setInterval(myTimer, 1000);
    function myTimer() {
      var d = new Date();
      var t = d.toLocaleTimeString();
      document.getElementById("demo").innerHTML = t;
    }

  </script>
    <!-- END section -->
@endsection