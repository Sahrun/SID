<table>
    <thead>
        <tr role="row">
            <th>No.</th>
            <th>NIK</th>
            <th>No. KK</th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>Tanggal Kematian</th>
            <th>Jam Kematian</th>
            <th>Sebab Kematian</th>
            <th>Tempat Kematian</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($kematian as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}&nbsp;</td>
            <td>{{$item->no_kk}}&nbsp;</td>
            <td>{{$item->full_name}}</td>
            <td>Dusun {{$item->DUSUN}}
                RT {{$item->RT}}
                RW {{$item->RW}}
            </td>
            <td>{{$item->tgl_kematian}}</td>
            <td>{{$item->jam_kematian}}</td>
            <td>{{$item->sebab_kematian}}</td>
            <td>{{$item->tempat_kematian}}</td>
        </tr>
        @endforeach
    </tbody>
</table>