@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kematian</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Penduduk</h4>
                               
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
                                                        <th>Usia</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = ($showdata * $page) + 1 ?>
                                                    @foreach ($penduduk as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->nik}}</td>
                                                            <td>{{$item->full_name}}</td>
                                                            <td>{{date_diff(date_create($item->tanggal_lahir), date_create('now'))->y}}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a class="btn btn-link btn-danger btn-lg" title="Mati" onclick="open_form({{$item->penduduk_id}})">
                                                                        <i class="fa fa-user-times"></i>
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
                                            <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries
                                            </div>
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
                    <div class="col-lg-12" style="text-align:right">
                        <a href="{{url('kependudukan/kematian')}}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="form_kematian" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><b>Kematian</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post"  action="{{url('kependudukan/kematian/create/')}}">
      @csrf
        <input type="hidden" id="penduduk_id" name="penduduk_id"/>
        <div class="modal-body">
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control" style="text-align:right;display:block"><b>NIK</b></label>
                    <div class="col-md-9 p-0">
                        <label class="col-md-3 label-control" style="text-align:left;display:block" id="nik"></label>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control" style="text-align:right;display:block"><b>Nama</b></label>
                    <div class="col-md-9 p-0">
                        <label class="col-md-3 label-control" style="text-align:left;display:block" id="nama"></label>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control" style="text-align:right;display:block"><b>Usia</b></label>
                    <div class="col-md-9 p-0">
                        <label class="col-md-3 label-control" style="text-align:left;display:block" id="usia"></label>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Tanggal Kematian</b></label>
                    <div class="col-md-9 p-0">
                        <input type="date" class="form-control" name="tgl_kematian" id="tgl_kematian" placeholder="Tanggal Kematian" required onchange="validasitanggal()" id="tgl_kematian">
                        <br/>
                        <span id="error_tgl_kematian" class="text-danger"></span>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Jam Kematian</b></label>
                    <div class="col-md-9 p-0">
                        <input type="time" class="form-control" name="jam_kematian" id="jam_kematian" placeholder="Jam Kematian" required>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Sebab Kematian</b></label>
                    <div class="col-md-9 p-0">
                        <select class="form-control" name="sebab_kematian" id="sebab_kematian" required>
                            <option value="">- Pilih -</option>
                            <option value="Usia Tua">Usia Tua</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Tempat Kematian</b></label>
                    <div class="col-md-9 p-0">
                        <select class="form-control" name="tempat_kematian" id="tempat_kematian" required>
                            <option value="">- Pilih -</option>
                            <option value="Rumah">Rumah</option>
                            <option value="Rumah Sakit">Rumah Sakit</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
				    </div>
				</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <script>
      var url = "{{url('kependudukan/kematian/')}}";


      var currentUrl = new URL(window.location.href);
      var search_val = currentUrl.searchParams.get("search");
      var current_page = "{{$page}}";
      var baseUrl = "{{url('')}}" + window.location.pathname;

      $("#search").val(search_val);



      var ToDate = new Date();


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
                window.location.href = filter_data(0);
        }
        
        function searchPage(event,page)
        {
            event.href = filter_data(page);
        }



      function open_form(id){

                $('#nik').html(null);
                $('#nama').html(null);
                $('#usia').html(null);
                $('#penduduk_id').val(null);
                $('#tgl_kematian').val(null);
                $('#jam_kematian').val(null);
                $('#sebab_kematian').val(null);
                $('#tempat_kematian').val(null);
                $("#error_tgl_kematian").text(null);

                $.get(url+"/get-data-penduduk/"+id, function(data, status){
                    if(data !== null){
                        $('#nik').html(data.nik);
                        $('#nama').html(data.nama);
                        $('#usia').html(data.usia);
                        $('#penduduk_id').val(data.penduduk_id);
                        $("#form_kematian").modal('show');
                    }else{
                        alert("Data penduduk tidak di temukan");
                    }
                });
        }
    function validasitanggal() {
        var tanggal = $("#tgl_kematian").val();
        if (new Date(tanggal).getTime() > ToDate.getTime()) {
            $("#error_tgl_kematian").text("Tanggal Kematian harus kurang dari hari ini");
            $("#tgl_kematian").val(null);
            return false;
        }else{
            $("#error_tgl_kematian").text(null);
        }
        return true;
     }
    </script>
    @stop