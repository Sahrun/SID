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
                        <div class="card-title">Surat Kurang Mampu</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{url('surat/cetak-surat-kurang-mampu/')}}">
                            @csrf
                            <input type="hidden" value="{{$kode_surat}}" name="kode_surat" />
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nomor Surat</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="nomor_surat" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>NIK/Nama</b></label>
                                <div class="col-md-9 p-0">
                                    <div class="autocomplete" style="width:300px;">
                                            <input id="input-auto-coplate" type="text" placeholder="NIK / Nama" class="form-control input-full" required>
                                            <input type="hidden" name="penduduk_id" id="penduduk_id" required/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Keperluan</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="hal" required>
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
