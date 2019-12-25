@extends('layouts.default')
    @section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Laporan Penduduk Pindah</h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Penduduk Pindah</h4>

                                <div class="form-group ml-auto">
                                    <label for="">Tanggal awal</label>
                                    <input type="date" name="tgl-awal" class="form-control">
                                </div>
                                <div class="form-group ml-auto">
                                    <label for="">Tanggal akhir</label>
                                    <input type="date" name="tgl-akhir" class="form-control">
                                </div>
                                <a class="btn btn-round ml-auto" id="filter-btn" href="javascript:void(0)">
                                    <i class="fas fa-file-excel"></i> Terapkan tanggal
                                </a>
                                <a class="btn btn-primary btn-round ml-auto" id="excel-btn" href="{{url('lap/excel-penduduk-pindah')}}" target="_blank">
                                    <i class="fas fa-file-excel"></i> Unduh sbg Excel
                                </a>
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
                                                        <th>No</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Pindah</th>
                                                        <th>Alasan Pindah</th>
                                                        <th>Alamat Pindah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no =1 ?>
                                                    @foreach ($pnd_pindah as $item)
                                                        <tr role="row" class="{{$no%2?'odd':'even'}}">
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

    <script>
    const url = "{{url('lap/penduduk-pindah/')}}"
    const pathUrl = window.location.pathname.split("/")
    const tglAwalUrl = pathUrl.length >= 5 ? [pathUrl.length - 1] : null
    const tglAkhirUrl = pathUrl.length >= 5 ? pathUrl[pathUrl.length - 1] : null

    $("#filter-btn").click(function(e) {
        e.preventDefault()

        const tglAwal = $("input[name=tgl-awal]").val()
        const tglAkhir = $("input[name=tgl-akhir]").val()

        if (tglAwal && tglAkhir) {
            window.location.assign(`${url}/${tglAwal}/${tglAkhir}`)
        }
    })

    $(document).ready(function() {
        if (tglAwalUrl !== null && tglAkhirUrl !== null) {
            $("input[name=tgl-awal]").val(tglAwalUrl)
            $("input[name=tgl-akhir]").val(tglAkhirUrl)

            const btnUrl = $("#excel-btn").attr("href")
            
        }
    })
    </script>

    @stop