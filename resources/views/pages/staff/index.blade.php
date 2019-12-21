@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Staff Desa</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Staff Desa</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="{{url('staff/add')}}">
                                <i class="fa fa-plus"></i> Tambah Staff Desa
                                </a>
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
                                                        <th>Nama</th>
                                                        <th>NIP</th>
                                                        <th>NIK</th>
                                                        <th>Jabatan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no =1 ?>
                                                    @foreach ($staff as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->nama_staff}}</td>
                                                            <td>{{$item->staff_nip}}</td>
                                                            <td>{{$item->staff_nik}}</td>
                                                            <td>{{$item->staff_posisi}}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{url('staff/edit/'.$item->staff_id)}}" class="btn btn-link btn-primary btn-lg" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a title="Delete" class="btn btn-link btn-danger"  onclick="return confirm('Anda akan menghapus?')" href="{{url('staff/delete/'.$item->staff_id)}}">
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