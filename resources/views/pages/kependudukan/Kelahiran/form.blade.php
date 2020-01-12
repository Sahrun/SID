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
                        <div class="card-title">Tambah Data Kelahiran</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('kependudukan/kelahiran/create')}}" onsubmit="return Submit(this)">
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>KIA</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nik" placeholder="KIA" minlength="16" maxlength="16" required id="nik">
                                    <span id="error_nik" class="text-danger"></span>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap </b></label>
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
                                    <select class="form-control" name="wilayah_rw" id="wilayah_rw"  onchange="GetRT(this)" required> 
                                        <option value=""> - Pilih -</option>
                                    </select>
                                    <b> RT : </b>
                                    <select class="form-control" name="wilayah_rt" id="wilayah_rt" required> 
                                        <option value=""> - Pilih -</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK Ayah</b></label>
								<div class="col-md-9 p-0">
                                    <div class="autocomplete" style="width:300px;">
                                        <input id="input-auto-coplate-nik-ayah" type="text" placeholder="NIK / Nama" class="form-control input-full">
                                        <input type="hidden" name="id_penduduk_ayah" id="id_penduduk_ayah"/>
                                    </div>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK Ibu</b></label>
								<div class="col-md-9 p-0">
                                    <div class="autocomplete" style="width:300px;">
                                        <input id="input-auto-coplate-nik-ibu" type="text" placeholder="NIK / Nama" class="form-control input-full">
                                        <input type="hidden" name="id_penduduk_ibu" id="id_penduduk_ibu"/>
                                    </div>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" ><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                     <select name="keluarga_id" required class="form-control">
                                            <option value=""> - Pilih -</option>
                                            @foreach ($keluarga as $item)
                                            <option value="{{$item->keluarga_id}}">{{$item->no_kk}}</option>
                                            @endforeach;
                                     </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="tempat_lahir" placeholder="Tempat lahir" >
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" required onchange="validasitanggal()" id="tanggal_lahir">
                                    <span id="error_tgl_lahir" class="text-danger"></span>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="alamat" placeholder="Alamat">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jam Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="time" class="form-control" name="tob" placeholder="Tempat lahir" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Penolong Kelahiran</b></label>
								<div class="col-md-9 p-0">
									<select name="hob" class="form-control" required> 
                                        <option value="">- Pilih -</option>
                                        <option value="Dockter">Dokter</option>
                                        <option value="Bidan">Bidan</option>
                                        <option value="Dukun Beranak">Dukun Beranak</option>
                                        <option value="Lainya">Lainnya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Kondisi Lahir</b></label>
								<div class="col-md-9 p-0">
                                    <b>Normal </b><input type="radio" class="form-control" name="kondisi_lahir" value="Normal" checked>
                                    <b>Cacat </b><input type="radio" class="form-control" name="kondisi_lahir" value="Cacat">
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Anak Ke</b></label>
								<div class="col-md-9 p-0">
                                 <input type="number" class="form-control" name="anak_ke" placeholder="Anak ke" required>                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                    <b>Laki - Laki </b><input type="radio" class="form-control" name="jekel" value="Laki-laki" required>
                                    <b>Perempuan </b><input type="radio" class="form-control" name="jekel" value="Perempuan" required>
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
								<label class="col-md-3 label-control"><b>Berat Lahir (Kg)</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control" name="berat" placeholder="Berat" onkeypress="decimalOnly(this,event)">
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Panjang Lahir (Cm)</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control" name="panjang" placeholder="Panjang" onkeypress="decimalOnly(this,event)">
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                <b>Normal </b><input type="radio" class="form-control" name="jenis_kelahiran" value="Normal" checked>
                                    <b>Caesar </b><input type="radio" class="form-control" name="jenis_kelahiran" value="Caesar">
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
                                    <a href="{{url('kependudukan/kelahiran/')}}" class="btn btn-danger">Kembali</a>
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
       $.get(url+"/validation-nik/"+nik+"/null", function(data, status){
            if(data['response'] == false)
            {
                e.submit();
            }else
            {
                $("#error_nik").text('KIA '+nik+' Sudah ada');
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
   function decimalOnly(obj,event)
   {
    var data = obj.value;
	if((event.charCode>= 48 && event.charCode <= 57) || event.charCode== 46 ||event.charCode == 0){
		if(data.indexOf('.') > -1){
 			if(event.charCode== 46)
  				event.preventDefault();
		}
	}else
    {
		event.preventDefault();
    }

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
autocomplete(document.getElementById("input-auto-coplate-nik-ibu"), penduduk,"id_penduduk_ibu");

autocomplete(document.getElementById("input-auto-coplate-nik-ayah"), penduduk,"id_penduduk_ayah");

// End
</script>
@stop