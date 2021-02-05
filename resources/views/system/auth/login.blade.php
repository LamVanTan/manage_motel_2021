<!DOCTYPE html>
<html lang="en">
<head>
	<title>Quản lý hệ thống</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="http://localhost/motel/public/templates/system/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/motel/public/templates/system/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">		
		<div class="container-login100" >
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{route('system.auth.login')}}" method="POST">
					@csrf
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Đăng nhập hệ thống
					</span>
					@if(Session::has('msg'))
		              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
		           @endif
		           
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Tên đăng nhập">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Đăng nhập
						</button>
					</div>
					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Quên mật khẩu?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/vendor/bootstrap/js/popper.js"></script>
	<script src="http://localhost/motel/public/templates/system/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="http://localhost/motel/public/templates/system/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="http://localhost/motel/public/templates/system/login/js/main.js"></script>

</body>
</html>