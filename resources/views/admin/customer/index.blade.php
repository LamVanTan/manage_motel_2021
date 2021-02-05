@extends('templates.admin.master')
@section('main-content')
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-0 bg-green">
        <div class="row">
            <h3 class="mb-0">Danh sách khách hàng</h3>
        </div>
      </div>
      @if(Session::has('msg'))
        <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
      @endif
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Mã khách hàng</th>
              <th scope="col">Tên khách hàng</th>
              <th scope="col">số điện thoại</th>
              <th scope="col">email</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Số chứng minh</th>
              <th scope="col">Ngày cấp </th>
              <th scope="col">Nơi Cấp</th>
              <th scope="col">Ngày sinh</th>
              <th scope="col">Giới tính</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
                @foreach($listOrderRoom as $item)
                    <tr>
                      <th scope="row">
                        <div class="media align-items-center">
                          {{$item->customer->id_customer}}
                        </div>
                      </th>
                      <td>
                        {{$item->customer->fullname}}
                      </td>
                      <td>
                        {{$item->customer->phone}}
                      </td>
                      <td>
                        {{$item->customer->email}}
                      </td>
                      <td>
                        {{$item->customer->address}}
                      </td>
                      <td>
                        {{$item->customer->identity_number}}
                      </td>
                      <td>
                        {{date('d-m-Y', strtotime($item->customer->ngayCap))}}
                      </td>
                      <td>
                        {{$item->customer->noiCap}}
                      </td>
                      <td>
                        {{date('d-m-Y', strtotime($item->customer->birthday))}}
                      </td>
                      <td>
                        @if($item->customer->gender == 1 ) Nam @else Nữ @endif
                      </td>
                     
                      
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a class="dropdown-item" href="javascript:void(0)" >Xem Thông Tin</a>
                              <a class="dropdown-item" href="">Xóa</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  {{-- modal chi tiet phòng --}}
                 
                  @endforeach
              
            </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
           
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
   <style>
     b{
       font-size: 14px !important;
     }
   </style>
      
@endsection