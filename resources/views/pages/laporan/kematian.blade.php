@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Kematian</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Kematian</h4>

                                <div class="ml-auto">
                                    <label for="">Tanggal awal</label>
                                    <input type="date" name="tgl-awal">
                                    <label for="">Tanggal akhir</label>
                                    <input type="date" name="tgl-akhir">
                                    <button id="filter-btn">Filter</button>
                                    <a class="btn btn-success btn-round" id="excel-btn" href="{{url('lap/excel-kematian')}}" target="_blank">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="add-row_length">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="add-row_filter" class="dataTables_filter">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
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
                                                    <?php $no =1 ?>
                                                    @foreach ($kematian as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->nik}}</td>
                                                            <td>{{$item->no_kk}}</td>
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-7">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .pulse-button {
            box-shadow: 0 0 0 0 rgba(61, 90, 232, 0.7);
            animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        }

        @keyframes pulse {to {box-shadow: 0 0 0 10px rgba(61, 90, 232, 0);}}
    </style>

    <script>
    const url = "{{url('lap/lap-kematian/')}}"
    const tglAwalUrl = "{{Request::segment(3)}}"
    const tglAkhirUrl = "{{Request::segment(4)}}"

    $("#filter-btn").click(function(e) {
        e.preventDefault()

        const tglAwal = $("input[name=tgl-awal]").val()
        const tglAkhir = $("input[name=tgl-akhir]").val()

        if (tglAwal && tglAkhir) {
            window.location.assign(`${url}/${tglAwal}/${tglAkhir}`)
        }
        else
        {
            window.location.assign(`${url}`)
        }
    })

    $("input[name=tgl-awal], input[name=tgl-akhir]").change(function() {
        if ($("input[name=tgl-awal]").val() !== "" && $("input[name=tgl-akhir]").val() !== "") {
            $("#filter-btn").addClass("pulse-button")
        }
    })

    $(document).ready(function() {
        if (tglAwalUrl !== "" && tglAkhirUrl !== "") {
            $("input[name=tgl-awal]").val(tglAwalUrl)
            $("input[name=tgl-akhir]").val(tglAkhirUrl)

            const btnUrl = $("#excel-btn").attr("href") + "/" + tglAwalUrl + "/" + tglAkhirUrl
            $("#excel-btn").attr("href", btnUrl)
        }
    })
    </script>

    @stop