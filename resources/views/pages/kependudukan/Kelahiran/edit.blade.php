@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Kelahiran</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Data Kelahiran</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('kependudukan/kelahiran/update/'.$kelahiran->kelahiran_id)}}" method="POST" onsubmit="return Submit(this)">
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nik" placeholder="NIK" value="{{$kelahiran->nik}}" minlength="16" maxlength="16" required id="nik">
                                    <span id="error_nik" class="text-danger"></span>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="full_name" placeholder="Nama lengkap" value="{{$kelahiran->full_name}}" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                   <b>Dusun :  </b>
                                    <select class="form-control" name="wilayah_dusun" onchange="GetRW(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($dusun as $item)
                                        <option value="{{$item->wilayah_id}}" {{$kelahiran->wilayah_dusun == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RW  : </b>
                                    <select class="form-control" name="wilayah_rw" id="wilayah_rw"  onchange="GetRT(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($rw as $item)
                                            <option value="{{$item->wilayah_id}}" {{$kelahiran->wilayah_rw == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RT : </b>
                                    <select class="form-control" name="wilayah_rt" id="wilayah_rt" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($rt as  $item)
                                            <option value="{{$item->wilayah_id}}" {{$kelahiran->wilayah_rt == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="alamat" placeholder="Alamat" value="{{$kelahiran->alamat}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="no_kk" placeholder="No kartu keluarga" value="{{$kelahiran->no_kk}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="tempat_lahir" placeholder="Tempat lahir" value="{{$kelahiran->tempat_lahir}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" value="{{$kelahiran->tanggal_lahir}}" required onchange="validasitanggal()" id="tanggal_lahir">
                                    <span id="error_tgl_lahir" class="text-danger"></span>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin {{$kelahiran->jekel == 'Perempuan' ? 'checked':''}}</b></label>
								<div class="col-md-9 p-0">
                                    <b>Laki - Laki </b><input type="radio" class="form-control" name="jekel" value="Laki-laki" required  {{$kelahiran->jekel == 'Laki-laki' ? 'checked':''}}>
                                    <b>Perempuan </b><input type="radio" class="form-control" name="jekel" value="Perempuan" required {{$kelahiran->jekel == 'Perempuan' ? 'checked':''}}>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="agama"> 
                                        <option value="">- Pilih -</option>
                                        <option value="ISLAM" {{$kelahiran->agama == "ISLAM"?"selected":""}}>ISLAM</option>
										<option value="KRISTEN" {{$kelahiran->agama == "KRISTEN"?"selected":""}}>KRISTEN</option>
										<option value="KATHOLIK" {{$kelahiran->agama == "KATHOLIK"?"selected":""}}>KATHOLIK</option>
										<option value="HINDU" {{$kelahiran->agama == "HINDU"?"selected":""}}>HINDU</option>
										<option value="BUDHA" {{$kelahiran->agama == "BUDHA"?"selected":""}}>BUDHA</option>
										<option value="KHONGHUCU" {{$kelahiran->agama == "KHONGHUCU"?"selected":""}}>KHONGHUCU</option>
										<option value="Kepercayaan Terhadap Tuhan YME / Lainnya" {{$kelahiran->agama == "Kepercayaan Terhadap Tuhan YME / Lainnya"?"selected":""}}>Kepercayaan Terhadap Tuhan YME / Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                    <select class="form-control" disabled>  
                                        <option>Tetap</option>
                                    </select>
                                    <input name="status_kependudukan" value="Pendatang" type="hidden"/>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <select name="golongan_darah" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="A" {{$kelahiran->golongan_darah == "A"?"selected":""}}>A</option>
                                    <option value="B" {{$kelahiran->golongan_darah == "B"?"selected":""}}>B</option>
                                    <option value="AB" {{$kelahiran->golongan_darah == "AB"?"selected":""}}>AB</option>
                                    <option value="O" {{$kelahiran->golongan_darah == "O"?"selected":""}}>O</option>
                                    <option value="A+" {{$kelahiran->golongan_darah == "A+"?"selected":""}}>A+</option>
                                    <option value="A-" {{$kelahiran->golongan_darah == "A-"?"selected":""}}>A-</option>
                                    <option value="B+" {{$kelahiran->golongan_darah == "B+"?"selected":""}}>B+</option>
                                    <option value="B-" {{$kelahiran->golongan_darah == "B-"?"selected":""}}>B-</option>
                                    <option value="AB+" {{$kelahiran->golongan_darah == "AB+"?"selected":""}}>AB+</option>
                                    <option value="AB-" {{$kelahiran->golongan_darah == "AB-"?"selected":""}}>AB-</option>
                                    <option value="O+" {{$kelahiran->golongan_darah == "O+"?"selected":""}}>O+</option>
                                    <option value="O-" {{$kelahiran->golongan_darah == "O-"?"selected":""}}>O-</option>
                                    <option value="TIDAK TAHU" {{$kelahiran->golongan_darah == "TIDAK TAHU"?"selected":""}}>TIDAK TAHU</option>
                                </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jam Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="time" class="form-control" name="tob" required value="{{$kelahiran->tob}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Penolong Kelahiran </b></label>
								<div class="col-md-9 p-0">
									<select name="hob" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Dokter" {{$kelahiran->hob == "Dokter"?"selected":""}}>Dokter</option>
                                        <option value="Bidan" {{$kelahiran->hob == "Bidan"?"selected":""}}>Bidan</option>
                                        <option value="Dukun Beranak" {{$kelahiran->hob == "Dukun Beranak"?"selected":""}}>Dukun Beranak</option>
                                        <option value="Lainnya" {{$kelahiran->hob == "Lainnya"?"selected":""}}>Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Kondisi Lahir</b></label>
								<div class="col-md-9 p-0">
                                    <b>Normal </b><input type="radio" class="form-control" name="kondisi_lahir" value="Normal" required  {{$kelahiran->kondisi_lahir == 'Normal' ? 'checked':''}}>
                                    <b>Cacat </b><input type="radio" class="form-control" name="kondisi_lahir" value="Cacat" required  {{$kelahiran->kondisi_lahir == 'Cacat' ? 'checked':''}}>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Anak Ke</b></label>
								<div class="col-md-9 p-0">
                                 <input type="number" class="form-control" name="anak_ke" placeholder="Anak ke" value="{{$kelahiran->anak_ke}}" required>                                 
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Berat Lahir (Kg)</b></label>
								<div class="col-md-9 p-0">
                                    <input type="number" step="0.25" class="form-control" name="berat" placeholder="Berat" value="{{$kelahiran->berat}}" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Panjang Lahir (Cm)</b></label>
								<div class="col-md-9 p-0">
                                    <input type="number" class="form-control" name="panjang" placeholder="Panjang" value="{{$kelahiran->panjang}}" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                    <b>Normal </b><input type="radio" class="form-control" name="jenis_kelahiran" value="Normal" checked>
                                    <b>Caesar </b><input type="radio" class="form-control" name="jenis_kelahiran" value="Caesar">
                                 </div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <button type="submit" value="Submit" class="btn btn-primary">Update</button>
                                    <a href="{{redirect()->back()->getTargetUrl()}}" class="btn btn-danger">Kembali</a>
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
   var ToDate = new Date();
   var id_penduduk = "{{$kelahiran->penduduk_id}}";
   function GetRW(evnt){
        $.get(url+"/get_wilayah/"+evnt.value+"/rw", function(data, status){
            $('#wilayah_rw')
            .find('option')
            .remove()
            .end()
            .append('<option value="">- Pilih -</option>');

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
            .append('<option value="">- Pilih -</option>');

            for(i=0;i < data.length;i++)
                {   
                    $('#wilayah_rt').append(`<option value="${data[i].wilayah_id}"> 
                                            ${data[i].wilayah_nama} 
                                        </option>`); 
                }
        
        });
   }
   function Submit(e)
   {
       var nik = $("#nik").val();
       $.get(url+"/validation-nik/"+nik+"/"+id_penduduk, function(data, status){
            if(data['response'] == false)
            {
                e.submit();
            }else
            {
                $("#error_nik").text('NIK '+nik+' Sudah ada');
                $("#nik").focus();
            }
       });
        return false;
   }
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