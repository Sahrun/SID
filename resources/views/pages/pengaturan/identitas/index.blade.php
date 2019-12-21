@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Identitas Desa</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Data Identitas Desa</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('pengaturan/identitas/create')}}" >
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Provinsi</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_prov" placeholder="Nama Provinsi">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Sebutan Kabupaten</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="sebutan_kabupaten" placeholder="Kabupaten" value="Kabupaten">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Singkatan Sebutan Kabupatan</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="sebutan_kabupaten_singkat" placeholder="Kab." value="Kab.">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Kabupaten</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_kabupaten" placeholder="Nama Kabupaten">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Sebutan Kecamatan</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="sebutan_kecamatan" placeholder="Kecamatan" value="Kecamatan">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Singkatan Sebutan Kecamatan</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="sebutan_kecamatan_singkat" placeholder="Kec." value="Kec.">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Kecamatan</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="nama_kec" placeholder="Nama Kecamatan">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Sebutan Desa</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="sebutan_desa" placeholder="Desa" value="Desa">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Desa</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_desa" placeholder="Nama Desa">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat Kantor Desa</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="alamat_desa" placeholder="Alamat Kantor Desa">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Sebutan Dusun</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="sebutan_dusun" placeholder="Dusun" value="Desa">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Sebutan Camat</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="sebutan_camat" placeholder="Camat" value="Camat">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Bupati</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_bupati" placeholder="Nama Bupati">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Wakil Bupati</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_wakil_bupati" placeholder="Nama Wakil Bupati">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Kepala Desa</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_kades" placeholder="Nama Kepala Desa">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Camat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_camat" placeholder="Nama Camat">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIP Camat</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="nip_camat" placeholder="NIP Camat">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Kode Pos</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="kode_pos" placeholder="Kode Pos">
								</div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
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
   var url = "{{url('kependudukan/penduduk/')}}";
   function GetRW(evnt){
        $.get(url+"/get_wilayah/"+evnt.value+"/rw", function(data, status){
           
            $('#wilayah_rw')
            .find('option')
            .remove()
            .end()
            .append('<option>- Pilih -</option>');

            for(i=0;i < data.length;i++)
                {   
                    $('#wilayah_rw').append(`<option value="${data[i].wilayah_id}"> 
                                            ${data[i].wilayah_nama} 
                                        </option>`); 
                }
        
        });
   }
   function GetRT(evnt){
        $.get(url+"/get_wilayah/"+evnt.value+"/rt", function(data, status){
            $('#wilayah_rt')
            .find('option')
            .remove()
            .end()
            .append('<option>- Pilih -</option>');
            for(i=0;i < data.length;i++)
                {   
                    $('#wilayah_rt').append(`<option value="${data[i].wilayah_id}"> 
                                            ${data[i].wilayah_nama} 
                                        </option>`); 
                }
        
        });
   }
</script>
@stop