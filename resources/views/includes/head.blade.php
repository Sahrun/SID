<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>SID</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="{{asset('app-asset/js/core/jquery.3.2.1.min.js')}}"></script>
  <script src="{{asset('app-asset/js/plugin/webfont.min.js')}}"></script>
  <script src="{{asset('app-asset/js/custome.js')}}"></script>
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
  <link rel="stylesheet" href="{{asset('app-asset/css/style.css')}}">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <!-- <link rel="stylesheet" href="assets/css/demo.css"> -->