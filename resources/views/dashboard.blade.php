@extends('layouts.app-v2')

@section('title','Dashboard')

@section('content')
@if (session('success'))
<div id="success-message" data-message="{{ session('success') }}"></div>
@endif
@if (session('error'))
<div id="error-message" data-message="{{ session('error') }}"></div>
@endif
<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <h5>Selamat Datang, {{Auth::user()->name}}</h5>
    </div>
</div>
<!-- <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script> -->
@endsection