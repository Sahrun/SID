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
                            <div class="card-title">Edit Data RT : {{$rt->wilayah_nama}} , RW : {{ $rw->wilayah_nama}}</div>
                        </div>
                        <div class="card-body">
                         <form role="form" action="{{url('kependudukan/wilayah/update-rt/'.$rt->wilayah_id)}}" method="POST" >
                            @csrf
                            <div class="form-group form-group-default">
                                <label><b>RT</b></label>
                                <input name="wilayah_nama" type="text" class="form-control" placeholder="RT" value="{{$rt->wilayah_nama}}">
                            </div>
                            <div class="form-group form-group-default" style="overflow: inherit">
                                <label>Kepala Dusun</label>
                                <div class="autocomplete" style="width:300px;">
                                        <input id="input-auto-coplate" type="text" placeholder="NIK / Nama" class="form-control input-full" required>
                                        <input type="hidden" name="penduduk_id" id="penduduk_id" required value="{{$rt->penduduk_id}}"/>
                                </div>
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
    <script>
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
        autocomplete(document.getElementById("input-auto-coplate"), penduduk,"penduduk_id");
        // End
    </script>
    @stop