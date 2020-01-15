<table>
    <thead>
        <tr role="row">
            <th>No.</th>
            <th>KIA</th>
            <th>No. KK</th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Penolong Kelahiran</th>
            <th>Kondisi Lahir</th>
            <th>Berat</th>
            <th>Panjang</th>
            <th>Jenis Kelahiran</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($kelahiran as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}&nbsp;</td>
            <td>{{$item->no_kk}}&nbsp;</td>
            <td>{{$item->full_name}}</td>
            <td>Dusun {{$item->DUSUN}}
                RT {{$item->RT}}
                RW {{$item->RW}}
            </td>
            <td>{{$item->tanggal_lahir}}</td>
            <td>{{$item->jekel}}</td>
            <td>{{$item->AYAH}}</td>
            <td>{{$item->IBU}}</td>
            <td>{{$item->hob}}</td>
            <td>{{$item->kondisi_lahir}}</td>
            <td>{{$item->berat}}</td>
            <td>{{$item->panjang}}</td>
            <td>{{$item->jenis_kelahiran}}</td>
        </tr>
        @endforeach
    </tbody>
</table>