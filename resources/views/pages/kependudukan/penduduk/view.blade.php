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
                        <div class="card-title">Detail Penduduk </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>NIK</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->nik}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->full_name}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">:
                                   {{$penduduk->DUSUN}} /
                                   
                                   {{$penduduk->RW}} /
                                   
                                   {{$penduduk->RT}}
                                   </label>
                                   
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->no_kk}}</label>
                                </div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->tempat_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->tanggal_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->jekel}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Alamat</b></label>
								<div class="col-md-9 p-0">
								<label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->alamat}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->agama}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->pendidikan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->pekerjaan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->status_perkawinan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->status_kependudukan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
                            <label class="col-md-3 label-control" style="text-align:left;display:block"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$penduduk->golongan_darah}}</label>
								</div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="{{redirect()->back()->getTargetUrl()}}" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop