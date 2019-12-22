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
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control">{{$pendatang->nik}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control">{{$pendatang->full_name}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                   {{$pendatang->DUSUN}} --
                                   
                                   {{$pendatang->RW}} --
                                   
                                   {{$pendatang->RT}}
                                   
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->no_kk}}</label>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->tempat_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->tanggal_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->jekel}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->agama}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->pendidikan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->pekerjaan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->status_perkawinan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                <label class="col-md-3 label-control">{{$pendatang->status_kependudukan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->golongan_darah}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Datang</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->tgl_datang}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alasan Datang</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->alasan_datang}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Alamat Sebelumnya</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$pendatang->alamat_datang}}</label>
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