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
                        <div class="card-title">Tambah Data Penduduk</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('kependudukan/pendatang/update/'.$pendatang->pendatang_id)}}" method="POST" >
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nik" placeholder="NIK" value="{{$pendatang->nik}}" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="full_name" placeholder="Nama lengkap" value="{{$pendatang->full_name}}" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                   <b>Dusun :  </b>
                                    <select class="form-control" name="wilayah_dusun" onchange="GetRW(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($dusun as $item)
                                        <option value="{{$item->wilayah_id}}" {{$pendatang->wilayah_dusun == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RW  : </b>
                                    <select class="form-control" name="wilayah_rw" id="wilayah_rw"  onchange="GetRT(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($rw as $item)
                                            <option value="{{$item->wilayah_id}}" {{$pendatang->wilayah_rw == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RT : </b>
                                    <select class="form-control" name="wilayah_rt" id="wilayah_rt" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($rt as  $item)
                                            <option value="{{$item->wilayah_id}}" {{$pendatang->wilayah_rt == $item->wilayah_id?"selected":""}}>{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="no_kk" placeholder="No kartu keluarga" value="{{$pendatang->no_kk}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="tempat_lahir" placeholder="Tempat lahir" value="{{$pendatang->tempat_lahir}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" value="{{$pendatang->tanggal_lahir}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin {{$pendatang->jekel == 'Perempuan' ? 'checked':''}}</b></label>
								<div class="col-md-9 p-0">
                                    <b>Laki - Laki </b><input type="radio" class="form-control" name="jekel" value="Laki-laki" required  {{$pendatang->jekel == 'Laki-laki' ? 'checked':''}}>
                                    <b>Perempuan </b><input type="radio" class="form-control" name="jekel" value="Perempuan" required {{$pendatang->jekel == 'Perempuan' ? 'checked':''}}>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="agama"> 
                                        <option value="">- Pilih -</option>
                                        <option value="ISLAM" {{$pendatang->agama == "ISLAM"?"selected":""}}>ISLAM</option>
										<option value="KRISTEN" {{$pendatang->agama == "KRISTEN"?"selected":""}}>KRISTEN</option>
										<option value="KATHOLIK" {{$pendatang->agama == "KATHOLIK"?"selected":""}}>KATHOLIK</option>
										<option value="HINDU" {{$pendatang->agama == "HINDU"?"selected":""}}>HINDU</option>
										<option value="BUDHA" {{$pendatang->agama == "BUDHA"?"selected":""}}>BUDHA</option>
										<option value="KHONGHUCU" {{$pendatang->agama == "KHONGHUCU"?"selected":""}}>KHONGHUCU</option>
										<option value="Kepercayaan Terhadap Tuhan YME / Lainnya" {{$pendatang->agama == "Kepercayaan Terhadap Tuhan YME / Lainnya"?"selected":""}}>Kepercayaan Terhadap Tuhan YME / Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="pendidikan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="TIDAK / BELUM SEKOLAH"{{$pendatang->pendidikan == "TIDAK / BELUM SEKOLAH"?"selected":""}}>TIDAK / BELUM SEKOLAH </option>
                                        <option value="BELUM TAMAT SD/SEDERAJAT"{{$pendatang->pendidikan == "BELUM TAMAT SD/SEDERAJAT"?"selected":""}}>BELUM TAMAT SD/SEDERAJAT</option>
                                        <option value="TAMAT SD / SEDERAJAT" {{$pendatang->pendidikan == "TAMAT SD / SEDERAJAT"?"selected":""}}>TAMAT SD / SEDERAJAT</option>
                                        <option value="SLTP/SEDERAJAT" {{$pendatang->pendidikan == "SLTP/SEDERAJAT"?"selected":""}}>SLTP/SEDERAJAT</option>
                                        <option value="SLTA / SEDERAJAT" {{$pendatang->pendidikan == "SLTA / SEDERAJAT"?"selected":""}}>SLTA / SEDERAJAT</option>
                                        <option value="DIPLOMA I / II" {{$pendatang->pendidikan == "DIPLOMA I / II"?"selected":""}}>DIPLOMA I / II</option>
                                        <option value="AKADEMI/ DIPLOMA III/S. MUDA" {{$pendatang->pendidikan == "AKADEMI/ DIPLOMA III/S. MUDA"?"selected":""}}>AKADEMI/ DIPLOMA III/S. MUDA</option>
                                        <option value="DIPLOMA IV/ STRATA I" {{$pendatang->pendidikan == "DIPLOMA IV/ STRATA I"?"selected":""}}>DIPLOMA IV/ STRATA I</option>
                                        <option value="STRATA II9" {{$pendatang->pendidikan == "STRATA II9"?"selected":""}}>STRATA II</option>
                                        <option value="STRATA III" {{$pendatang->pendidikan == "STRATA III"?"selected":""}}>STRATA III</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="pekerjaan" placeholder="Pekerjaan" value="{{$pendatang->pekerjaan}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="status_perkawinan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="BELUM KAWIN" {{$pendatang->status_perkawinan == "BELUM KAWIN"?"selected":""}}>BELUM KAWIN</option>
                                        <option value="KAWIN" {{$pendatang->status_perkawinan == "KAWIN"?"selected":""}}>KAWIN</option>
                                        <option value="CERAI HIDUP" {{$pendatang->status_perkawinan == "CERAI HIDUP"?"selected":""}}>CERAI HIDUP</option>
                                        <option value="CERAI MATI" {{$pendatang->status_perkawinan == "CERAI MATI"?"selected":""}}>CERAI MATI</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                    <select class="form-control" disabled>  
                                        <option>PENDATANG</option>
                                    </select>
                                    <input name="status_kependudukan" value="Pendatang" type="hidden"/>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <select name="golongan_darah" class="form-control form-control-sm">
                                    <option value="">- Pilih -</option>
                                    <option value="A" {{$pendatang->golongan_darah == "A"?"selected":""}}>A</option>
                                    <option value="B" {{$pendatang->golongan_darah == "B"?"selected":""}}>B</option>
                                    <option value="AB" {{$pendatang->golongan_darah == "AB"?"selected":""}}>AB</option>
                                    <option value="O" {{$pendatang->golongan_darah == "O"?"selected":""}}>O</option>
                                    <option value="A+" {{$pendatang->golongan_darah == "A+"?"selected":""}}>A+</option>
                                    <option value="A-" {{$pendatang->golongan_darah == "A-"?"selected":""}}>A-</option>
                                    <option value="B+" {{$pendatang->golongan_darah == "B+"?"selected":""}}>B+</option>
                                    <option value="B-" {{$pendatang->golongan_darah == "B-"?"selected":""}}>B-</option>
                                    <option value="AB+" {{$pendatang->golongan_darah == "AB+"?"selected":""}}>AB+</option>
                                    <option value="AB-" {{$pendatang->golongan_darah == "AB-"?"selected":""}}>AB-</option>
                                    <option value="O+" {{$pendatang->golongan_darah == "O+"?"selected":""}}>O+</option>
                                    <option value="O-" {{$pendatang->golongan_darah == "O-"?"selected":""}}>O-</option>
                                    <option value="TIDAK TAHU" {{$pendatang->golongan_darah == "TIDAK TAHU"?"selected":""}}>TIDAK TAHU</option>
                                </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Datang</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tgl_datang" required value="{{$pendatang->tgl_datang}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alasan Datang</b></label>
								<div class="col-md-9 p-0">
                                    <select name="alasan_datang" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Pekerjaan" {{$pendatang->alasan_datang == "Pekerjaan"?"selected":""}}>Pekerjaan</option>
                                        <option value="Transmigrasi" {{$pendatang->alasan_datang == "Transmigrasi"?"selected":""}}>Transmigrasi</option>
                                        <option value="Lainnya" {{$pendatang->alasan_datang == "Lainnya"?"selected":""}}>Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat Sebelumnya</b></label>
								<div class="col-md-9 p-0">
                                    <textarea name="alamat_datang" class="form-control input-full" required>{{$pendatang->alamat_datang}}</textarea>
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
</script>
@stop