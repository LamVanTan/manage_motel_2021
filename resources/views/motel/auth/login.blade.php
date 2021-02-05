@extends('templates.motel.master')
@section('main-content')
  <div class="content mt-5">
    <div class="container">
      @if(Session::has('msg'))
          <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
        @endif
      <div class="row align-items-center">
        
        <div class="col-md-5">
          <span class="d-block text-center my-4 text-muted"> Đăng nhập với</span>
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
                <h3>Đăng nhập</h3>
                <p class="mb-4">Đăng nhập để trải nghiệm các dịch vụ của chúng tôi</p>
              </div>
              <form action="{{route('motel.auth.login')}}" method="post">
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
                  <label for="username">Tên đăng nhập</label>
                  <input type="text" class="form-control" id="username" name="username">

                </div>
                <div class="form-group last mb-4">
                  <label for="password">Mật khẩu</label>
                  <input type="password" class="form-control" id="password" name="password">
                  
                </div>
                
                <div class="d-flex mb-5 align-items-center">
                  <span class=""><a href="#" class="forgot-pass">Quên mật khẩu</a></span> 
                  <span class="ml-auto"><a href="{{route('motel.auth.register')}}" class="forgot-pass">Đăng ký tài khoản</a></span> 
                </div>
                <input type="submit" value="Đăng nhập" class="btn btn-pill text-white btn-block btn-primary">
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection