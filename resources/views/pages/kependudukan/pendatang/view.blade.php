@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
		<h4 class="page-title">Data Pendatang</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Penduduk Pendatang </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>NIK</b></label>
								<div class="col-md-9 p-0">
								<label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->nik}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
								<label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->full_name}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
								<label class="col-md-3 label-control" style="text-align:left;display:block">: 
                                   {{$pendatang->DUSUN}} /
                                   
                                   {{$pendatang->RW}} /
                                   
                                   {{$pendatang->RT}}
                                </label>

								</div>
							</div>
							<div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Alamat</b></label>
								<div class="col-md-9 p-0">
								<label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->alamat}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->no_kk}}</label>
                                </div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->tempat_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->tanggal_lahir}}</label>
								</div>
							</div>
							<div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>No Akta Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->no_akta_kelahiran}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->jekel}}</label>
                                 </div>
							</div>
							<div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Nama Ayah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->nama_ayah}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Nama Ibu</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->nama_ibu}}</label>
								</div>
							</div>
							<div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Status Kewarganegaraan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->status_warganegara}}</label>
                                 </div>
							</div>
							<div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Nomor KITAS/KITAP</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->no_kitas_kitap}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>No Paspor</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->no_paspor}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>KTP Elektronik</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->ktp_elektronik}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->agama}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->pendidikan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->pekerjaan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->status_perkawinan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Status Kependudukan Sekarang</b></label>
								<div class="col-md-9 p-0"> 
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->status_kependudukan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->golongan_darah}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tanggal Datang</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->tgl_datang}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Alasan Datang</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->alasan_datang}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
							<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Alamat Sebelumnya</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$pendatang->alamat_datang}}</label>
								</div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="{{url('kependudukan/pendatang')}}" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop