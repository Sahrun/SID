<div class="sidebar">

<div class="sidebar-background"></div>
<div class="sidebar-wrapper scrollbar-inner">
  <div class="sidebar-content">
    <div class="user">
      <div class="avatar-sm float-left mr-2">
        <img src="{{url('')}}/user.png" alt="..." class="avatar-img rounded-circle">
        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
      </div>
      <div class="info">
        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
          <span>
          <h4>{{ Auth::user()->name }}</h4>
            <span class="user-level">{{ Auth::user()->email}}</span>
            <span class="caret"></span>
          </span>
        </a>
        <div class="clearfix"></div>

        <div class="collapse in" id="collapseExample">
          <ul class="nav">
          <li>
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
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item" id="dashboard">
        <a href="{{url('/')}}">
          <i class="fas fa-home"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item" id="kependudukan">
        <a data-toggle="collapse" href="#kependudukan-menu" id="kependudukan-sub">
          <i class="fas fa-layer-group"></i>
          <p>Kependudukan</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="kependudukan-menu">
          <ul class="nav nav-collapse">
            <li id="wilayah">
              <a href="{{url('/kependudukan/wilayah')}}">
                <span class="sub-item">Data Wilayah</span>
              </a>
            </li>
            <li id="penduduk">
              <a href="{{url('kependudukan/penduduk')}}">
                <span class="sub-item">Data Penduduk</span>
              </a>
            </li>
            <li id="keluarga">
              <a href="{{url('kependudukan/keluarga')}}">
                <span class="sub-item">Data Keluarga</span>
              </a>
            </li>
            <li id="kelahiran">
              <a href="{{url('kependudukan/kelahiran')}}">
                  <span class="sub-item">Data Kelahiran</span>
              </a>
            </li>
            <li id="kematian">
              <a href="{{url('kependudukan/kematian')}}">
                <span class="sub-item">Data Kematian</span>
              </a>
            </li>
            <li id="pendatang">
              <a href="{{url('kependudukan/pendatang')}}">
                <span class="sub-item">Data Pendatang</span>
              </a>
            </li>
            <li id="penduduk-pindah">
            <a href="{{url('kependudukan/penduduk-pindah')}}">
                <span class="sub-item">Data Penduduk Pindah</span>
              </a>
            </li>
            <li id="pemilih-tetap">
              <a href="{{url('kependudukan/pemilih-tetap')}}">
                <span class="sub-item">Daftar Pemilih Tetap</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @if(Auth::user()->user_role_id == 1)
      <li class="nav-item" id="surat">
        <a data-toggle="collapse" href="#surat-menu" id="surat-sub">
          <i class="fas fa-pen-square"></i>
          <p>Surat</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="surat-menu">
          <ul class="nav nav-collapse">
            <li id="format-surat">
              <a href="{{url('surat/format-surat')}}">
                <span class="sub-item">Format Surat</span>
              </a>
            </li>
            <li id="daftar-cetak-surat">
              <a href="{{url('surat/daftar-cetak-surat')}}">
                <span class="sub-item">Cetak Surat</span>
              </a>
            </li>
            <li id="rekap-surat">
              <a href="{{url('surat/rekap-surat')}}">
                <span class="sub-item">Rekap Surat</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item " id="staff">
      <a href="{{url('/staff')}}">
          <i class="fas fa-users"></i>
          <p>Staff Desa</p>
        </a>
      </li>
      <li class="nav-item " id="user">
        <a href="{{url('/user')}}">
          <i class="fas fa-user"></i>
          <p>Users</p>
        </a>
      </li>
      @endif
      <li class="nav-item" id="lap">
        <a data-toggle="collapse" href="#lap-menu" id="lap-sub">
          <i class="far fa-chart-bar"></i>
          <p>Laporan</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="lap-menu">
          <ul class="nav nav-collapse">
            <li id="statistik">
              <a href="{{url('lap/statistik')}}">
                <span class="sub-item">Laporan Statistik Kependudukan</span>
              </a>
            </li>
            <li id="lap-kelahiran">
              <a href="{{url('lap/lap-kelahiran')}}">
                <span class="sub-item">Laporan Data Kelahiran</span>
              </a>
            </li>
            <li id="lap-kematian">
              <a href="{{url('lap/lap-kematian')}}">
                <span class="sub-item">Laporan Data Kematian</span>
              </a>
            </li>
            <li id="lap-pendatang">
              <a href="{{url('lap/lap-pendatang')}}">
                <span class="sub-item">Laporan Data Pendatang</span>
              </a>
            </li>
            <li id="lap-penduduk-pindah">
              <a href="{{url('lap/lap-penduduk-pindah')}}">
                <span class="sub-item">Laporan Data Penduduk Pindah</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @if(Auth::user()->user_role_id == 1)
      <li class="nav-item" id="pengaturan">
        <a data-toggle="collapse" href="#pengaturan-menu" id="pengaturan-sub">
          <i class="fas fa-cog"></i>
          <p>Pengaturan</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="pengaturan-menu">
          <ul class="nav nav-collapse">
            <li id="identitas">
              <a href="{{url('/pengaturan/identitas')}}">
                <span class="sub-item">Identitas Desa</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif
    </ul>
  </div>
</div>
</div>

<script>
var path = window.location.pathname;

if(path == "/" || path == "/dashboard")
{
  $("#dashboard").addClass("active");
}else
{
  path = path.replace(/\/+$/, '');
  path = path[0] == '/' ? path.substr(1) : path;
  var path_split = path.split("/");

  $("#"+path_split[0]+"").addClass("active");
  $("#"+path_split[0]+"").addClass("submenu");
  $("#"+path_split[0]+"-sub").attr("aria-expanded","true");
  $("#"+path_split[0]+"-menu").addClass("show");
  $("#"+path_split[1]+"").addClass("active");
}

</script>