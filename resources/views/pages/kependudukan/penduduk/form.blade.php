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
                        <form role="form" method="post"  action="{{url('kependudukan/penduduk/create')}}" onsubmit="return Submit(this)" >
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-3 p-0">
									<input type="text" class="form-control input-full" name="nik" placeholder="NIK" minlength="16" maxlength="16" required id="nik">
                                    <span id="error_nik" class="text-danger"></span>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="full_name" placeholder="Nama lengkap" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                   <b>Dusun :  </b>
                                    <select class="form-control" name="wilayah_dusun" onchange="GetRW(this)" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($dusun as $item)
                                        <option value="{{$item->wilayah_id}}">{{$item->wilayah_nama}}</option>
                                        @endforeach;
                                    </select>
                                    <b> RW  : </b>
                                    <select class="form-control" name="wilayah_rw" id="wilayah_rw"  onchange="GetRT(this)"> 
                                        <option value=""> - Pilih -</option>
                                    </select>
                                    <b> RT : </b>
                                    <select class="form-control" name="wilayah_rt" id="wilayah_rt" required> 
                                        <option value=""> - Pilih -</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="tempat_lahir" placeholder="Tempat lahir">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal lahir" required onchange="validasitanggal()">
                                    <span id="error_tgl_lahir" class="text-danger"></span>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                    <b>Laki - Laki </b><input type="radio" class="form-control" name="jekel" value="Laki-laki" required>
                                    <b>Perempuan </b><input type="radio" class="form-control" name="jekel" value="Perempuan" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Ayah</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_ayah" placeholder="Nama Ayah" maxlength="50">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Ibu</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_ibu" placeholder="Nama Ibu" maxlength="50">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nomor KITAS/KITAP</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="no_kitas_kitap" placeholder="Nomor KITAS/KITAP" maxlength="20">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nomor Paspor</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="no_paspor" placeholder="Nomor Paspor" maxlength="20">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kewarganegaraan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="status_warganegara" class="form-control">
                                            <option value="">- Pilih -</option>
                                            <option value="WNI">WNI</option>
                                            <option value="WNA">WNA</option>
                                            <option value="Dua Kewarganegaraan">Dua Kewarganegaraan</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nomor Akta Kelahiran</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="no_akta_kelahiran" placeholder="Nomor Akta Kelahiran" maxlength="20">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>KTP Elektronik</b></label>
								<div class="col-md-9 p-0">
                                    <select name="ktp_elektronik" class="form-control">
                                            <option value="">- Pilih -</option>
                                            <option value="Belum">Belum</option>
                                            <option value="Sudah">Sudah</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="alamat" placeholder="Alamat">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="agama"> 
                                        <option value=""> - Pilih -</option>
                                        <option value="ISLAM">ISLAM</option>
										<option value="KRISTEN">KRISTEN</option>
										<option value="KATHOLIK">KATHOLIK</option>
										<option value="HINDU">HINDU</option>
										<option value="BUDHA">BUDHA</option>
										<option value="KHONGHUCU">KHONGHUCU</option>
										<option value="Kepercayaan Terhadap Tuhan YME / Lainnya">Kepercayaan Terhadap Tuhan YME / Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="pendidikan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="TIDAK / BELUM SEKOLAH">TIDAK / BELUM SEKOLAH</option>
                                        <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                                        <option value="TAMAT SD / SEDERAJAT">TAMAT SD / SEDERAJAT</option>
                                        <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                                        <option value="SLTA / SEDERAJAT">SLTA / SEDERAJAT</option>
                                        <option value="DIPLOMA I / II">DIPLOMA I / II</option>
                                        <option value="AKADEMI/ DIPLOMA III/S. MUDA">AKADEMI/ DIPLOMA III/S. MUDA</option>
                                        <option value="DIPLOMA IV/ STRATA I">DIPLOMA IV/ STRATA I</option>
                                        <option value="STRATA II9">STRATA II</option>
                                        <option value="STRATA III">STRATA III</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="pekerjaan" class="form-control">
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
								<label class="col-md-3 label-control"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                    <select name="status_perkawinan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="BELUM KAWIN">BELUM KAWIN</option>
                                        <option value="KAWIN">KAWIN</option>
                                        <option value="CERAI HIDUP">CERAI HIDUP</option>
                                        <option value="CERAI MATI">CERAI MATI</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                    <select name="status_kependudukan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Tetap">TETAP</option>
                                        <option value="Pendatang">PENDATANG</option>
                                        <option value="Tidak tetap">TIDAK TETAP</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <select name="golongan_darah" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="TIDAK TAHU">TIDAK TAHU</option>
                                </select>
								</div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                                    <a href="{{url('kependudukan/penduduk/')}}" class="btn btn-danger">Kembali</a>
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
       $.get(url+"/validation-nik/"+nik+"/null", function(data, status){
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