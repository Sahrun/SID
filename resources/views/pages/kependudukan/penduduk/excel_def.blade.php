<table>
    <thead>
        <tr role="row">
            <th>No.</th>
            <th>NIK</th>
            <th>No. KK</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Kewarganegaraan</th>
            <th>Usia</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>Status Perkawinan</th>
            <th>Status Kependudukan</th>
            <th>Status Rekam KTP Elektronik</th>
            <th>Golongan Darah</th>
            <th>Wilayah</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($penduduk as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}&nbsp;</td>
            <td>{{$item->no_kk}}&nbsp;</td>
            <td>{{$item->full_name}}</td>
            <td>{{$item->tempat_lahir}}</td>
            <td>{{$item->tanggal_lahir}}</td>
            <td>{{$item->status_warganegara}}</td>
            <td>{{date_diff(date_create($item->tanggal_lahir), date_create('now'))->y}}</td>
            <td>{{$item->jekel}}</td>
            <td>{{$item->agama}}</td>
            <td>{{$item->pendidikan}}</td>
            <td>{{$item->pekerjaan}}</td>
            <td>{{$item->status_perkawinan}}</td>
            <td>{{$item->status_kependudukan}}</td>
            <td>{{$item->ktp_elektronik}}</td>
            <td>{{$item->golongan_darah}}</td>
            <td>Dusun {{$item->DUSUN}}
                RT {{$item->RT}}
                RW {{$item->RW}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>