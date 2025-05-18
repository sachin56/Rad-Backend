<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Paw Log | Veterinarian | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url(env('ASSETS_PATH').'/images/favicon.ico')}}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{url(env('ASSETS_PATH').'/css/preloader.min.css')}}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{url(env('ASSETS_PATH').'/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url(env('ASSETS_PATH').'/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="{{url(env('ASSETS_PATH').'/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- sweet alert Css-->
    <link href="{{url(env('ASSETS_PATH').'/libs/sweetalert2/sweetalert2.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('assets/libs/daterangepicker/daterangepicker.css') }}">
    <style>
        .select2-selection {
            height: 38px !important;
        }
    </style>
    @yield('styles')
</head>
