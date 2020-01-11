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
                            <div class="card-title">Tambah Data RW Dusun : {{$dusun->wilayah_nama}}</div>
                        </div>
                        <div class="card-body">
                        <form role="form" method="post"  action="{{url('kependudukan/wilayah/create-rw/'.$dusun->wilayah_id)}}" >
                            @csrf
                            <div class="form-group form-group-default">
                                <label><b>RW</b></label>
                                <input name="wilayah_nama" type="text" class="form-control" placeholder="Rw">
                            </div>
                            <div class="form-group form-group-default" style="overflow: inherit">
                                <label>Ketua RW</label>
                                <div class="autocomplete" style="width:300px;">
                                    <input id="input-auto-coplate" type="text" placeholder="NIK / Nama" class="form-control input-full">
                                    <input type="hidden" name="penduduk_id" id="penduduk_id"/>
                                </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                            <a href="{{url('kependudukan/wilayah/view/'.$dusun->wilayah_id)}}" class="btn btn-danger">Kembali</a>
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