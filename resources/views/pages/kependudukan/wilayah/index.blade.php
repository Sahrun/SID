@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Wilayah</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Wilayah</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="wilayah/add">
                                <i class="fa fa-plus"></i> Tambah Wilayah
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
                                                    <th  tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">No</th>
                                                        <th >Dusun</th>
                                                        <th >Kepala Dusun</th>
                                                        <th >Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $no =1 ?>
                                                @foreach ($wilayah as $item)
                                                    <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                        <td class="sorting_1">{{$no++}}</td>
                                                        <td class="sorting_1">{{$item->wilayah_nama}}</td>
                                                        <td>{{$item->full_name}}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                            
                                                            <a href="{{url('kependudukan/wilayah/view/'.$item->wilayah_id)}}" class="btn btn-link btn-primary btn-lg" title="Lihat">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a href="{{url('kependudukan/wilayah/edit/'.$item->wilayah_id)}}" class="btn btn-link btn-primary btn-lg" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a title="Hapus" class="btn btn-link btn-danger"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/wilayah/delete/'.$item->wilayah_id)}}">
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