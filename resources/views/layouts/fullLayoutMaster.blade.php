@php
    $logo = App\Models\Logo::first();
@endphp
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') | Restrourant</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">
   @if (!$logo == null)
        <link rel="shortcut icon" href="{{ asset('images/logo/'.$logo->favicon_icon) }}" />
   @else
        <link rel="shortcut icon" href="{{ asset('images/favicon1.png') }}" />
   @endif
    <link rel="stylesheet" href="../css/libs.min.css">
    <link rel="stylesheet" href="../css/aprycot.css">
    <link rel="stylesheet" href="../vendor/Leaflet/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
<script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>
        <style>
            body{
                -webkit-user-select: none; /* Safari */
                -ms-user-select: none; /* IE 10 and IE 11 */
                user-select: none; /* Standard syntax */
            }
        </style>
    {{-- Include core + vendor Styles --}}
    @include('panels/styles')
</head>

<body class="vertical-layout vertical-menu-modern blank-page" data-menu="vertical-menu-modern" data-col="blank-page"
    data-framework="laravel" data-asset-path="{{ asset('/') }}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                {{-- Include Startkit Content --}}
                @yield('content')
            </div>
        </div>
    </div>
    <!-- End: Content-->
    {{-- include default scripts --}}
    @include('panels/scripts')
</body>

</html>
