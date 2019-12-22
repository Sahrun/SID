@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Daftar Surat</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Keluarga</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="{{url('kependudukan/keluarga/add')}}">
                                <i class="fa fa-plus"></i> Tambah Keluarga
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="add-row_length">
                                                <label>Show
                                                    <select name="add-row_length" aria-controls="add-row" class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> entries</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="add-row_filter" class="dataTables_filter">
                                                <label>Search:
                                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="add-row">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>No</th>
                                                        <th>Kode Surat</th>
                                                        <th>Nama Surat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $no =1 ?>
                                                @foreach ($surat as $item)
                                                    <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                        <td class="sorting_1">{{$no++}}</td>
                                                        <td class="sorting_1">{{$item->kode}}</td>
                                                        <td>{{$item->title}}</td>
                                                        <td>
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