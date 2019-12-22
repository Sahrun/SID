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
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>KIA</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->nik}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Nama Lengkap</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->full_name}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Wilayah</b></label>
								<div class="col-md-9 p-0">
                                    <label class="col-md-3 label-control" style="text-align:left;display:block">:
                                                {{$kelahiran->DUSUN}} /
                                            
                                                {{$kelahiran->RW}} /
                                            
                                                {{$kelahiran->RT}}
                                    </label>
                                   
                                   
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>No Kartu Keluarga</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->no_kk}}</label>
                                </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tempat Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->tempat_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Tanggal Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->tanggal_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Jenis Kelamin</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->jekel}}</label>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Agama</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->agama}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Status Kependudukan</b></label>
								<div class="col-md-9 p-0"> 
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->status_kependudukan}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Golongan Darah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->golongan_darah}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Anak Ke</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->anak_ke}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>NIK Ibu</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->nik_ibu}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>NIK Ayah</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->nik_ayah}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Waktu Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->tob}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Penolong Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->hob}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Konsisi Lahir</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->kondisi_lahir}}</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Berat</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->berat}} Kg</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Panjang</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->panjang}} Cm</label>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control" style="text-align:left;display:block"><b>Jenis Kelahiran</b></label>
								<div class="col-md-9 p-0">
                                <label class="col-md-3 label-control" style="text-align:left;display:block">: {{$kelahiran->jenis_kelahiran}}</label>
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