
<table>
    <thead>
        <tr role="row">
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>No. KK</th>
            <th>Dusun</th>	
            <th>RW</th>	
            <th>RT</th>	
            <th>Kewarganegaraan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Usia</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Pendidikan</th>
            <th>Pekerjaan Status</th>
            <th>Perkawinan</th>
            <th>Golongan Darah</th>
            <th>Status Kependudukan</th>
            <th>Status Rekam KTP Elektronik</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($pemilihtetap as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}&nbsp;</td>
            <td>{{$item->full_name}}</td>
            <td>{{$item->no_kk}}&nbsp;</td>
            <td>{{$item->dusun}}</td>
            <td>{{$item->rw}}</td>
            <td>{{$item->rt}}</td>
            <td>{{$item->status_warganegara}}</td>
            <td>{{$item->tempat_lahir}}</td>
            <td>{{$item->tanggal_lahir}}</td>
            <td>{{$item->usia}}</td>
            <td>{{$item->jekel}}</td>
            <td>{{$item->agama}}</td>
            <td>{{$item->pendidikan}}</td>
            <td>{{$item->pekerjaan}}</td>
            <td>{{$item->status_perkawinan}}</td>
            <td>{{$item->golongan_darah}}</td>
            <td>{{$item->status_kependudukan}}</td>
            <td>{{$item->ktp_elektronik}}</td>
        </tr>
        @endforeach
    </tbody>
</table>