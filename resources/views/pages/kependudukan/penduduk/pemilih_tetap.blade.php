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
                                <h4 class="card-title">Data Daftar Pemilih Tetap</h4>
                                <div class="ml-auto">
                                        <input type="date" name="tanggal" id="tanggal" value="{{$tanggal}}"/>
                                        <button onclick="searchTanggal()">Filter</button>
                                        <a class="btn btn-success btn-round ml-auto" id="excel-btn" href="#" target="_blank">
                                            <i class="fas fa-download"></i> Export
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
                                                            <option value="0" {{$showdata == "0"?"selected":""}}>All</option>
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
                                                        <th>No</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Usia</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = ($showdata * $page) + 1 ?>
                                                    @foreach ($pemilih as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td class="sorting_1">{{$no++}}</td>
                                                            <td class="sorting_1">{{$item->nik}}</td>
                                                            <td>{{$item->full_name}}</td>
                                                            <td>{{$item->usia}}</td>
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
            var tanggal = $("#tanggal").val();
            return "?search="+search+"&tanggal="+tanggal+"&showdata="+showdata+"&page="+page;
        }

        function searchEnter(event){
            if (event.keyCode === 13) {
                window.location.href = baseUrl+filter_data(0);
            }
        }

        function searchChange(){
                window.location.href = baseUrl+filter_data(current_page);
        }
        
        function searchPage(event,page)
        {
            event.href = baseUrl+filter_data(page);
        }

        function searchTanggal()
        {
            window.location.href = baseUrl+filter_data(current_page);
        }

        var export_url = "{{url('/kependudukan/penduduk/pemilih-tetap-export')}}";
        var button = $("#excel-btn");
        button[0].href=export_url+filter_data(current_page);
    </script>
    @stop