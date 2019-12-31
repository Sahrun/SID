@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kelahiran</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Kelahiran</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="{{url('kependudukan/kelahiran/add')}}">
                                <i class="fa fa-plus"></i> Tambah Data Kelahiran
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
                                                        <th style="width: 233px;">Nama</th>
                                                        <th style="width: 344px;">KIA</th>
                                                        <th style="width: 344px;">NO KK</th>
                                                        <th style="width: 344px;">Jenis Kelamin</th>
                                                        <th style="width: 344px;">Tanggal Kelahiran</th>
                                                        <th style="width: 344px;">Kondisi Lahir</th>
                                                        <th style="width: 108px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no =1 ?>
                                                    @foreach ($kelahiran as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->full_name}}</td>
                                                            <td>{{$item->nik}}</td>
                                                            <td>{{$item->no_kk}}</td>
                                                            <td>{{$item->jekel}}</td>
                                                            <td>{{$item->tanggal_lahir}}</td>
                                                            <td>{{$item->kondisi_lahir}}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{url('kependudukan/kelahiran/view/'.$item->kelahiran_id)}}" class="btn btn-link btn-primary btn-lg" title="Lihat">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a> 
                                                                    <a href="{{url('kependudukan/kelahiran/edit/'.$item->kelahiran_id)}}" class="btn btn-link btn-primary btn-lg" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a title="Hapus" class="btn btn-link btn-danger"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/kelahiran/delete/'.$item->kelahiran_id)}}">
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
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled" id="add-row_previous"><a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                    <li class="paginate_button page-item active"><a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="add-row" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                    <li class="paginate_button page-item next" id="add-row_next"><a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                                                </ul>
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
    </div>
    @stop