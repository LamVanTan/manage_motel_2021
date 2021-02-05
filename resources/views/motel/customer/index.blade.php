@extends('templates.motel.master')
@section('main-content')
  
    <section class="site-section pb-5">
      <div class="container">
        <div class="row align-items-center" >
         <div class="col-md-5">
             @php
                if($itemUser->admin->gioiTinh == 1) {
                    $gioiTinh = "Nam";
                }else{
                    $gioiTinh = "Nu";
                }
             @endphp
             <h5>Thông tin cá nhân</h5>
             <span>Tên: {{$itemUser->admin->tenDayDu}}</span>
             <span>Email: {{$itemUser->email}}</span>
             <span>Số điện thoại: {{$itemUser->admin->SDT}} </span>
             <span>Giới tính: {{$gioiTinh}} </span>
             <span>Địa chỉ: {{$itemUser->admin->diaChi}}</span>
         </div>
         <div class="col-md-7">
             <h5>Các hoá đơn</h5>
             
         </div>
        </div>
      </div>
    </section>
    <style>
        span{
            display: block;
            color: #000;
        }
    </style>
@endsection