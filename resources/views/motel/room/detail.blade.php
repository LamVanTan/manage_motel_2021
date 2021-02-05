@extends('templates.motel.master')
@section('main-content')

    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-7 main-content">
            <h4 class="text-danger">Phòng cho thuê</h4>
            <h4 class="text-drak">
              @foreach($getListUser as $itemUser)
                @if($itemUser->id == $getItemRoom->MaTaiKhoan)
                  Địa chỉ: {{$itemUser->Admin->diaChi}}
                @endif
              @endforeach </h4>
            <h4 class="text-drak">Giá: {{number_format($getItemRoom->price_room,0,',','.')}} vnđ/tháng &nbsp; 
              @foreach($getListUser as $itemUser)
                @if($itemUser->id == $getItemRoom->MaTaiKhoan)
                  Liên hệ: {{$itemUser->Admin->SDT}}
                @endif
              @endforeach
            </h4>
           
            <div class="post-content-body">
              <div class="row">
                <div class="col-lg-12">
                  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      @php 
                        $dem = 0; 
                        $adminImages = 'http://localhost/Motel/storage/app/public/files'; 
                      @endphp
                      @foreach($getItemRoom->images as $img)
                      <div class="carousel-item @if($dem == 0) active @endif">
                        <img class="d-block" width="100%" height="350" src="{{$adminImages}}/{{$img->name_images}}" >
                      </div>
                      @php $dem++; @endphp
                      @endforeach
                
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-12">
                  <div style="border:1px solid gray;">
                    <h5 class="pl-2">Thông tin mô tả:</h5>
                    <p class="pl-2">{{$getItemRoom->detail_room}}</p>

                    <b class="p-2">Các tiện ích có trong phòng:<br>
                      @foreach($getItemRoom->serviceRoom as $item)  
                        &nbsp; &nbsp; - {{$item->name_service}}<br>
                      @endforeach
                    </b>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- END main-content -->
          <div class="col-md-12 col-lg-5 sidebar">
            <div class="sidebar-box">
              <h3 class="heading">Có thể bạn quan tâm</h3>
              @foreach($getListRoomUser as $itemRoomUser)
                @php
                    $slug = Str::slug($itemRoomUser->name_room);
                @endphp
                <div class="row mb-3 pt-2 pb-2 " style="border:1px solid gray;background:rgb(231, 222, 222);">
                  
                  <div class="col-md-4">
                    <a href="{{route('motel.room.detail',[$slug,$itemRoomUser->id_room])}}">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        @php 
                          $dem = 0; 
                          $adminImages = 'http://localhost/Motel/storage/app/public/files'; 
                        @endphp
                        @foreach($itemRoomUser->images as $img)
                        <div class="carousel-item @if($dem == 0) active @endif">
                          <img class="d-block" width="100%" style="height: 140px" src="{{$adminImages}}/{{$img->name_images}}" >
                        </div>
                        @php $dem++; @endphp
                        @endforeach
                      </div>
                    </div>
                    </a>
                  </div>
                  <div class="col-md-8">
                    <a href="{{route('motel.room.detail',[$slug,$itemRoomUser->id_room])}}">
                    <span class="text-danger" style="display: block;">Phòng cho thuê<br>
                      @foreach($getListUser as $itemUser)
                        @if($itemUser->id == $itemRoomUser->MaTaiKhoan)
                          Địa chỉ: {{$itemUser->Admin->diaChi}}<br>
                          Liên hệ: {{$itemUser->Admin->SDT}}<br>
                        @endif
                      @endforeach
                    </span>
                    <span class="text-success" style="display: block;">
                    Giá: {{number_format($itemRoomUser->price_room,0,',','.')}} vnđ/tháng
                    </span>
                    <a href="{{route('motel.room.detail',[$slug,$itemRoomUser->id_room])}}">
                  </div>
                </div>
          
              @endforeach
            </div>
            <!-- END sidebar-box -->
          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>
    <script>
      $('.carousel').carousel({
        interval: 2000
      })
    </script>
    
@endsection