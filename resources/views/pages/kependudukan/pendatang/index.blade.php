@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pendatang</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Pendatang</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="{{url('kependudukan/pendatang/add')}}">
                                <i class="fa fa-plus"></i> Tambah Data Pendatang
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
                                                    <select name="show_data" id="show_data" aria-controls="add-row" class="form-control form-control-sm" onchange="searchChange()">
                                                            <option value="10" {{$showdata == "10"?"selected":""}}>10</option>
                                                            <option value="25" {{$showdata == "25"?"selected":""}}>25</option>
                                                            <option value="50" {{$showdata == "50"?"selected":""}}>50</option>
                                                            <option value="100" {{$showdata == "100"?"selected":""}}>100</option>
                                                    </select> entries</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="add-row_filter" class="dataTables_filter">
                                                <label>Search NIK/Nama:
                                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="add-row" name="search" id="search" onkeyup="searchEnter(event)">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                                <thead>
                                                    <tr role="row">
                                                    <th  tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">No</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Datang</th>
                                                        <th>Alasan Datang</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = ($showdata * $page) + 1 ?>
                                                    @foreach ($pendatang as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td class="sorting_1">{{$no++}}</td>
                                                            <td class="sorting_1">{{$item->nik}}</td>
                                                            <td>{{$item->full_name}}</td>
                                                            <td>{{$item->tgl_datang}}</td>
                                                            <td>{{$item->alasan_datang}}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                
                                                                <a href="{{url('kependudukan/pendatang/view/'.$item->pendatang_id)}}" class="btn btn-link btn-primary btn-lg" title="Lihat">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{url('kependudukan/pendatang/edit/'.$item->pendatang_id)}}" class="btn btn-link btn-primary btn-lg" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a title="Hapus" class="btn btn-link btn-danger"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/pendatang/delete/'.$item->pendatang_id)}}">
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
                                                    <li class="paginate_button page-item previous {{($page) <= 0 ? 'disabled':''}}" id="add-row_previous">
                                                        <a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link" onmouseover="searchPage(this,{{$page - 1}})">Previous</a>
                                                    </li>
                                                    @for ($i = 1; $i <= $pages; $i++)
                                                        <li class="paginate_button page-item {{($page + 1) == $i? 'active':''}}">
                                                            <a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link"  onmouseover="searchPage(this,{{$i -1 }})">{{$i}}</a>
                                                        </li>
                                                    @endfor
                                                    <li class="paginate_button page-item next {{($page + 2) <= $pages? '':'disabled'}}" id="add-row_next">
                                                        <a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link" onmouseover="searchPage(this,{{$page + 1}})">Next</a>
                                                    </li>
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
    <script>
        var currentUrl = new URL(window.location.href);
        var search_val = currentUrl.searchParams.get("search");
        var current_page = "{{$page}}";
        var baseUrl = "{{url('')}}" + window.location.pathname;

        $("#search").val(search_val);

       
        function filter_data(page=null){     
            var showdata = $("#show_data").val();
            var search =  $("#search").val();
            return baseUrl+"?search="+search+"&showdata="+showdata+"&page="+page;
        }

        function searchEnter(event){
            if (event.keyCode === 13) {
                window.location.href = filter_data(0);
            }
        }

        function searchChange(){
                window.location.href = filter_data(current_page);
        }
        
        function searchPage(event,page)
        {
            event.href = filter_data(page);
        }
        
    </script> 
    @stop