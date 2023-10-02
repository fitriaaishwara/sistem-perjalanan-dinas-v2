<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src=" {{ url('assets/js/plugin/webfont/webfont.min.js') }}"></script>

	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ url('assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/atlantis.css') }}">
</head>
<body class="login">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
			<h1 class="title fw-bold text-white mb-3">Aplikasi Perjalanan Dinas</h1>
			<p class="subtitle text-white op-7">Kementerian Koperasi dan UKM</p>
		</div>
		<div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
			<div class="container container-login container-transparent animated fadeIn">
				<img src="https://khumkhum.com/wp-content/uploads/2022/09/Logo-Kemenkop-1.png" alt="Logo Kemenkop" class="img-fluid mb-5" width="300" height="100" style="margin-left: 4%;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-form">
                        <div class="form-group">
                            <label for="username" class="placeholder" ><b>Username</b></label>
                            <input id="username" name="username" type="text" class="form-control" :value="__('Username')" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="placeholder"><b>Password</b></label>
                            <a href="#" class="link float-right">Lupa Kata Sandi ?</a>
                            <div class="position-relative">
                                <input id="password" name="password" type="password" class="form-control" :value="__('Password')"  required>
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberme">
                                <label class="custom-control-label m-0" for="rememberme">Ingat Saya</label>
                            </div>
                            <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign In</button>
                        </div>
                    </div>
                </form>
			</div>

			<div class="container container-signup container-transparent animated fadeIn">
				<h3 class="text-center">Sign Up</h3>
				<div class="login-form">
					<div class="form-group">
						<label for="fullname" class="placeholder"><b>Fullname</b></label>
						<input  id="fullname" name="fullname" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email" class="placeholder"><b>Email</b></label>
						<input  id="email" name="email" type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="passwordsignin" class="placeholder"><b>Password</b></label>
						<div class="position-relative">
							<input  id="passwordsignin" name="passwordsignin" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="confirmpassword" class="placeholder"><b>Confirm Password</b></label>
						<div class="position-relative">
							<input  id="confirmpassword" name="confirmpassword" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="row form-sub m-0">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" name="agree" id="agree">
							<label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
						</div>
					</div>
					<div class="row form-action">
						<div class="col-md-6">
							<a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
						</div>
						<div class="col-md-6">
							<a href="#" class="btn btn-success w-100 fw-bold">Masuk</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<script src="../assets/js/atlantis.min.js"></script>
</body>
</html>
