@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Penduduk</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Penduduk</h4>
                                <div class="ml-auto">
                                    <a class="btn btn-primary btn-round" href="{{url('kependudukan/penduduk/add')}}">
                                        <i class="fa fa-plus"></i> Tambah Penduduk
                                    </a>
                                    <a class="btn btn-success btn-round" id="excel-btn" href="{{url('/kependudukan/penduduk/excel-penduduk')}}" target="_blank">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
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
                                                <label>Search:
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
                                                        <th tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 233px;">NIK</th>
                                                        <th class="sorting_asc" id="sorting_nama" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 344px;" onclick="sorting(this)">Nama</th>
                                                        <th tabindex="0" aria-controls="add-row" rowspan="1" colspan="1"  style="width: 344px;">Usia</th>
                                                        <th style="width: 108px;"  tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" >Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = ($showdata * $page) + 1 ?>
                                                    @foreach ($penduduk as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td class="sorting_1">{{$no++}}</td>
                                                            <td class="sorting_1">{{$item->nik}}</td>
                                                            <td>{{$item->full_name}}</td>
                                                            <td>{{date_diff(date_create($item->tanggal_lahir), date_create('now'))->y}}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                <a href="{{url('kependudukan/penduduk/view/'.$item->penduduk_id)}}" class="btn btn-link btn-primary btn-lg" title="Lihat">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{url('kependudukan/penduduk/edit/'.$item->penduduk_id)}}" class="btn btn-link btn-primary btn-lg" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a title="Hapus" class="btn btn-link btn-danger"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/penduduk/delete/'.$item->penduduk_id)}}">
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
        var ordered = currentUrl.searchParams.get("order");

        $("#search").val(search_val);

        if(ordered == "desc")
        {
            $("#sorting_nama").removeClass('sorting_asc').addClass('sorting_desc');
        }
        else{
            $("#sorting_nama").removeClass('sorting_desc').addClass('sorting_asc');
        }

        
        function filter_data(page=null,shorting = null){     
            var showdata = $("#show_data").val();
            var search =  $("#search").val();
            var order  = 'asc';

            if(page == null)
            {
                page ='';
            }
            if(shorting !== null)
            {
                order = shorting;
            }

            return baseUrl+"?search="+search+"&showdata="+showdata+"&page="+page+"&order="+order;
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

        function sorting(element)
        {
            var classShorting = element.className == "sorting_asc" ? "desc" : "asc";
            window.location.href = filter_data(0,classShorting);
        }
        
    </script>   
    @stop