@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Cetak Surat</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Surat Kurang Mampu</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{url('surat/cetak-surat-kurang-mampu/')}}">
                            @csrf
                            <input type="hidden" value="{{$kode_surat}}" name="kode_surat" />
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>NIK/Nama</b></label>
                                <div class="col-md-9 p-0">
                                    <select class="form-control" name="penduduk_id" required>
                                        <option value=""> - Pilih -</option>
                                        @foreach ($penduduk as $item)
                                        <option value="{{$item->penduduk_id}}">{{$item->nik}} - {{$item->full_name}}</option>
                                        @endforeach;
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Keperluan</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="hal" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
                                <label class="col-md-3 label-control"><b>Staf  Desa</b></label>
                                <div class="col-md-9 p-0">
                                    <select class="form-control" name="staf_id" required>
                                        <option value=""> - Pilih -</option>
                                        @foreach ($staff as $item)
                                        <option value="{{$item->staff_id}}">{{$item->nama_staff}}</option>
                                        @endforeach;
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="{{url('surat/daftar-cetak-surat/')}}" class="btn btn-danger">Kembali</a>
                                    <button type="submit" value="Submit" class="btn btn-warning">CETAK</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
