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
                        <div class="card-title">Surat Penduduk Pindah</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{url('surat/cetak-surat-penduduk-pindah/')}}">
                            @csrf
                            <input type="hidden" value="{{$kode_surat}}" name="kode_surat" />
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>NIK/Nama</b></label>
                                <div class="col-md-9 p-0">
                                    <select class="form-control" name="penduduk_id" required onchange="GetDataKeluarga(this)">
                                        <option value=""> - Pilih -</option>
                                        @foreach ($penduduk as $item)
                                        <option value="{{$item->penduduk_id}}">{{$item->nik}} - {{$item->full_name}}</option>
                                        @endforeach;
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Alamat Tujuan</b></label>
                                <div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="alamat_tujuan" placeholder="Alamat Tujuan" required>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"></label>
                                <div class="col-md-9 p-0">
                                    RT <input type="text" class="form-control" name="rt_tujuan" placeholder="RT" required>
                                    RW <input type="text" class="form-control" name="rw_tujuan" placeholder="RW" required>
                                    DUSUN <input type="text" class="form-control" name="dusun_tujuan" placeholder="DUSUN" required>
                                    DESA <input type="text" class="form-control" name="desa_tujuan" placeholder="DESA" required>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Kecamatan</b></label>
                                <div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="kecamatan_tujuan" placeholder="Kecamatan" required>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Kabupaten</b></label>
                                <div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="kabupaten_tujuan" placeholder="Kabupaten" required>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Alasan Pindah</b></label>
                                <div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="alasan_pindah" placeholder="Alasan Pindah" required>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Tanggal Pindah</b></label>
                                <div class="col-md-9 p-0">
                                    <input type="date" class="form-control" name="tanggal_pindah" placeholder="Tanggal Pindah" required>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Keluarga Yang Ikut</b></label>
                                <div class="col-md-9 p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table_keluarga">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>#</th>
                                                    <th>NIK</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Umur</th>
                                                    <th>Hubungan Keluarga</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list_keluarga">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Keperluan</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control" name="hal" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Keterangan Pindah</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="keterangan" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Staf  Desa</b></label>
                                <div class="col-md-9 p-0">
                                    <select class="form-control" name="staf_id" required>
                                        <option value=""> - Pilih -</option>
                                        @foreach ($staff as $item)
                                        <option value="{{$item->staff_id}}">{{$item->nama_staff}}  ({{$item->staff_posisi}})</option>
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
 var url = "{{url('kependudukan/keluarga/')}}";
   function GetDataKeluarga(evnt){
       var penduduk_id = evnt.value;
       if(penduduk_id !== null && penduduk_id !== "" && penduduk_id !== undefined){
            $.get(url+"/get-data-keluarga/"+penduduk_id, function(data, status){
                $('table#table_keluarga > tbody').empty();
                for(i=0;i < data.length;i++)
                    {   
                        $("#list_keluarga")
                        .append('<tr>'+ 
                        '<td>'+(i+1)+'</td>'+
                        '<td><input type="checkbox" name="keluarga[]" value="'+data[i].penduduk_id+'"/></td>'+
                        '<td>'+data[i].nik+'</td>'+
                        '<td>'+data[i].nama+'</td>'+
                        '<td>'+data[i].kelamin+'</td>'+
                        '<td>'+data[i].tanggal_lahir+'</td>'+
                        '<td>'+data[i].umur+'</td>'+
                        '<td>'+data[i].hubungan_keluarga+'</td>'+
                        '</tr>');
                    }
            });
       }
       
   }
</script>
@stop
