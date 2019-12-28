<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>SID</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

  <!-- Fonts and icons -->
  <script src="{{asset('app-asset/js/plugin/webfont.min.js')}}"></script>
  <script>
    WebFont.load({
      google: { "families": ["Open+Sans:300,400,600,700"] },
      custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{asset("app-asset/css/fonts.css")}}'] },
      active: function () {
        sessionStorage.fonts = true;
      }
    });
  </script>
	
	<!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('app-asset/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('app-asset/css/azzara.min.css')}}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In </h3>
			<div class="login-form">
				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label class="custom-control-label" for="rememberme">Remember Me</label>
					</div>
				</div>
				<div class="form-action mb-3">
					<a href="#" class="btn btn-primary btn-rounded btn-login">Sign In</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>