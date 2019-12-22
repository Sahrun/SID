@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Keluarga</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Detail Kartu Keluarga : </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <table class="display table table-hover" >
                                            <tbody>
                                                <tr>
                                                    <th style="width:30%">No. Kartu Keluarga</th>
                                                    <td>:   {{$keluarga->no_kk}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:0%">Nama Kepala Keluarga</th>
                                                    <td>:   {{$keluarga->full_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:30%">Alamat</th>
                                                    <td>:   {{$keluarga->alamat_keluarga}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:30%">Dusun</th>
                                                    <td>:   {{$keluarga->DUSUN}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:30%">RW</th>
                                                    <td>:   {{$keluarga->RW}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:30%">RT</th>
                                                    <td>:   {{$keluarga->RT}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-header">
                                         <div class="card-title"><b>Anggota Keluarga :</b> 
                                         <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah_anggota"> 
                                         <b style="color:white">Tambah Anggota Keluarga</b></button>
                                         </div>
                                        </div>
                                        <table class="display table table-striped table-hover dataTable" >
                                            <thead>
                                                <tr>
                                                    <th>NIK</th>
                                                    <th>Nama</th>
                                                    <th>Hubungan</th>
                                                    <th>Usia</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no =1 ?>
                                                @foreach ($penduduk as $item)
                                                <tr>
                                                    <td>{{$item->nik}}</td>
                                                    <td>{{$item->full_name}}</td>
                                                    <td>{{$item->hubungan_keluarga}}</td>
                                                    <td>{{date_diff(date_create($item->tanggal_lahir), date_create('now'))->y}}</td>
                                                    <th style="width:30px;">
                                                            <div class="form-button-action">
                                                                <button  class="btn btn-link btn-primary btn-sm" title="Edit" onclick="edit_angota({{$item->penduduk_id}})">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <a href="{{url('kependudukan/penduduk/view/'.$item->penduduk_id)}}" class="btn btn-link btn-primary btn-sm" title="Show">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a title="Delete" class="btn btn-link btn-danger btn-sm"  onclick="return confirm('Anda akan menghapus?')" href="{{url('kependudukan/keluarga/delete-anggota/'.$item->penduduk_id)}}">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                    </th>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                            <div class="form-group">
                                                <a href="{{url('kependudukan/keluarga')}}" class="btn btn-danger">Kembali</a>
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
<div class="modal fade" id="tambah_anggota" tabindex="-1" role="dialog" aria-labelledby="tambah_anggota" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambah_anggota">Tambah Anggota Keluarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post"  action="{{url('kependudukan/keluarga/tambah-anggota/'.$keluarga->keluarga_id)}}">
      @csrf
        <div class="modal-body">
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>Anggota Keluarga</b></label>
                    <div class="col-md-9 p-0">
                            <select class="form-control" name="penduduk_id"> 
                                    <option value=""> - Pilih -</option>
                                    @foreach ($penduduk_baru as $item)
                                    <option value="{{$item->penduduk_id}}">{{$item->full_name}}</option>
                                    @endforeach;
                            </select>
				</div>
				</div>
                <div class="form-group form-inline">
					<label class="col-md-3 label-control"><b>Hubungan Keluarga</b></label>
					<div class="col-md-9 p-0">
                            <select class="form-control" name="hubungan_keluarga" > 
                                    <option value=""> - Pilih -</option>
                                    <option value="KEPALA KELUARGA" style="{{$keluarga->kepala_keluarga?'display:none':''}}">KEPALA KELUARGA</option>
                                    <option value="SUAMI">SUAMI</option>
                                    <option value="ISTRI">ISTRI</option>
                                    <option value="ANAK">ANAK</option>
                                    <option value="MENANTU">MENANTU</option>
                                    <option value="CUCU">CUCU</option>
                                    <option value="ORANGTUA">ORANGTUA</option>
                                    <option value="MERTUA">MERTUA</option>
                                    <option value="FAMILI LAIN">FAMILI LAIN</option>
                                    <option value="PEMBANTU">PEMBANTU</option>
                                    <option value="LAINNYA">LAINNYA</option>
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

<div class="modal fade" id="edit_anggota" tabindex="-1" role="dialog" aria-labelledby="edit_anggota" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit_anggota">Tambah Anggota Keluarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" id="form_update_anggota" method="post"  action="">
      @csrf
        <div class="modal-body">
                <div class="form-group form-inline">
                    <label class="col-md-3 label-control"><b>No.KK</b></label>
                    <div class="col-md-9 p-0">
                        <input type="text" class="form-control input-full" name="no_kk" placeholder="No. Kartu Keluarga" id="no_kk_edit" disabled> 
				    </div>
                </div>
                <div class="form-group form-inline">
					<label class="col-md-3 label-control"><b>Hubungan Keluarga</b></label>
					<div class="col-md-9 p-0">
                            <select class="form-control" name="hubungan_keluarga" id="hubungan_keluarga_edit"> 
                                    <option value=""> - Pilih -</option>
                                    <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                                    <option value="SUAMI">SUAMI</option>
                                    <option value="ISTRI">ISTRI</option>
                                    <option value="ANAK">ANAK</option>
                                    <option value="MENANTU">MENANTU</option>
                                    <option value="CUCU">CUCU</option>
                                    <option value="ORANGTUA">ORANGTUA</option>
                                    <option value="MERTUA">MERTUA</option>
                                    <option value="FAMILI LAIN">FAMILI LAIN</option>
                                    <option value="PEMBANTU">PEMBANTU</option>
                                    <option value="LAINNYA">LAINNYA</option>
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
   var url = "{{url('kependudukan/keluarga/')}}";
   function edit_angota(id){
       $("#edit_anggota").modal('show');
        $.get(url+"/edit-anggota/"+id, function(data, status){
           $('#no_kk_edit').val(data.no_kk);
           $('#hubungan_keluarga_edit').val(data.hubungan_keluarga);
           $("#form_update_anggota").attr("action", url+"/update-anggota/"+data.penduduk_id);
        });
   }
</script>
    @stop