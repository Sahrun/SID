@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Penduduk Pindah</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Penduduk Pindah</h4>
                                <a class="btn btn-primary btn-round ml-auto" href="{{url('kependudukan/penduduk-pindah/add')}}">
                                <i class="fa fa-plus"></i> Tambah Data Penduduk Pindah
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
                                                        <th>No</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Pindah</th>
                                                        <th>Alasan Pindah</th>
                                                        <th>Alamat Pindah</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = ($showdata * $page) + 1 ?>
                                                    @foreach ($penduduk_pindah as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->nik}}</td>
                                                            <td>{{$item->full_name}}</td>
                                                            <td>{{$item->tgl_pindah}}</td>
                                                            <td>{{$item->alasan_pindah}}</td>
                                                            <td>{{$item->alamat_pindah}}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a onclick="open_form({{$item->pindah_id}})" class="btn btn-link btn-primary btn-lg" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a title="Hapus" class="btn btn-link btn-danger"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/penduduk-pindah/delete/'.$item->pindah_id)}}">
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
<!-- Modal -->
<div class="modal fade" id="popup_form_edit_penduduk_pindah" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><b>Edit Data Penduduk Pindah</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" id="form_edit_penduduk_pindah" action="{{url('kependudukan/penduduk-pindah/update/')}}">
      @csrf
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
                    <label class="col-md-3 label-control"><b>Tanggal Pindah</b></label>
                    <div class="col-md-9 p-0">
                        <input type="date" class="form-control" name="tgl_pindah" id="tgl_pindah" required>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Alasan Pindah</b></label>
                    <div class="col-md-9 p-0">
                            <select name="alasan_pindah"  id="alasan_pindah" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="Pekerjaan">Pekerjaan</option>
                                <option value="Transmigrasi">Transmigrasi</option>
                                <option value="Lainnya">Lainnya</option>
                             </select>
				    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Alamat Pindah</b></label>
                    <div class="col-md-9 p-0">
                        <textarea name="alamat_pindah" class="form-control input-full" id="alamat_pindah" required></textarea>
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
      var url = "{{url('lap/excel-penduduk-pindah/')}}";

      var currentUrl = new URL(window.location.href);
        var search_val = currentUrl.searchParams.get("search");
        var current_page = "{{$page}}";
        var baseUrl = "{{url('')}}" + window.location.pathname;

        $("#search").val(search_val);

      function open_form(id){
                $('#nik').html(null);
                $('#nama').html(null);
                $('#usia').html(null);
                $('#tgl_pindah').val(null);
                $('#alasan_pindah').val(null);
                $('#alamat_pindah').val(null);
                
                $.get(url+"/edit/"+id, function(data, status){
                    if(data !== null){
                        $('#nik').html(data.nik);
                        $('#nama').html(data.nama);
                        $('#tgl_pindah').val(data.tgl_pindah);
                        $('#alasan_pindah').val(data.alasan_pindah);
                        $('#alamat_pindah').val(data.alamat_pindah);
                        $("#form_edit_penduduk_pindah").attr("action", url+"/update/"+data.pindah_id);
                        $("#popup_form_edit_penduduk_pindah").modal('show');
                    }else{
                        alert("Data penduduk tidak di temukan");
                    }
                });
        }
        
       
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