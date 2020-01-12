

<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head')
</head>
<body>
  <div class="wrapper">
    <!--Header -->
    @include('includes.header')
     <!--Ednd Header -->

    <!-- Sidebar -->
    @include('includes.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">
        @yield('content')

    </div>
  </div>
  </div>
  <div id="loading">
  <div class="loading">
  </div>
  <br/>
  Loading ...
   </div>
  @include('includes.footer')
</body>
</html>
