        <!-- Navigation -->
        <ul class="navbar-nav" style="border-top:1px solid lightgray">
          <li class="nav-item   ">
            <a class="nav-link {{ Request::is('system') ? 'active' : null }}" href="{{route('system.index.index')}}">
              <i class="ni ni-tv-2 text-primary"></i> Tổng quan 
            </a>
          </li>
          
          <li class="nav-item ">
            <a class="nav-link {{ Request::is('system/user') ? 'active' : null }}" href="{{route('system.user.index')}}">
              <i class="ni ni-bullet-list-67 text-red"></i> Danh sách chủ trọ
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link {{ Request::is('system/bank-user') ? 'active' : null }}" href="{{route('system.bankUser.index')}}">
              <i class="ni ni-bullet-list-67 text-red"></i> Danh sách nạp tiền
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Documentation</h6>
        <!-- Navigation -->
       
      