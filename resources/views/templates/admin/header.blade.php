<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Quản lý phòng trọ
  </title>
  <!-- Favicon -->
  
  <link href="/templates/admin/img/brand/favicon.ico" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="/templates/admin/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/templates/admin/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="/templates/admin/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <link href="/templates/admin/css/customs.css" rel="stylesheet" />
  <link href="/templates/admin/css/fileupload.css" rel="stylesheet" />
  {{-- ChartScript --}}
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
  #container {
      height: 400px;
  }

  .highcharts-figure, .highcharts-data-table table {
      min-width: 310px;
      max-width: 800px;
      margin: 1em auto;
  }

  #datatable {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #EBEBEB;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
  }
  #datatable caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
  }
  #datatable th {
    font-weight: 600;
      padding: 0.5em;
  }
  #datatable td, #datatable th, #datatable caption {
      padding: 0.5em;
  }
  #datatable thead tr, #datatable tr:nth-child(even) {
      background: #f8f8f8;
  }
  #datatable tr:hover {
      background: #f1f7ff;
  }
</style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="/public/templates/admin/index.html">
        <img src="/public/templates/admin/img/brand/blue.png" class="navbar-brand-img" alt="...">
        <b style="display: block;color:slateblue;font-size:14px">Nơi dừng chân lý tưởng</b>
      </a>
      
      <p class="navbar-brand pt-0" style="font-size: 15px">
        <b>Số dư tài khoản</b><br>
       <b>@if($soDuTaiKhoan == false)
          0
          @else
          {{number_format($soDuTaiKhoan->soDuTaiKhoan,0,',','.')}} 
          @endif
          VND
        </b>
      </p>
      <hr class="my-1" />
      
      <!-- User -->
     
      
      <!-- leftbar -->
      @include('templates.admin.leftbar')
      {{-- </div> --}}
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Chủ Trọ</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="http://localhost/Motel/public/templates/admin/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">@if(Auth::check()) {{Auth::user()->email}} @endif</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Chào mừng!</h6>
              </div>
              <a href="{{route('motel.index.index')}}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Quay lại trang người dùng</span>
              </a>
              <a href="{{route('motel.room.recharge')}}" class="dropdown-item">
                <i class="fas fa-money-bill-alt"></i>
                <span>Nạp tiền</span>
              </a>
              <a href="" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Hỗ trợ</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{route('auth.auth.logout')}}" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Đăng Xuất</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng Đơn đặt phòng</h5>
                      <span class="h3 font-weight-bold mb-0">{{$total_Order}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-door-open"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng Số Khách hàng</h5>
                      <span class="h3 font-weight-bold mb-0">{{$total_Customer}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class=" fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng Doanh Thu</h5>
                      <span class="h3 font-weight-bold mb-0">{{number_format($total_price_DT,0,',','.')}} VND</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng số chi</h5>
                      <span class="h3 font-weight-bold mb-0">{{number_format($total_price_DN,0,',','.')}} VND</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-sm bg-danger mt-2" data-toggle="modal" data-target="#myModal">Đặt phòng</button>
          <!-- The Modal -->
          @include('admin.orderroom.order')

        </div>
      </div>
    </div>
    
   
  <div class="container-fluid mt--7">
  @yield('main-content')