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
                        <div class="card-title">Detail Data Kelahiran </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>KIA</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control">{{$kelahiran->nik}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control">{{$kelahiran->full_name}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                   {{$kelahiran->DUSUN}} --
                                   
                                   {{$kelahiran->RW}} --
                                   
                                   {{$kelahiran->RT}}
                                   
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->no_kk}}</label>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->tempat_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->tanggal_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->jekel}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->agama}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pendidikan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->pendidikan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Pekerjaan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->pekerjaan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Perkawinan</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->status_perkawinan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                <label class="col-md-3 label-control">{{$kelahiran->status_kependudukan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control">{{$kelahiran->golongan_darah}}</label>
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