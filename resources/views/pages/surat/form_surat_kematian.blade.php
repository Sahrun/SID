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
                                    <select class="form-control" name="penduduk_id" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($penduduk as $item)
                                        <option value="{{$item->penduduk_id}}">{{$item->full_name}}</option>
                                        @endforeach;
                                    </select>
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
                                        <option value="{{$item->staff_id}}">{{$item->nama_staff}}</option>
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
</script>
@stop