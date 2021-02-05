<ul class="navbar-nav ml-auto pl-lg-5 pl-0 menu " >
    <li class="nav-item">
      <a class="nav-link " href="{{route('motel.index.index')}}">Trang Chủ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">Liên Hệ</a>
    </li>
     {{-- <li class="nav-item cta">
      <a class="nav-link" href=""><span>Đặt Phòng</span></a>
    </li> --}}
    @if(Auth::check())
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="rooms.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{Auth::user()->email}}
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdown04">
        @if(Auth::user()->permission == 1)
        <a class="dropdown-item" href="{{route('admin.index.index')}}"><i class="fas fa-user-shield"></i> Trang quản lý</a>
        @elseif(Auth::user()->permission == 0)
        <a class="dropdown-item" href="{{route('motel.customer.index')}}"><i class="fas fa-user-shield"></i>Thông tin khách hàng</a>
       
        @endif
        <a class="dropdown-item" href="{{route('motel.room.recharge')}}"><i class="fas fa-money-bill-alt"></i> Nạp tiền</a>
        <a class="dropdown-item" href="{{route('auth.auth.logout')}}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
      </div>
    </li>
    @else
    <li class="nav-item">
      <a class="nav-link" href="{{route('motel.auth.login')}}">Đăng nhập</a>
    </li>
    @endif
</ul>

<style type="text/css">
    
  header .navbar .nav-item .nav-link{
      color: white !important;
      font-size: 16px;
      font-weight: 300
  }
  header .navbar .nav-link.active {
      color: #0c0000 !important;
  }

  header .navbar .nav-link:hover {
    background: rgb(123, 153, 233) !important;
    
  }
</style>
