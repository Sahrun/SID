@extends('layouts.default')
@section('content')
<div class="content">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard</h4>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-map-marked-alt"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">Jumlah Dusun</p>
                  <h4 class="card-title">{{$dusun[0]->jml_dusun}}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-map-marked-alt"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">Jumlah RW</p>
                  <h4 class="card-title">{{$rw[0]->jml_rw}}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-map-marked-alt"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">Jumlah RT</p>
                  <h4 class="card-title">{{$rt[0]->jml_rt}}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                    <i class="fas fa-user-friends"></i>
                  </div>
                </div>
                <div class="col col-stats ml-3 ml-sm-0">
                  <div class="numbers">
                    <p class="card-category">Jumlah Penduduk</p>
                    <h4 class="card-title">{{$penduduk[0]->jml_penduduk}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-warning bubble-shadow-small">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
                <div class="col col-stats ml-3 ml-sm-0">
                  <div class="numbers">
                    <p class="card-category">Jumlah Keluarga</p>
                    <h4 class="card-title">{{$keluarga}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">Statistik</div>
            </div>
          </div>
          <div class="card-body">
            <div id="pendudukdusun-container" style="width: 100%; height: 40vh;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-card-no-pd">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div id="jekel-container" style="width: 100%; height: 40vh;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div id="agama-container" style="width: 100%; height: 40vh;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('app-asset/js/plugin/highcharts.js')}}"></script>

<script>
  $(document).ready(function() {
    //region Grafik Penduduk per Dusun
    const chartPendudukDusun = Highcharts.chart('pendudukdusun-container', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Grafik Penduduk per Dusun'
      },
      xAxis: {
        categories: [
          @foreach($penduduk_dusun as $item)
          '{{$item->DUSUN}}',
          @endforeach
        ],
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Jiwa'
        }
      },
      tooltip: {
        pointFormat: '<b>{point.key}</b>{point.y} jiwa',
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [{
        name: 'Jumlah Penduduk',
        data: [
          @foreach($penduduk_dusun as $item)
          {{$item->jml_penduduk}},
          @endforeach
        ]
      }]
    })
    //endregion Grafik Penduduk per Dusun

    //region Grafik Jenis Kelamin
    const chartJekel = Highcharts.chart('jekel-container', {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
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
            enabled: false
          },
          showInLegend: true
        }
      },
      series: [{
        name: 'Jumlah',
        colorByPoint: true,
        data: [
          @foreach($jen_kel as $item) {
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
            enabled: false
          },
          showInLegend: true
        }
      },
      series: [{
        name: 'Jumlah',
        colorByPoint: true,
        data: [
          @foreach($agama as $item) {
            name: '{{$item->agama}}',
            y: {{$item->jumlah}}
          },
          @endforeach
        ]
      }]
    })
    //endregion Grafik Agama
  })
</script>
@stop