@php
    // admin..
    $logo = App\Models\Logo::first();
    if(Auth::check()){
    // restaurant...
        $restaurant = App\Models\Restaurant::where('user_id',auth()->user()->id)->first();
    if (!$restaurant == null) {
        $id = $restaurant->id;
        $restuarant_logo = App\Models\Attachment::where([['attachable_id',$id],['field_name','restaurant_logo']])->first();
        $image = App\Models\Attachment::where([['attachable_id',$id],['field_name','restaurant_image']])->first();
    }
    }else{
        $restuarant_logo=null;
        $image=null;
    }
   
 
@endphp
<!DOCTYPE html><html class="loading light">

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
    <title>@yield('title') | Restaurant</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">
    <script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>
        {{-- favicon icon for all type of users  --}}
        @if (!$logo == null)
                <link rel="shortcut icon" href="{{ asset('images/logo/'.$logo->favicon_icon) }}" />
        @else
                <link rel="shortcut icon" href="{{ asset('images/favicon1.png') }}" />
        @endif


    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        body {
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            /* Standard syntax */
        }

        .error {
            color: #EA1212;
            background-color: #FFF;
        }
    </style>
    {{-- Include core + vendor Styles --}}
    @include('panels/styles')
    <script>
        var config = {
                    data: {
                        csrf:"{{csrf_token()}}",
                        base_url:"{{  url('') }}"
                    }
                };
    </script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
@extends('layouts.verticalLayoutMaster')
