@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">You are logged in!</h1>

        <div class="card">
            <div class="card-header">Line Chart test
            <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org" target="_blank"><small class="text-muted">docs</small></a></div>
            </div>
            <div class="card-body">
            <div class="c-chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="canvas-1" style="display: block;" width="718" height="359" class="chartjs-render-monitor"></canvas>
            </div>
            </div>
            </div>

    </div>
@endsection
 