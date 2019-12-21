@extends('layouts.default') 
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Staff Desa</h4>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Data Staff Desa</div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post"  action="{{url('staff/update/'.$staff->staff_id)}}" >
                            @csrf
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Nama Staff</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="nama_staff" Value="{{$staff->nama_staff}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIP</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="staff_nip" Value="{{$staff->staff_nip}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>NIK</b></label>
								<div class="col-md-9 p-0">
                                     <input type="text" class="form-control input-full" name="staff_nik" Value="{{$staff->staff_nik}}">
								</div>
							</div>
                            <div class="form-group form-inline">
								<label class="col-md-3 label-control"><b>Posisi Staff</b></label>
								<div class="col-md-9 p-0">
									<input type="text" class="form-control input-full" name="staff_posisi" Value="{{$staff->staff_posisi}}">
								</div>
							</div>
                            <div class="form-group">    
                                <div class="col-md-3 col-md-offset-9">
                                    <button type="submit" value="Submit" class="btn btn-primary">Update</button>
									<a href="{{url('staff')}}" class="btn btn-danger">Kembali</a>
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