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
                        <form role="form" method="post"  action="{{url('kependudukan/kelahiran/create')}}" >
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>KIA</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nik" placeholder="KIA">
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
                                   <select class="form-control" name="wilayah_dusun" onchange="GetRW(this)"> 
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
                                    <select class="form-control" name="wilayah_rt" id="wilayah_rt"> 
                                        <option value=""> - Pilih -</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK Ibu</b></label>
								<div class="col-md-9 p-0">
                                     <select name="nik_ibu" class="form-control">
                                        <option value=""> - Pilih -</option>
                                            @foreach ($penduduk as $item)
                                            <option value="{{$item->penduduk_id}}">{{$item->nik}} - {{$item->full_name}}</option>
                                            @endforeach;
                                     </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK Ayah</b></label>
								<div class="col-md-9 p-0">
                                     <select name="nik_ayah" class="form-control">
                                            <option value=""> - Pilih -</option>
                                            @foreach ($penduduk as $item)
                                            <option value="{{$item->penduduk_id}}">{{$item->nik}} - {{$item->full_name}}</option>
                                            @endforeach;
                                     </select>
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
									<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jam Lahir</b></label>
								<div class="col-md-9 p-0">
									<input type="time" class="form-control" name="tob" placeholder="Tempat lahir">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Penolong Kelahiran</b></label>
								<div class="col-md-9 p-0">
									<select name="hob" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Dockter">Dockter</option>
                                        <option value="Bidan">Bidan</option>
                                        <option value="Dukun Beranak">Dukun Beranak</option>
                                        <option value="Lainya">Lainya</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Kondisi Lahir</b></label>
								<div class="col-md-9 p-0">
                                    <b>Normal </b><input type="radio" class="form-control" name="kondisi_lahir" value="normal" checked>
                                    <b>Cacat </b><input type="radio" class="form-control" name="kondisi_lahir" value="cacat">
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Anak Ke</b></label>
								<div class="col-md-9 p-0">
                                 <input type="number" class="form-control" name="anak_ke" placeholder="Anak ke">                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                    <b>Laki - Laki </b><input type="radio" class="form-control" name="jekel" value="Laki-laki" required>
                                    <b>Perempuan </b><input type="radio" class="form-control" name="jekel" value="Perempuan" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Berat Lahir (Kg)</b></label>
								<div class="col-md-9 p-0">
                                    <input type="number" class="form-control" name="berat" placeholder="Berat">
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Panjang Lahir (Cm)</b></label>
								<div class="col-md-9 p-0">
                                    <input type="number" class="form-control" name="panjang" placeholder="Panjang">
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                    <b>Normal </b><input type="radio" class="form-control" name="jenis_kelahiran" value="normal" checked>
                                    <b>Caesar </b><input type="radio" class="form-control" name="jenis_kelahiran" value="caesar">
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