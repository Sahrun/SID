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
                        <div class="card-title">Surat Kelahiran</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{url('surat/cetak-surat-kelahiran/')}}">
                            @csrf
                            <input type="hidden" value="{{$kode_surat}}" name="kode_surat" />
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Anak</b></label>
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

                            <div class="card">
                                <div class="card-header" style="">
                                    <h2>Pelapor</h2>
                                    <input type="radio" name="pelapor_is_warga" value="true" onclick="pelapor(this)" checked /> Warga Desa
                                    <input type="radio" name="pelapor_is_warga" value="false" onclick="pelapor(this)" /> Warga Luar

                                </div>
                                <div class="card-body">
                                    <div id="pelapor_warga_desa">
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Penduduk</b></label>
                                            <div class="col-md-9 p-0">
                                                <select class="form-control input-pelapor-desa" name="penduduk_pelapor" required>
                                                    <option value=""> - Pilih -</option>
                                                    @foreach ($pendudukAll as $item)
                                                    <option value="{{$item->penduduk_id}}">{{$item->full_name}}</option>
                                                    @endforeach;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pelapor_warga_luar" style="display:none">
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Nama Pelapor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="nama_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>NIK Pelapor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="nik_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Tempat Lahir pelapor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="tempat_lahir_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Pekerjaan</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="date" name="pekerjaan_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Desa Pelaor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="desa_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Kabupaten Pelaor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="kab_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Provinsi Pelaor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="provinsi_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Hubungan Pelaor</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="hubungan_pelapor" class="form-control input-full input-pelapor-luar" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" style="">
                                    <h2>Saksi 1</h2>
                                    <input type="radio" name="saksi1_is_warga" value="true" onclick="saksi1(this)" checked/> Warga Desa
                                    <input type="radio" name="saksi1_is_warga" value="false" onclick="saksi1(this)" /> Warga Luar
                                </div>
                                <div class="card-body">
                                    <div id="saksi1_warga_desa">
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Penduduk</b></label>
                                            <div class="col-md-9 p-0">
                                                <select class="form-control input-saksi1-desa" name="penduduk_saksi1" required>
                                                    <option value=""> - Pilih -</option>
                                                    @foreach ($pendudukAll as $item)
                                                    <option value="{{$item->penduduk_id}}">{{$item->full_name}}</option>
                                                    @endforeach;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="saksi1_warga_luar" style="display:none">
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Nama Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="nama_saksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>NIK Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="nik_saksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Tempat Lahir Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="tempat_lahir_saksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Tanggal Lahir Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="date" name="tanggal_lahir_saksi1" class="form-control input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Pekerjaan Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="pekerjaan_saksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Desa Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="desa_saksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control">Kecamatan Saksi</b>
                                            </label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="kec_saksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Provinsi Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="provin_sisaksi1" class="form-control input-full input-saksi1-luar" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">

                                <div class="card-header" style="">
                                    <h2>Saksi 2</h2>
                                    <input type="radio" name="saksi2_is_warga" value="true" onclick="saksi2(this)" checked/> Warga Desa
                                    <input type="radio" name="saksi2_is_warga" value="false" onclick="saksi2(this)" /> Warga Luar
                                </div>
                                <div class="card-body">

                                    <div id="saksi2_warga_desa">
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Penduduk</b></label>
                                            <div class="col-md-9 p-0">
                                                <select class="form-control input-saksi2-desa" name="penduduk_saksi2" required>
                                                    <option value=""> - Pilih -</option>
                                                    @foreach ($pendudukAll as $item)
                                                    <option value="{{$item->penduduk_id}}">{{$item->full_name}}</option>
                                                    @endforeach;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="saksi2_warga_luar" style="display:none">
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Nama Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="nama_saksi2" class="form-control input-full input-saksi2-luar">
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>NIK Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="nik_saksi2" class="form-control input-full input-saksi2-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Tempat Lahir Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="tempat_lahir_saksi2" class="form-control input-full input-saksi2-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Tanggal Lahir Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="date" name="tanggal_lahir_saksi2" class="form-control input-saksi2-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Pekerjaan Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="pekerjaan_saksi2" class="form-control input-full input-saksi2-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Desa Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="desa_saksi2" class="form-control input-full input-saksi2-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control">Kecamatan Saksi</b>
                                            </label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="kec_saksi2" class="form-control input-full input-saksi2-luar" />
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label class="col-md-3 label-control"><b>Provinsi Saksi</b></label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" name="provin_sisaksi2" class="form-control input-full input-saksi2-luar" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Lokasi Capil</b></label>
                                <div class="col-md-9 p-0">
                                    <input type="text" name="lokasi_capil" class="form-control input-full" required/>
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

  function pelapor(event)
  {
    if(event.value == "true")
    {
        $("#pelapor_warga_desa").css("display","block");
        $(".input-pelapor-desa").prop('required',true);
        $("#pelapor_warga_luar").css("display","none");
        $('.input-pelapor-luar').removeAttr('required');
    }else
	{
    
        $("#pelapor_warga_luar").css("display","block");
        $(".input-pelapor-luar").prop('required',true);
        $("#pelapor_warga_desa").css("display","none");
        $('.input-pelapor-desa').removeAttr('required');
    }
}
    function saksi1(event)
  {
   if(event.value == "true")
    {
        $("#saksi1_warga_desa").css("display","block");
        $(".input-saksi1-desa").prop('required',true);
        $("#saksi1_warga_luar").css("display","none");
        $('.input-saksi1-luar').removeAttr('required');
    }else
	{
        $("#saksi1_warga_luar").css("display","block");
        $(".input-saksi1-luar").prop('required',true);
        $("#saksi1_warga_desa").css("display","none");
        $('.input-saksi1-desa').removeAttr('required');
    }
  }
  function saksi2(event)
  {
   if(event.value == "true")
    {
        $("#saksi2_warga_desa").css("display","block");
        $(".input-saksi2-desa").prop('required',true);
        $("#saksi2_warga_luar").css("display","none");
        $('.input-saksi2-luar').removeAttr('required');
    }else
	{
        $("#saksi2_warga_luar").css("display","block");
        $(".input-saksi2-luar").prop('required',true);
        $("#saksi2_warga_desa").css("display","none");
        $('.input-saksi2-desa').removeAttr('required');
    }
  }
</script>
@stop
