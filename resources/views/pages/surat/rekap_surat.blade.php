@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Surat</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Rekap Surat</h4>
                                <div class="btn-round ml-auto">
                                    <form method="POST" action="{{url('/surat/rekap-surat/')}}">
                                       @csrf
                                       Start <input type="date" name="startDate" value="{{$filter['startDate']}}"/>
                                       End <input type="date" name="endDate" value="{{$filter['endDate']}}"/>
                                       <input type="submit" value="submit"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>No</th>
                                                        <th>Jenis Surat</th>
                                                        <th>Nama Penduduk</th>
                                                        <th>Ditandatangani Oleh</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $no =1 ?>
                                                @foreach ($surat as $item)
                                                    <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                        <td>{{$no++}}</td>
                                                        <td>{{$item->nama_surat}}</td>
                                                        <td>{{$item->nama_penduduk}}</td>
                                                        <td>{{$item->nama_staff}}</td>
                                                        <td>{{$item->tanggal}}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                    <a
                                                                    class="btn btn-link btn-danger" title="Hapus"
                                                                    onclick="return confirm('Anda akan menghapus?')" href="{{url('surat/delete/'.$item->surat_id)}}" >
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop