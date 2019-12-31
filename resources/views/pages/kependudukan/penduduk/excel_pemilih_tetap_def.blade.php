<table>
    <thead>
        <tr role="row">
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Usia</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach ($pemilihtetap as $item)
        <tr role="row">
            <td>{{$no++}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->full_name}}</td>
            <td>{{$item->usia}}</td>
        </tr>
        @endforeach
    </tbody>
</table>