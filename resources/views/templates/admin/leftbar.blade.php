        <!-- Navigation -->
        <ul class="navbar-nav" style="border-top:1px solid lightgray">
          <li class="nav-item   ">
            <a class="nav-link {{ Request::is('admin') ? 'active' : null }}" href="{{route('admin.index.index')}}">
              <i class="ni ni-tv-2 text-primary"></i> Tổng quan 
            </a>
          </li>
          
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('admin/order-Room') ? 'active' : null }}" href="{{route('admin.order.index')}}">
              <i class="ni ni-bullet-list-67 text-red"></i> Đơn đặt phòng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/customer') ? 'active' : null }}" href="{{route('admin.customer.index')}}">
              <i class="fas fa-users text-orange"></i> Khách hàng
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/floor') ? 'active' : null }}" href="{{route('admin.floor.index')}}">
              <i class="fas fa-hotel text-info"></i> Tầng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/room-type') ? 'active' : null }}" href="{{route('admin.roomtype.index')}}">
              <i class="fas fa-door-open text-success"></i> Loại phòng 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/service') ? 'active' : null }}" href="{{route('admin.service.index')}}">
              <i class="fab fa-servicestack text-yellow"></i> Dịch vụ 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/room') ? 'active' : null }}" href="{{route('admin.room.index')}}">
              <i class="fas fa-bed text-blue"></i> Phòng
            </a>
          </li>
         
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Documentation</h6>
        <!-- Navigation -->
       
      