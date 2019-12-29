<div class="main-header" data-background-color="purple">
  <!-- Logo Header -->
  <div class="logo-header">

    <a href="/" class="logo">
    <b><font color='white'> Sistem Informasi Desa </font></b>
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="fa fa-bars"></i>
      </span>
    </button>
    <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
    <div class="navbar-minimize">
      <button class="btn btn-minimize btn-rounded">
        <i class="fa fa-bars"></i>
      </button>
    </div>
  </div>
  <!-- End Logo Header -->
  <!-- Navbar Header -->
  <nav class="navbar navbar-header navbar-expand-lg">

    <div class="container-fluid">
      
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item toggle-nav-search hidden-caret">
        <li class="nav-item dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
              <font color='white'><i class="fa fa-cog"></i></font>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <li>
              <div class="user-box">
                <div class="u-text">
                  <h4>{{ Auth::user()->name }}</h4>
                  <p class="text-muted">{{ Auth::user()->email }}</p>
                  <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                </div>
              </div>
            </li>
            <li>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">My Profile</a>
              <a class="dropdown-item" href="#">Account Setting</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
</div>