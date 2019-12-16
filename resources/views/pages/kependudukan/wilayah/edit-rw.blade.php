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
                            <div class="card-title">Edit Data RW Dusun : {{$dusun->wilayah_nama}}</div>
                        </div>
                        <div class="card-body">
                         <form role="form" action="{{url('kependudukan/wilayah/update-rw/'.$rw->wilayah_id)}}" method="POST" >
                            @csrf
                            <div class="form-group form-group-default">
                                <label><b>RW</b></label>
                                <input name="wilayah_nama" type="text" class="form-control" placeholder="RW" value="{{$rw->wilayah_nama}}">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Kepala Dusun</label>
                                <select class="form-control" id="penduduk_id" name="penduduk_id">
                                @foreach ($penduduk as $item)
                                        <option value="{{ $item->penduduk_id }}">{{$item->full_name}} - {{ $item->nik }} </option> 
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                            <button type="submit" value="Submit" class="btn btn-primary">Update</button>
                            <a href="{{redirect()->back()->getTargetUrl()}}" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop