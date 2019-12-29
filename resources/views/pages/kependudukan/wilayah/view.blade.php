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
                            <div class="card-title">Daftar RW di Dusun : {{$dusun->wilayah_nama}}</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <table class="display table table-striped table-hover dataTable" >
                                            <tbody>
                                                <tr>
                                                    <td>Dusun</td>
                                                    <td>{{$dusun->wilayah_nama}}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="display table table-striped table-hover dataTable" >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>RW</th>
                                                    <th>Ketua RW</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ($rw as $row)
                                                    <tr  class="{{$no%2?'odd':'even'}}">
                                                        <td>{{$no ++}}</td>
                                                        <td>{{$row->wilayah_nama}}</td>
                                                        <td>{{$row->full_name == null?'-':$row->full_name}}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                            <a  class="btn btn-link btn-success btn-sm"
                                                                    title="Lihat"
                                                                    href="{{url('kependudukan/wilayah/view-rw/'.$row->wilayah_id)}}"
                                                                    >
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a  class="btn btn-link btn-warning btn-sm" 
                                                                    title="Edit"
                                                                    href="{{url('kependudukan/wilayah/edit-rw/'.$row->wilayah_id)}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a title="Hapus" class="btn btn-link btn-danger btn-sm"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/wilayah/delete/'.$row->wilayah_id)}}">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                            <div class="form-group">
                                                <a href="{{url('kependudukan/wilayah/')}}" class="btn btn-danger">Kembali</a> 
                                                <a href="{{url('kependudukan/wilayah/add-rw/'.$dusun->wilayah_id)}}" class="btn btn-primary">Tambah RW</a>
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