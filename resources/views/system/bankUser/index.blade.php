@extends('templates.system.master')
@section('main-content')
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-0 bg-green">
        <div class="row">
            <h3 class="mb-0">Danh sách khách hàng nộp tiền vào ứng dụng</h3>
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
              <th scope="col">Ngày nạp tiền</th>
              <th scope="col">Số tiền nạp</th>
            </tr>
          </thead>
          <tbody>
            @foreach($listUser as $item)
              <tr>
                <td>{{$item->admin->idAdmin}}</td>
                <td>{{$item->admin->tenDayDu}}</td>
                <td>{{date('d-m-Y', strtotime($item->bank->ngayNap))}}</td>
                <td>{{number_format($item->bank->soTienNap,0,',','.')}} VNĐ</td>
              </tr>
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