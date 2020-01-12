@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Cetak Surat</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Surat Kematian</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('surat/cetak-surat-kematian/')}}" >
                            @csrf
                            <input type="hidden" value="{{$kode_surat}}" name="kode_surat" />
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Penduduk</b></label>
								<div class="col-md-9 p-0">
                                <div class="autocomplete" style="width:300px;">
                                    <input id="input-auto-coplate" type="text" placeholder="NIK / Nama" class="form-control input-full" required>
                                    <input type="hidden" name="penduduk_id" id="penduduk_id" required/>
                                </div>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nomor Surat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nomor_surat" placeholder="Nomor Surat" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Pelapor</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="nama_pelapor" placeholder="Nama Pelapor" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nik_pelapor" placeholder="NIK">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir Pelapor</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tanggal_lahir_pelapor" id="tanggal_lahir" onchange="validasitanggal()"> <br/>
                                    <span id="error_tgl_lahir" class="text-danger"></span>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pekerjaan Pelapor</b></label>
								<div class="col-md-9 p-0">
                                    <select name="pekerjaanpelapor" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="BELUM/TIDAK BEKERJA">BELUM/TIDAK BEKERJA </option>
                                        <option value="MENGURUS RUMAH TANGGA"> MENGURUS RUMAH TANGGA </option>
                                        <option value="PELAJAR/MAHASISWA"> PELAJAR/MAHASISWA </option>
                                        <option value="PENSIUNAN"> PENSIUNAN </option>
                                        <option value="PEGAWAI NEGERI SIPIL (PNS)"> PEGAWAI NEGERI SIPIL (PNS) </option>
                                        <option value="TENTARA NASIONAL INDONESIA (TNI)"> TENTARA NASIONAL INDONESIA (TNI) </option>
                                        <option value="KEPOLISIAN RI (POLRI)"> KEPOLISIAN RI (POLRI) </option>
                                        <option value="PERDAGANGAN"> PERDAGANGAN </option>
                                        <option value="PETANI/PEKEBUN"> PETANI/PEKEBUN </option>
                                        <option value="KARYAWAN SWASTA"> KARYAWAN SWASTA </option>
                                        <option value="KARYAWAN HONORER"> KARYAWAN HONORER </option>
                                        <option value="BURUH HARIAN LEPAS"> BURUH HARIAN LEPAS </option>
                                        <option value="PEMBANTU RUMAH TANGGA"> PEMBANTU RUMAH TANGGA </option>
                                        <option value="SENIMAN"> SENIMAN </option>
                                        <option value="GURU"> GURU </option>
                                        <option value="KONSULTAN"> KONSULTAN </option>
                                        <option value="DOKTER"> DOKTER </option>
                                        <option value="PERANGKAT DESA"> PERANGKAT DESA </option>
                                        <option value="WIRASWASTA"> WIRASWASTA </option>
                                        <option value="LAINNYA"> LAINNYA </option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat Pelapor</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="alamat_pelapor" placeholder="Alamat Pelapor">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Hubungan Pelapor</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="hubungan_pelapor" placeholder="Hubungan Pelapor">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Keperluan</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control" name="hal" required>
                                 </div>
							</div>
                           
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Staf  Desa</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="staf_id" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($staff as $item)
                                        <option value="{{$item->staff_id}}">{{$item->nama_staff}} ({{$item->staff_posisi}})</option>
                                        @endforeach;
                                    </select>
                                 </div>
							</div>
                           
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="{{url('surat/daftar-cetak-surat/')}}" class="btn btn-danger">Kembali</a>
                                    <button type="submit" value="Submit" class="btn btn-warning">CETAK</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var ToDate = new Date();
  function validasitanggal() {
        var tanggal = $("#tanggal_lahir").val();
        if (new Date(tanggal).getTime() > ToDate.getTime()) {
            $("#error_tgl_lahir").text("Tanggal lahir harus kurang dari hari ini");
            $("#tanggal_lahir").val(null);
            return false;
        }else{
            $("#error_tgl_lahir").text(null);
        }
        return true;
   }
    // Autocomplate

    var penduduk = [];

    @foreach ($penduduk as $item)

            var item = {
                penduduk_id:"{{$item->penduduk_id}}",
                nik:"{{$item->nik}}",
                nama:"{{$item->full_name}}",
            };
            penduduk.push(item);
    @endforeach;
    autocomplete(document.getElementById("input-auto-coplate"), penduduk,"penduduk_id");
    // End
</script>
@stop