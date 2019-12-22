<div class="sidebar">

<div class="sidebar-background"></div>
<div class="sidebar-wrapper scrollbar-inner">
  <div class="sidebar-content">
    <div class="user">
      <div class="avatar-sm float-left mr-2">
        <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
      </div>
      <div class="info">
        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
          <span>
            Hizrian
            <span class="user-level">Administrator</span>
            <span class="caret"></span>
          </span>
        </a>
        <div class="clearfix"></div>

        <div class="collapse in" id="collapseExample">
          <ul class="nav">
            <li>
              <a href="#profile">
                <span class="link-collapse">My Profile</span>
              </a>
            </li>
            <li>
              <a href="#edit">
                <span class="link-collapse">Edit Profile</span>
              </a>
            </li>
            <li>
              <a href="#settings">
                <span class="link-collapse">Settings</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item ">
        <a href="{{url('/')}}">
          <i class="fas fa-home"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#kependudukan">
          <i class="fas fa-layer-group"></i>
          <p>Kependudukan</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="kependudukan">
          <ul class="nav nav-collapse">
            <li>
              <a href="{{url('/kependudukan/wilayah')}}">
                <span class="sub-item">Data Wilayah</span>
              </a>
            </li>
            <li>
              <a href="{{url('kependudukan/penduduk')}}">
                <span class="sub-item">Data Penduduk</span>
              </a>
            </li>
            <li>
              <a href="{{url('kependudukan/keluarga')}}">
                <span class="sub-item">Data Keluarga</span>
              </a>
            </li>
            <li>
            <a href="{{url('kependudukan/kelahiran')}}">
                <span class="sub-item">Data Kelahiran</span>
              </a>
            </li>
            <li>
            <a href="{{url('kependudukan/kematian')}}">
                <span class="sub-item">Data Kematian</span>
              </a>
            </li>
            <li>
            <a href="{{url('kependudukan/pendatang')}}">
                <span class="sub-item">Data Pendatang</span>
              </a>
            </li>
            <li>
            <a href="{{url('kependudukan/pindah')}}">
                <span class="sub-item">Data Penduduk Pindah</span>
              </a>
            </li>
            <li>
            <a href="{{url('kependudukan/daftar-pemilih')}}">
                <span class="sub-item">Daftar Pemilih Tetap</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#surat">
          <i class="fas fa-pen-square"></i>
          <p>Surat</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="surat">
          <ul class="nav nav-collapse">
            <li>
              <a href="{{url('surat/format-surat')}}">
                <span class="sub-item">Format Surat</span>
              </a>
            </li>
            <li>
              <a href="surat/cetak_surat.html">
                <span class="sub-item">Cetak Surat</span>
              </a>
            </li>
            <li>
              <a href="surat/rekap_surat.html">
                <span class="sub-item">Rekap Surat</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a href="user/user.html">
          <i class="fas fa-user"></i>
          <p>User</p>
        </a>
      </li>
      <li class="nav-item ">
        <a href="staff/staff_desa.html">
          <i class="fas fa-users"></i>
          <p>Staff Desa</p>
        </a>
      </li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#laporan">
          <i class="far fa-chart-bar"></i>
          <p>Laporan</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="laporan">
          <ul class="nav nav-collapse">
            <li>
              <a href="laporan/lap_statistik.html">
                <span class="sub-item">Laporan Statistik Kependudukan</span>
              </a>
            </li>
            <li>
              <a href="laporan/lap_kelahiran.html">
                <span class="sub-item">Laporan Data Kelahiran</span>
              </a>
            </li>
            <li>
              <a href="laporan/lap_kematian.html">
                <span class="sub-item">Laporan Data Kematian</span>
              </a>
            </li>
            <li>
              <a href="laporan/lap_pendatang.html">
                <span class="sub-item">Laporan Data Pendatang</span>
              </a>
            </li>
            <li>
              <a href="laporan/lap_pindah.html">
                <span class="sub-item">Laporan Data Penduduk Pindah</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a data-toggle="collapse" href="#pengaturan">
          <i class="fas fa-bars"></i>
          <p>Pengaturan</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="pengaturan">
          <ul class="nav nav-collapse">
             <li>
              <a href="pengaturan/lap_pindah.html">
                <span class="sub-item">Identitas Desa</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
</div>