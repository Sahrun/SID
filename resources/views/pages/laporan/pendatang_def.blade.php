<table>
    <thead>
        <tr role="row">
            <th>No.</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Wilayah</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Agama</th>
            <th>Pekerjaan</th>
            <th>Tanggal Datang</th>
            <th>Alasan Datang</th>
            <th>Alamat Sebelumnya</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($pendatang as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}&nbsp;</td>
            <td>{{$item->full_name}}</td>
            <td>{{$item->jekel}}</td>
            <td>Dusun {{$item->DUSUN}}
                RT {{$item->RT}}
                RW {{$item->RW}}
            </td>
            <td>{{$item->tempat_lahir}}, {{$item->tanggal_lahir}}</td>
            <td>{{$item->agama}}</td>
            <td>{{$item->pekerjaan}}</td>
            <td>{{$item->tgl_datang}}</td>
            <td>{{$item->alasan_datang}}</td>
            <td>{{$item->alamat_datang}}</td>
        </tr>
        @endforeach
    </tbody>
</table>