@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Surat</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Cetak Surat</h4>
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
                                                        <th>Kode Surat</th>
                                                        <th>Nama Surat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $no =1 ?>
                                                @foreach ($surat as $item)
                                                    <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                        <td>{{$no++}}</td>
                                                        <td>{{$item['kode']}}</td>
                                                        <td>{{$item['title']}}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                    <a href="{{url('surat/download/'.$item['template'])}}" target="_blank" class="btn btn-link btn-success btn-sm" title="Cetak" >
                                                                        <i class="fa fa-print"></i>
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

<div class="modal fade" id="popup_upload_file" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><b>Update Surat</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" id="upload_file" action="{{url('surat/upload')}}" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
                <input type="hidden" name="kode" id="kode"/>
                <div class="form-group form-inline">
                    <div class="col-md-12">
                        <label class="label-control" id="title_surat"></label>
                    </div>
				</div>
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control" style="text-align:right;display:block"><b>File</b></label>
                    <div class="col-md-9 p-0">
                        <input type="file" name="file" class="form-control" accept=".rtf" required/>
				    </div>
				</div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
      function open_form(kode,title)
      {
          $("#title_surat").html("<b>"+title+"</b>");
          $("#kode").val(kode);
         $("#popup_upload_file").modal('show');
      }
    </script>


@stop