@extends('templates.motel.master')
@section('main-content')
        <div class="content mt-5">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-md-5">
                  <span class="d-block text-center my-4 text-muted"> Đăng ký với</span>
                  <div class="social-login text-center">
                    <a href="#" class="facebook btn btn-block">
                      <span class="icon-facebook mr-3"></span> 
                    </a>
                    <a href="#" class="twitter btn btn-block">
                      <span class="icon-twitter mr-3"></span> 
                    </a>
                    <a href="#" class="google btn btn-block">
                      <span class="icon-google mr-3"></span> 
                    </a>
                  </div>
      
                </div>
                <div class="col-md-2 text-center">
                  &mdash; hoặc &mdash;
                </div>
                <div class="col-md-5 contents">
                  <div class="form-block">
                  <div class="mb-4">
                        <h3>Đăng ký</h3>
                        <p class="mb-4">Đăng ký tài khoản để trải nghiệm các dịch vụ của chúng tôi</p>
                      </div>
                      <form action="{{route('motel.auth.register')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group first">
                          <label for="username">email</label>
                          <input type="text" class="form-control" name="email">
      
                        </div>
                        <div class="form-group last mb-4">
                          <label for="password">Mật khẩu</label>
                          <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group last mb-4">
                          <label for="password">Tên đầy đủ</label>
                          <input type="text" class="form-control" name="fullname">
                        </div>

                        <div class="form-group last mb-4">
                            <label for="password">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group last mb-2">
                            <label for="password">Địa chỉ</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group last">
                            <label for="password">Giới tính</label>
                            <input type="radio" name="gioitinh" value="1" class="control-input mt-5" checked> Nam
                            <input type="radio" name="gioitinh" value="0" class="control-input mt-5 ml-2" > Nữ
                        </div>
                        <div class="form-group last">
                            <label for="password">Các loại tài khoản dành cho bạn</label><br>
                            <input type="radio" value="0" name="taikhoan" class="control-input mt-5" id="khachhang" checked> Tài khoản khách hàng<br>
                            <input type="radio" value="1" name="taikhoan" class="control-input admin" onclick="TaiKhoanAdmin()" > Tài khoản quản lý trọ
                        </div>
                        
                        <div class="d-flex mb-5 align-items-center">
                          <span class=""><a href="{{route('motel.auth.login')}}" class="forgot-pass">Đăng nhập</a></span> 
                        </div>
                        <input type="submit" value="Đăng ký" class="btn btn-pill text-white btn-block btn-primary">
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
  
<script>
  function TaiKhoanAdmin(){
        swal("", "Tạo tài khoản quản lý phòng trọ để trải nghiệm trang web quản lý tốt nhất", "success");

        
  }
</script>
@endsection