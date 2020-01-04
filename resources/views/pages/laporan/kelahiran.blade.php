@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Kelahiran</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Kelahiran</h4>

                                <div class="ml-auto">
                                    <label for="">Tanggal awal</label>
                                    <input type="date" name="tgl-awal">
                                    <label for="">Tanggal akhir</label>
                                    <input type="date" name="tgl-akhir">
                                    <button id="filter-btn">Filter</button>
                                    <a class="btn btn-success btn-round" id="excel-btn" href="{{url('lap/excel-kelahiran')}}" target="_blank">
                                        <i class="fas fa-download"></i> Unduh sbg Excel
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
                                                <label>Show
                                                    <select name="add-row_length" aria-controls="add-row" class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> entries</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="add-row_filter" class="dataTables_filter">
                                                <label>Search:
                                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="add-row">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
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
                                                    <?php $no =1 ?>
                                                    @foreach ($kelahiran as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->nik}}</td>
                                                            <td>{{$item->no_kk}}</td>
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled" id="add-row_previous"><a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                    <li class="paginate_button page-item active"><a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                    <li class="paginate_button page-item "><a href="#" aria-controls="add-row" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                    <li class="paginate_button page-item next" id="add-row_next"><a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                                                </ul>
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
    </div>

    <style>
        .pulse-button {
            box-shadow: 0 0 0 0 rgba(61, 90, 232, 0.7);
            animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        }

        @keyframes pulse {to {box-shadow: 0 0 0 10px rgba(61, 90, 232, 0);}}
    </style>

    <script>
    const url = "{{url('lap/kelahiran/')}}"
    const tglAwalUrl = "{{Request::segment(3)}}"
    const tglAkhirUrl = "{{Request::segment(4)}}"

    $("#filter-btn").click(function(e) {
        e.preventDefault()

        const tglAwal = $("input[name=tgl-awal]").val()
        const tglAkhir = $("input[name=tgl-akhir]").val()

        if (tglAwal && tglAkhir) {
            window.location.assign(`${url}/${tglAwal}/${tglAkhir}`)
        }else
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