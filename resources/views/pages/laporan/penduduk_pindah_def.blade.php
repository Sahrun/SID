<table>
    <thead>
        <tr role="row">
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Tanggal Pindah</th>
            <th>Alasan Pindah</th>
            <th>Alamat Pindah</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($pnd_pindah as $item)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->full_name}}</td>
            <td>{{$item->tgl_pindah}}</td>
            <td>{{$item->alasan_pindah}}</td>
            <td>{{$item->alamat_pindah}}</td>
        </tr>
        @endforeach
    </tbody>
</table>