@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Wilayah</h4>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Data RT RW : {{$rw->wilayah_nama}}</div>
                        </div>
                        <div class="card-body">
                        <form role="form" method="post"  action="{{url('kependudukan/wilayah/create-rt/'.$rw->wilayah_id)}}" >
                            @csrf
                            <div class="form-group form-group-default">
                                <label><b>RT</b></label>
                                <input name="wilayah_nama" type="text" class="form-control" placeholder="RT">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Ketua RT</label>
                                <select class="form-control" id="penduduk_id" name="penduduk_id">
                                @foreach ($penduduk as $item)
                                        <option value="{{ $item->penduduk_id }}">{{$item->full_name}} - {{ $item->nik }} </option> 
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                            <a href="{{url('kependudukan/wilayah/view-rw/'.$rw->wilayah_id)}}" class="btn btn-danger">Kembali</a>
                            <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop