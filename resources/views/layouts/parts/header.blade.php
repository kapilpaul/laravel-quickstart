<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- page stylesheets -->
    <!-- end page stylesheets -->
    <!-- build:css({.tmp,app}) styles/app.min.css -->
    @stack('header_top_css')

    <link rel="stylesheet" href="{{ asset('assets/styles/webfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/climacons-font.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/card.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/sli.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/animate.css') }}">

    @stack('header_css')

    <link rel="stylesheet" href="{{ asset('assets/styles/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/app.skins.css') }}">

    @stack('header_bottom_css')
    <!-- endbuild -->

    @stack('header_js')
</head>

<body class="page-loading @yield('bodyClass')">
<!-- page loading spinner -->

<div class="pageload">
    <div class="pageload-inner">
        <div class="sk-rotating-plane"></div>
    </div>
</div>
<!-- /page loading spinner -->
