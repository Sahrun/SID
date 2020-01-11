@extends('layouts.default')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Statistik Kependudukan</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Statistik <span id="judul"></span></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <div class="nav flex-column nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-jekel-tab" data-toggle="pill" href="#v-pills-jekel" role="tab" aria-controls="v-pills-jekel" aria-selected="true">Jenis Kelamin</a>
                                    <a class="nav-link" id="v-pills-agama-tab" data-toggle="pill" href="#v-pills-agama" role="tab" aria-controls="v-pills-agama" aria-selected="false">Agama</a>
                                    <a class="nav-link" id="v-pills-pendidikan-tab" data-toggle="pill" href="#v-pills-pendidikan" role="tab" aria-controls="v-pills-pendidikan" aria-selected="false">Pendidikan</a>
                                    <a class="nav-link" id="v-pills-pekerjaan-tab" data-toggle="pill" href="#v-pills-pekerjaan" role="tab" aria-controls="v-pills-pekerjaan" aria-selected="false">Pekerjaan</a>
                                    <a class="nav-link" id="v-pills-status-tab" data-toggle="pill" href="#v-pills-status" role="tab" aria-controls="v-pills-status" aria-selected="false">Status Kependudukan</a>
                                    <a class="nav-link" id="v-pills-usia-tab" data-toggle="pill" href="#v-pills-usia" role="tab" aria-controls="v-pills-usia" aria-selected="false">Usia</a>
                                </div>
                            </div>
                            <div class="col-7 col-md-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-jekel" role="tabpanel" aria-labelledby="v-pills-jekel-tab">
                                        <div id="jekel-container" style="width: 100%; height: 60vh;"></div>
                                        <table class="table table-sm" style="width: auto">
                                            <tbody>
                                                @foreach ($jen_kel as $item)
                                                <tr>
                                                    <td>{{$item->jekel}}</td> 
                                                    <td>{{$item->jumlah}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-agama" role="tabpanel" aria-labelledby="v-pills-agama-tab">
                                        <div id="agama-container" style="width: 100%; height: 60vh;"></div>
                                        <table class="table table-sm" style="width: auto">
                                            <tbody>
                                                @foreach ($agama as $item)
                                                <tr>
                                                    <td>{{$item->agama}}</td> 
                                                    <td>{{$item->jumlah}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-pendidikan" role="tabpanel" aria-labelledby="v-pills-pendidikan-tab">
                                        <div id="pendidikan-container" style="width: 100%; height: 60vh;"></div>
                                        <table class="table table-sm" style="width: auto">
                                            <tbody>
                                                @foreach ($pendidikan as $item)
                                                <tr>
                                                    <td>{{$item->pendidikan}}</td> 
                                                    <td>{{$item->jumlah}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-pekerjaan" role="tabpanel" aria-labelledby="v-pills-pekerjaan-tab">
                                        <div id="pekerjaan-container" style="width: 100%; height: 60vh;"></div>
                                        <table class="table table-sm" style="width: auto">
                                            <tbody>
                                                @foreach ($pekerjaan as $item)
                                                <tr>
                                                    <td>{{$item->pekerjaan}}</td> 
                                                    <td>{{$item->jumlah}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-status" role="tabpanel" aria-labelledby="v-pills-status-tab">
                                        <div id="status-container" style="width: 100%; height: 60vh;"></div>
                                        <table class="table table-sm" style="width: auto">
                                            <tbody>
                                                @foreach ($status_kependudukan as $item)
                                                <tr>
                                                    <td>{{$item->status_kependudukan}}</td> 
                                                    <td>{{$item->jumlah}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-usia" role="tabpanel" aria-labelledby="v-pills-usia-tab">
                                        <div id="usia-container" style="width: 100%; height: 60vh;"></div>
                                        <table class="table table-sm" style="width: auto">
                                            <tbody>
                                                @foreach ($umur as $item)
                                                <tr>
                                                    <td>{{$item->umur}}</td> 
                                                    <td>{{$item->jumlah}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

<script src="{{asset('app-asset/js/plugin/highcharts.js')}}"></script>
<script src="{{asset('app-asset/js/plugin/exporting.js')}}"></script>

<script>
    $(document).ready(function() {
        //region Grafik Jenis Kelamin
        const chartJekel = Highcharts.chart('jekel-container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            exporting: {
                enabled: true
            },
            title: {
                text: 'Grafik Penduduk Berdasarkan Jenis Kelamin'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [
                    @foreach ($jen_kel as $item)
                        {
                            name: '{{$item->jekel}}',
                            y: {{$item->jumlah}}
                        },
                    @endforeach
                ]
            }]
        })
        //endregion Grafik Jenis Kelamin

        //region Grafik Agama
        const chartAgama = Highcharts.chart('agama-container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            exporting: {
                enabled: true
            },
            title: {
                text: 'Grafik Penduduk Berdasarkan Agama'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [
                    @foreach ($agama as $item)
                        {
                            name: '{{$item->agama}}',
                            y: {{$item->jumlah}}
                        },
                    @endforeach
                ]
            }]
        })
        //endregion Grafik Agama

        //region Grafik Pendidikan
        const chartPendidikan = Highcharts.chart('pendidikan-container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            exporting: {
                enabled: true
            },
            title: {
                text: 'Grafik Penduduk Berdasarkan Pendidikan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [
                    @foreach ($pendidikan as $item)
                        {
                            name: '{{$item->pendidikan}}',
                            y: {{$item->jumlah}}
                        },
                    @endforeach
                ]
            }]
        })
        //endregion Grafik Pendidikan

        //region Grafik Pekerjaan
        const chartPekerjaan = Highcharts.chart('pekerjaan-container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            exporting: {
                enabled: true
            },
            title: {
                text: 'Grafik Penduduk Berdasarkan Pekerjaan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [
                    @foreach ($pekerjaan as $item)
                        {
                            name: '{{$item->pekerjaan}}',
                            y: {{$item->jumlah}}
                        },
                    @endforeach
                ]
            }]
        })
        //endregion Grafik Pekerjaan

        //region Grafik Status Kependudukan
        const chartStatus = Highcharts.chart('status-container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            exporting: {
                enabled: true
            },
            title: {
                text: 'Grafik Penduduk Berdasarkan Status Kependudukan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [
                    @foreach ($status_kependudukan as $item)
                        {
                            name: '{{$item->status_kependudukan}}',
                            y: {{$item->jumlah}}
                        },
                    @endforeach
                ]
            }]
        })
        //endregion Grafik Status Kependudukan

        //region Grafik Usia
        const chartUsia = Highcharts.chart('usia-container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            exporting: {
                enabled: true
            },
            title: {
                text: 'Grafik Penduduk Berdasarkan Usia'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [
                    @foreach ($umur as $item)
                        {
                            name: '{{$item->umur}}',
                            y: {{$item->jumlah}}
                        },
                    @endforeach
                ]
            }]
        })
        //endregion Grafik Usia
        
        const judul = ['Jenis Kelamin', 'Agama', 'Pendidikan', 'Pekerjaan', 'Status Kependudukan', 'Usia'] 

        $('#judul').text(judul[$('a[data-toggle=pill].active').index()])

        $('a[data-toggle=pill]').on('shown.bs.tab', function(){
            $('#judul').text(judul[$(this).index()])
        })
    })
</script>

@stop