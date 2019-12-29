@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Penduduk</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Data Penduduk</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('kependudukan/penduduk/update/'.$penduduk->penduduk_id)}}" method="POST" onsubmit="return Submit(this)" >
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nik" placeholder="NIK" value="{{$penduduk->nik}}" minlength="16" maxlength="16" required id="nik">
                                    <span id="error_nik" class="text-danger"></span>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="full_name" placeholder="Nama lengkap" value="{{$penduduk->full_name}}" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                   <b>Dusun :  </b>
                                    <select class="form-control" name="wilayah_dusun" onchange="GetRW(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($dusun as $item)
                                        <option value="{{$item->wilayah_id}}" {{$penduduk->wilayah_dusun == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RW  : </b>
                                    <select class="form-control" name="wilayah_rw" id="wilayah_rw"  onchange="GetRT(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($rw as $item)
                                            <option value="{{$item->wilayah_id}}" {{$penduduk->wilayah_rw == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RT : </b>
                                    <select class="form-control" name="wilayah_rt" id="wilayah_rt" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($rt as  $item)
                                            <option value="{{$item->wilayah_id}}" {{$penduduk->wilayah_rt == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="no_kk" placeholder="No kartu keluarga" value="{{$penduduk->no_kk}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="tempat_lahir" placeholder="Tempat lahir" value="{{$penduduk->tempat_lahir}}" >
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" value="{{$penduduk->tanggal_lahir}}" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin {{$penduduk->jekel == 'Perempuan' ? 'checked':''}}</b></label>
								<div class="col-md-9 p-0">
                                    <b>Laki - Laki </b><input type="radio" class="form-control" name="jekel" value="Laki-laki" required  {{$penduduk->jekel == 'Laki-laki' ? 'checked':''}}>
                                    <b>Perempuan </b><input type="radio" class="form-control" name="jekel" value="Perempuan" required {{$penduduk->jekel == 'Perempuan' ? 'checked':''}}>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="alamat" placeholder="Alamat" value="{{$penduduk->alamat}}">
								</div>
                            </div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="agama"> 
                                        <option value="">- Pilih -</option>
                                        <option value="ISLAM" {{$penduduk->agama == "ISLAM"?"selected":""}}>ISLAM</option>
										<option value="KRISTEN" {{$penduduk->agama == "KRISTEN"?"selected":""}}>KRISTEN</option>
										<option value="KATHOLIK" {{$penduduk->agama == "KATHOLIK"?"selected":""}}>KATHOLIK</option>
										<option value="HINDU" {{$penduduk->agama == "HINDU"?"selected":""}}>HINDU</option>
										<option value="BUDHA" {{$penduduk->agama == "BUDHA"?"selected":""}}>BUDHA</option>
										<option value="KHONGHUCU" {{$penduduk->agama == "KHONGHUCU"?"selected":""}}>KHONGHUCU</option>
										<option value="Kepercayaan Terhadap Tuhan YME / Lainnya" {{$penduduk->agama == "Kepercayaan Terhadap Tuhan YME / Lainnya"?"selected":""}}>Kepercayaan Terhadap Tuhan YME / Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="pendidikan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="TIDAK / BELUM SEKOLAH"{{$penduduk->pendidikan == "TIDAK / BELUM SEKOLAH"?"selected":""}}>TIDAK / BELUM SEKOLAH </option>
                                        <option value="BELUM TAMAT SD/SEDERAJAT"{{$penduduk->pendidikan == "BELUM TAMAT SD/SEDERAJAT"?"selected":""}}>BELUM TAMAT SD/SEDERAJAT</option>
                                        <option value="TAMAT SD / SEDERAJAT" {{$penduduk->pendidikan == "TAMAT SD / SEDERAJAT"?"selected":""}}>TAMAT SD / SEDERAJAT</option>
                                        <option value="SLTP/SEDERAJAT" {{$penduduk->pendidikan == "SLTP/SEDERAJAT"?"selected":""}}>SLTP/SEDERAJAT</option>
                                        <option value="SLTA / SEDERAJAT" {{$penduduk->pendidikan == "SLTA / SEDERAJAT"?"selected":""}}>SLTA / SEDERAJAT</option>
                                        <option value="DIPLOMA I / II" {{$penduduk->pendidikan == "DIPLOMA I / II"?"selected":""}}>DIPLOMA I / II</option>
                                        <option value="AKADEMI/ DIPLOMA III/S. MUDA" {{$penduduk->pendidikan == "AKADEMI/ DIPLOMA III/S. MUDA"?"selected":""}}>AKADEMI/ DIPLOMA III/S. MUDA</option>
                                        <option value="DIPLOMA IV/ STRATA I" {{$penduduk->pendidikan == "DIPLOMA IV/ STRATA I"?"selected":""}}>DIPLOMA IV/ STRATA I</option>
                                        <option value="STRATA II9" {{$penduduk->pendidikan == "STRATA II9"?"selected":""}}>STRATA II</option>
                                        <option value="STRATA III" {{$penduduk->pendidikan == "STRATA III"?"selected":""}}>STRATA III</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="pekerjaan" placeholder="Pekerjaan" value="{{$penduduk->pekerjaan}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="status_perkawinan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="BELUM KAWIN" {{$penduduk->status_perkawinan == "BELUM KAWIN"?"selected":""}}>BELUM KAWIN</option>
                                        <option value="KAWIN" {{$penduduk->status_perkawinan == "KAWIN"?"selected":""}}>KAWIN</option>
                                        <option value="CERAI HIDUP" {{$penduduk->status_perkawinan == "CERAI HIDUP"?"selected":""}}>CERAI HIDUP</option>
                                        <option value="CERAI MATI" {{$penduduk->status_perkawinan == "CERAI MATI"?"selected":""}}>CERAI MATI</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                    <select name="status_kependudukan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Tetap" {{$penduduk->status_kependudukan == "Tetap"?"selected":""}}>TETAP</option>
                                        <option value="Pendatang" {{$penduduk->status_kependudukan == "Pendatang"?"selected":""}}>PENDATANG</option>
                                        <option value="Tidak tetap" {{$penduduk->status_kependudukan == "Tidak Tetap"?"selected":""}}>TIDAK TETAP</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <select name="golongan_darah" class="form-control form-control-sm">
                                    <option value="">- Pilih -</option>
                                    <option value="A" {{$penduduk->golongan_darah == "A"?"selected":""}}>A</option>
                                    <option value="B" {{$penduduk->golongan_darah == "B"?"selected":""}}>B</option>
                                    <option value="AB" {{$penduduk->golongan_darah == "AB"?"selected":""}}>AB</option>
                                    <option value="O" {{$penduduk->golongan_darah == "O"?"selected":""}}>O</option>
                                    <option value="A+" {{$penduduk->golongan_darah == "A+"?"selected":""}}>A+</option>
                                    <option value="A-" {{$penduduk->golongan_darah == "A-"?"selected":""}}>A-</option>
                                    <option value="B+" {{$penduduk->golongan_darah == "B+"?"selected":""}}>B+</option>
                                    <option value="B-" {{$penduduk->golongan_darah == "B-"?"selected":""}}>B-</option>
                                    <option value="AB+" {{$penduduk->golongan_darah == "AB+"?"selected":""}}>AB+</option>
                                    <option value="AB-" {{$penduduk->golongan_darah == "AB-"?"selected":""}}>AB-</option>
                                    <option value="O+" {{$penduduk->golongan_darah == "O+"?"selected":""}}>O+</option>
                                    <option value="O-" {{$penduduk->golongan_darah == "O-"?"selected":""}}>O-</option>
                                    <option value="TIDAK TAHU" {{$penduduk->golongan_darah == "TIDAK TAHU"?"selected":""}}>TIDAK TAHU</option>
                                </select>
								</div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <button type="submit" value="Submit" class="btn btn-primary">Update</button>
                                    <a href="{{url('kependudukan/penduduk')}}" class="btn btn-danger">Kembali</a>
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
   var id_penduduk = "{{$penduduk->penduduk_id}}";
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
            }
       });
        return false;
   }
</script>
@stop