<table>
    <thead>
        <tr role="row">
            <th>No.</th>
            <th>NIK</th>
            <th>No. KK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Wilayah</th>
            <th>Tanggal Pindah</th>
            <th>Alasan Pindah</th>
            <th>Alamat Pindah</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($pnd_pindah as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->no_kk}}</td>
            <td>{{$item->full_name}}</td>
            <td>{{$item->jekel}}</td>
            <td>Dusun {{$item->DUSUN}}
                RT {{$item->RT}}
                RW {{$item->RW}}
            </td>
            <td>{{$item->tgl_pindah}}</td>
            <td>{{$item->alasan_pindah}}</td>
            <td>{{$item->alamat_pindah}}</td>
        </tr>
        @endforeach
    </tbody>
</table>