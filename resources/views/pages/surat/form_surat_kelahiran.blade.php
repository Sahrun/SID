@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Cetak Surat</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Surat Kelahiran</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('surat/cetak-surat-kelahiran/')}}" >
                            @csrf
                            <input type="hidden" value="{{$kode_surat}}" name="kode_surat" />
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Anak</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="penduduk_id" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($penduduk as $item)
                                        <option value="{{$item->penduduk_id}}">{{$item->full_name}}</option>
                                        @endforeach;
                                    </select>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nomor Surat</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nomor_surat" placeholder="Nomor Surat" required>
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Keperluan</b></label>
								<div class="col-md-9 p-0">
                                    <input type="text" class="form-control input-full" name="hal" required>
                                 </div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Staf  Desa</b></label>
								<div class="col-md-9 p-0">
                                    <select class="form-control" name="staf_id" required> 
                                        <option value=""> - Pilih -</option>
                                        @foreach ($staff as $item)
                                        <option value="{{$item->staff_id}}">{{$item->nama_staff}}</option>
                                        @endforeach;
                                    </select>
                                 </div>
							</div>
                           
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="{{url('surat/daftar-cetak-surat/')}}" class="btn btn-danger">Kembali</a>
                                    <button type="submit" value="Submit" class="btn btn-warning">CETAK</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   var url = "{{url('kependudukan/penduduk/')}}";
   function GetRW(evnt){
        $.get(url+"/get_wilayah/"+evnt.value+"/rw", function(data, status){
           
            $('#wilayah_rw')
            .find('option')
            .remove()
            .end()
            .append('<option>- Pilih -</option>');

            for(i=0;i < data.length;i++)
                {   
                    $('#wilayah_rw').append(`<option value="${data[i].wilayah_id}"> 
                                            ${data[i].wilayah_nama} 
                                        </option>`); 
                }
        
        });
   }
   function GetRT(evnt){
        $.get(url+"/get_wilayah/"+evnt.value+"/rt", function(data, status){
            $('#wilayah_rt')
            .find('option')
            .remove()
            .end()
            .append('<option>- Pilih -</option>');
            for(i=0;i < data.length;i++)
                {   
                    $('#wilayah_rt').append(`<option value="${data[i].wilayah_id}"> 
                                            ${data[i].wilayah_nama} 
                                        </option>`); 
                }
        
        });
   }
</script>
@stop