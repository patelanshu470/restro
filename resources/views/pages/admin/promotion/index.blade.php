@extends('layouts/contentLayoutMaster')
@section('title', 'Setting')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .category-button:hover {
            background-color: #FAC281;
            transition: 0.7s;
            color: #fff;
        }

        .active {
            color: #fff;
        }

        .divider {
            width: 2px;
            height: 200px;
            color: #959895;
            margin: auto;
            border-right: 1px solid grey;
        }

        .avatar-100 {
            height: 250px;
            width: 400px;
            min-width: 400px;
            -o-object-fit: cover;
            /* margin-left: 50px; */
            object-fit: cover;
            border-radius: 0.25rem;
        }

        .upload-icone {
            position: absolute;
            top: auto;
            left: 85%;
            bottom: 10%;

            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 50%;
            height: 2.188rem;
            width: 2.188rem;
            text-align: center;
            font-size: 12px;
            line-height: 24px;
            cursor: pointer;
            border: 5px solid #fff;
        }

        .upload-icone2 {
            position: absolute;
            top: auto;
            left: 59%;
            bottom: -7%;

            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 50%;
            height: 2.188rem;
            width: 2.188rem;
            text-align: center;
            font-size: 12px;
            line-height: 24px;
            cursor: pointer;
            border: 5px solid #fff;
        }

        .upload-icone3 {
            position: absolute;
            top: auto;
            left: 81%;
            bottom: -6%;

            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 50%;
            height: 2.188rem;
            width: 2.188rem;
            text-align: center;
            font-size: 12px;
            line-height: 24px;
            cursor: pointer;
            border: 5px solid #fff;
        }

        #logo-error {
            margin-bottom: 4px;
            position: relative;
            top: 20px;
            right: 170px;
            background: transparent;
            /* left: 0; */
            font-size: 0.8rem;
            width: 370px;
        }

        #favicon-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        .nav-tabs .nav-link.active {
            border-bottom: none;
        }

        .select2-container--default .select2-selection--single {
            height: 45px;
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.75;
            color: #959895;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #E3E1E1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 1.25rem;
            box-shadow: 0 0 0 0;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #959895;
        }

        .select2-selection__arrow {
            display: none;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #ea6a12;
            color: white;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')


    <div class="content-inner mt-5 py-0">
        <div>
            <div class="row" style="justify-content: center">
                <div class="col-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Large Banner</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                @if ($promotion_large)
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('banner.store') }}"
                                        id="large_banner_form">
                                        @csrf

                                        <div class="row" style="">
                                            <div class="form-group col-md-5 text-center">
                                                <div class="profile-img-edit position-relative">
                                                    <img class="profile-pic rounded avatar-100"
                                                        src="{{ $promotion_large->img ? URL::asset('images/promotion/' . $promotion_large->img) : asset('no-image.jpg') }}"
                                                        alt="profile-pic" style="object-fit: contain">

                                                    <div class="upload-icone bg-primary">
                                                        <i class="fa-solid fa-pen" style="color:white;"></i>
                                                        <input class="file-upload-test form-control "
                                                            style="position:relative; bottom:30px; right:5px;opacity:0"
                                                            accept=".jpg,.jpeg,.png" name="img"
                                                            value="{{ $promotion_large->img }}" id=""
                                                            type="file">
                                                    </div>
                                                </div>
                                                <div class="img-extension mt-">
                                                    <div class="d-inline-block align-items-center">
                                                        <span>Large Banner</span><br>
                                                        <span><small>Recommended size 2198x780px </small></span><br>
                                                        <span id="img_error" style="color: red"></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="divider">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_key">Large Description:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion_large->description }}" name="description"
                                                    id="" placeholder="large description" required>

                                                <label class="form-label mt-3" for="site_key">Redirect Link:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion_large->link }}" name="link" id=""
                                                    placeholder="redirect link">
                                                <input type="hidden" class="form-control" value="large_banner"
                                                    name="type" id="" placeholder="" required>
                                                <input type="hidden" class="form-control"
                                                    value="{{ $promotion_large->id }}" name="large_banner_id" id=""
                                                    placeholder="" required>

                                                <div class="form-group mt-5 text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('banner.store') }}"
                                        id="large_banner_form">
                                        @csrf

                                        <div class="row" style="">


                                            <div class="form-group col-md-5 text-center">
                                                <div class="profile-img-edit position-relative">
                                                    <img class="profile-pic rounded avatar-100"
                                                        src="{{ asset('no-image.jpg') }}" alt="profile-pic">

                                                    <div class="upload-icone bg-primary">
                                                        <i class="fa-solid fa-pen" style="color:white;"></i>
                                                        <input class="file-upload-test form-control "
                                                            style="position:relative; bottom:30px; right:5px;opacity:0"
                                                            accept=".jpg,.jpeg,.png" name="img" id="product_thumnail"
                                                            type="file">
                                                    </div>
                                                </div>
                                                <div class="img-extension mt-">
                                                    <div class="d-inline-block align-items-center">
                                                        <span>Large Banner</span><br>
                                                        <span><small>Recommended size 860x720px </small></span><br>
                                                        <span id="img_error" style="color: red">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 ">
                                                <div class="divider"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_key">Large
                                                    Description:</label>
                                                <input type="text" class="form-control" value=""
                                                    name="description" id="" placeholder="Large description"
                                                    required>

                                                <label class="form-label" for="site_key"
                                                    style="padding-top: 10px">Redirect Link:</label>
                                                <input type="text" class="form-control" value="" name="link"
                                                    id="" placeholder="redirect link">
                                                <input type="hidden" class="form-control" value="large_banner"
                                                    name="type" id="" placeholder="small description"
                                                    required>
                                                <div class="form-group col-md-12 text-center mt-5">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Small Banner</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">

                                @if ($promotion_small)
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('banner.store') }}" id="small_banner_form">
                                        @csrf

                                        <div class="row" style="">
                                            <div class="form-group col-md-5 text-center">
                                                <div class="profile-img-edit position-relative">
                                                    <img class="profile-cover rounded avatar-100"
                                                        src="{{ $promotion_small->img ? URL::asset('images/promotion/' . $promotion_small->img) : asset('no-image.jpg') }}"
                                                        alt="profile-pic" style="object-fit: contain">

                                                    <div class="upload-icone3 bg-primary">
                                                        <i class="fa-solid fa-pen" style="color:white;"></i>
                                                        <input class="file-upload-cover form-control "
                                                            style="position:relative; bottom:30px; right:5px;opacity:0"
                                                            accept=".jpg,.jpeg,.png" name="small_img"
                                                            value="{{ $promotion_small->img }}" id=""
                                                            type="file">
                                                    </div>
                                                </div>
                                                <div class="img-extension mt-">
                                                    <div class="d-inline-block align-items-center">
                                                        <span>Small Banner</span><br>
                                                        <span><small>Recommended size 400x340px </small></span><br>
                                                        <span id="img_error_small" style="color: red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="divider" style="height: 250px;">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_key">Name:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion_small->name }}" name="name" id=""
                                                    placeholder="custom name of product">
                                                <input type="hidden" class="form-control"
                                                    value="{{ $promotion_small->id }}" name="small_banner_id"
                                                    id="" placeholder="" required>

                                                <label class="form-label mt-3" for="site_key">Offer:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion_small->offer }}" name="offer" id=""
                                                    placeholder="eg 50% off">
                                                <input type="hidden" class="form-control" value="small_banner"
                                                    name="type" id="" placeholder="small description">

                                                <div class="form-group mt-3">
                                                    <label for="Restauarant" class="form-label">Product</label>
                                                    @php
                                                        $product = \App\Models\Product::all();
                                                    @endphp
                                                    <select name="product_id" id="product_id"
                                                        class="selectpicker form-control select2">
                                                        <option value="">Select Product</option>
                                                        @foreach ($product as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $promotion_small->product_id ? 'Selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-5 text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('banner.store') }}" id="small_banner_form">
                                        @csrf

                                        <div class="row" style="">
                                            <div class="form-group col-md-5 text-center">
                                                <div class="profile-img-edit position-relative">
                                                    <img class="profile-cover rounded avatar-100"
                                                        src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                                    <div class="upload-icone3 bg-primary">
                                                        <i class="fa-solid fa-pen" style="color:white;"></i>
                                                        <input class="file-upload-cover form-control "
                                                            style="position:relative; bottom:30px; right:5px;opacity:0"
                                                            accept=".jpg,.jpeg,.png" name="small_img" type="file">
                                                    </div>
                                                </div>
                                                <div class="img-extension mt-">
                                                    <div class="d-inline-block align-items-center">
                                                        <span>Small Banner</span><br>
                                                        <span><a href="javascript:void();">.jpg .png
                                                                .jpeg</a></span><br>
                                                        <span id="img_error_small" style="color: red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="divider" style="height: 250px;">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_key">Name:</label>
                                                <input type="text" class="form-control" value="" name="name"
                                                    id="" placeholder="custom name of product to show">

                                                <label class="form-label mt-3" for="site_key">Offer:</label>
                                                <input type="text" class="form-control" value="" name="offer"
                                                    id="" placeholder="eg 50% off">

                                                <div class="form-group mt-3">
                                                    <label for="Restauarant" class="form-label">Product</label>
                                                    @php
                                                        $product = \App\Models\Product::all();
                                                    @endphp
                                                    <select name="product_id" id="product_id"
                                                        class="selectpicker form-control select2">
                                                        <option value="">Select Product</option>
                                                        @foreach ($product as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                        </option>
                                                    </select>
                                                </div>
                                                <input type="hidden" class="form-control" value="small_banner"
                                                    name="type" id="" placeholder="small description"
                                                    required>
                                                <div class="form-group col-md-12 text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Tab Gif Banner -->
                <div class="col-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Gif Banner</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">

                                @if ($promotion_gif)
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('bannergif.store') }}" id="gif_banner_form">
                                        @csrf
                                        <div class="row" style="">
                                            <div class="form-group col-md-5 text-center">
                                                <div class="profile-img-edit position-relative">
                                                    <img class="logo_image rounded avatar-100"
                                                        src="{{ $promotion_gif->img ? URL::asset('images/promotion/' . $promotion_gif->img) : asset('no-image.jpg') }}"
                                                        alt="profile-pic" style="object-fit: contain">

                                                    <div class="upload-icone2 bg-primary">
                                                        <i class="fa-solid fa-pen" style="color:white;"></i>
                                                        <input class="file-upload-logos form-control "
                                                            style="position:relative; bottom:30px; right:5px;opacity:0"
                                                            accept=".jpg,.jpeg,.png" name="gif_img"
                                                            value="{{ $promotion_gif->img }}" id=""
                                                            type="file">
                                                    </div>
                                                </div>
                                                <div class="img-extension mt-">
                                                    <div class="d-inline-block align-items-center">
                                                        <span>GIF Banner</span><br>
                                                        <span><small>Recommended size 420x590px </small></span><br>

                                                        <span id="img_error_gif" style="color: red"></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="divider">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="url">URL:</label>
                                                <input type="url" class="form-control"
                                                    value="{{ $promotion_gif->link }}" name="url" id=""
                                                    placeholder="Redirect URL">

                                                <input type="hidden" class="form-control" value="gif_banner"
                                                    name="type" id="" placeholder="">
                                                <input type="hidden" class="form-control"
                                                    value="{{ $promotion_gif->id }}" name="gif_banner_id"
                                                    placeholder="">
                                                <div class="form-group text-center mt-5">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            </form>
                        @else
                            <form method="POST" enctype="multipart/form-data" action="{{ route('bannergif.store') }}"
                                id="gif_banner_form">
                                @csrf
                                <div class="row" style="">
                                    <div class="form-group col-md-5 text-center">
                                        <div class="profile-img-edit position-relative">
                                            <img class="logo_image rounded avatar-100" src="{{ asset('no-image.jpg') }}"
                                                alt="profile-pic">

                                            <div class="upload-icone2 bg-primary">
                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                <input class="file-upload-logos form-control "
                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                    accept=".jpg,.jpeg,.png" name="gif_img" type="file">
                                            </div>
                                        </div>
                                        <div class="img-extension mt-2">
                                            <div class="d-inline-block align-items-center">
                                                <span>GIF Banner</span><br>
                                                <span><a href="javascript:void();">.jpg .png
                                                        .jpeg</a></span><br>
                                                <span id="img_error_gif" style="color: red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="divider">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="url">URL:</label>
                                        <input type="url" class="form-control" value="" name="url"
                                            id="" placeholder="Redirect URL">
                                        <input type="hidden" class="form-control" value="gif_banner" name="type"
                                            id="" placeholder="" required>
                                        <div class="form-group mt-3 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End Tab Gif Banner -->

                {{-- Bg_banner  --}}
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">BG-Banner</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">

                                @if ($bg_banner)
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('banner.store') }}" id="small_banner_form">
                                        @csrf

                                        <div class="row" style="">
                                        
                                            <div class="row" style="display: grid;justify-content: center;">
                                                <div class="form-group col-md-12 text-center">
                                                    <div class="profile-img-edit position-relative">
                                                        <img class="bg_banner rounded avatar-100"
                                                            src="{{ $bg_banner->img ? URL::asset('images/promotion/' . $bg_banner->img) : asset('no-image.jpg') }}" alt="profile-pic">
                                                        <div class="upload-icone3 bg-primary">
                                                            <i class="fa-solid fa-pen" style="color:white;"></i>
                                                            <input class="bg_banner_cover form-control "
                                                                style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                accept=".jpg,.jpeg,.png" value="{{ $bg_banner->img }}"  name="bg_banner" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="img-extension mt-">
                                                        <div class="d-inline-block align-items-center">
                                                            <span>GIF Banner</span><br>
                                                            <span><small>Recommended size 640x300px</small></span><br><br>
                                                            <span id="img_error_small" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                      
                                            <input type="hidden" class="form-control" value="bg_banner"
                                                name="type" id="" placeholder="small description">

                                            <input type="hidden" class="form-control"
                                                value="{{ $bg_banner->id }}" name="bg_banner_id" id=""
                                                placeholder="" required>

                                            <div class="form-group mt-5 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('banner.store') }}" id="small_banner_form">
                                        @csrf

                                        <div class="row" style="display: grid;justify-content: center;">
                                            <div class="form-group col-md-12 text-center">
                                                <div class="profile-img-edit position-relative">
                                                    <img class="bg_banner rounded avatar-100"
                                                        src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                                    <div class="upload-icone3 bg-primary">
                                                        <i class="fa-solid fa-pen" style="color:white;"></i>
                                                        <input class="bg_banner_cover form-control "
                                                            style="position:relative; bottom:30px; right:5px;opacity:0"
                                                            accept=".jpg,.jpeg,.png" name="small_img" type="file">
                                                    </div>
                                                </div>
                                                <div class="img-extension mt-">
                                                    <div class="d-inline-block align-items-center">
                                                        <span>BG-Banner</span><br>
                                                        <span><a href="javascript:void();">.jpg .png
                                                                .jpeg</a></span><br>
                                                        <span id="img_error_small" style="color: red"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-control" value="bg_banner" name="type"
                                                id="" placeholder="" required>
                                            <div class="form-group col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- end  --}}
            </div>
        </div>
    </div>
    </div>


@endsection

@section('page-script')



    {{-- large_banner_edit validation  --}}
    @if ($promotion_large or $promotion_small)
        <script>
            $("#large_banner_form").validate({
                rules: {

                    description: {
                        required: true,
                    },
                    link: {
                        required: true,
                        url: true
                    },
                    name: {
                        required: true,
                    },
                    offer: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                },
                messages: {

                    description: {
                        required: "This  field is required",
                    },
                    name: {
                        required: "This  field is required",
                    },
                    offer: {
                        required: "This  field is required",
                    },
                    product_id: {
                        required: "This  field is required",
                    },
                    link: {
                        required: "This  field is required",
                        url: "Please enter a valid URL"
                    },
                },


            });
        </script>
    @else
        {{-- attention:  --}}
        <script>
            $("#large_banner_form").validate({
                rules: {
                    img: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    link: {
                        required: true,
                        url: true
                    },
                    name: {
                        required: true,
                    },
                    offer: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                },
                messages: {
                    img: {
                        required: "This  field is required",
                    },
                    description: {
                        required: "This  field is required",
                    },
                    link: {
                        required: "This  field is required",
                        url: "Please enter a valid URL"
                    },
                    name: {
                        required: "This  field is required",
                    },
                    offer: {
                        required: "This  field is required",
                    },
                    product_id: {
                        required: "This  field is required",
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "img") {
                        error.appendTo("#img_error");
                    } else {
                        error.insertAfter(element);
                    }
                }

            });
        </script>
    @endif

    {{-- small_banner_edit validation  --}}
    @if ($promotion_small)
        <script>
            $("#small_banner_form").validate({
                rules: {

                    name: {
                        required: true,
                    },
                    offer: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                },
                messages: {

                    name: {
                        required: "This  field is required",
                    },
                    offer: {
                        required: "This  field is required",
                    },
                    product_id: {
                        required: "This  field is required",
                    },

                },


            });
        </script>
    @else
        <script>
            $("#small_banner_form").validate({
                rules: {
                    small_img: {
                        required: true,
                    },

                    name: {
                        required: true,
                    },
                    offer: {
                        required: true,
                    },
                    product_id: {
                        required: true,
                    },
                },
                messages: {
                    small_img: {
                        required: "This  field is required",
                    },

                    name: {
                        required: "This  field is required",
                    },
                    offer: {
                        required: "This  field is required",
                    },
                    product_id: {
                        required: "This  field is required",
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "small_img") {
                        error.appendTo("#img_error_small");
                    } else {
                        error.insertAfter(element);
                    }
                }

            });
        </script>
    @endif

    @if ($promotion_gif)
        <script>
            $("#gif_banner_form").validate({
                rules: {
                    url: {
                        required: true,
                    },
                },
                messages: {
                    url: {
                        required: "This  field is required",
                    },
                },

            });
        </script>
    @else
        <script>
            $("#gif_banner_form").validate({
                rules: {
                    gif_img: {
                        required: true,
                    },
                    url: {
                        required: true,
                    },
                },
                messages: {
                    gif_img: {
                        required: "This  field is required",
                    },
                    url: {
                        required: "This  field is required",
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "gif_img") {
                        error.appendTo("#img_error_gif");
                    } else {
                        error.insertAfter(element);
                    }
                }

            });
        </script>
    @endif


    <script>
        var _URL = window.URL || window.webkitURL;
        $("#logo").change(function(e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {

                    if (this.width != 375 || this.height != 125) {
                        // alert(this.width + " " + this.height);
                        $('#error2').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                    } else {
                        $('#error2').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);

                };
                img.src = objectUrl;
            }
        });
    </script>
    {{-- <script>
        $(function() {
            $('.status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var recaptcha_id = $(this).data('id');

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('recaptchastatus') }}",
                    data: {
                        'status': status,
                        'recaptcha_id': recaptcha_id
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                    }
                });
            })
        })
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var select = $('.select2');
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                dropdownParent: $this.parent()
            });
        });
    </script>
    <script src="{{ asset('js/scripts/admin/setting.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/logo.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/recaptcha.js') }}"></script>
    <script src="{{ asset('js/core/libs.min.js') }}"></script>
    <script src="{{ asset('js/core/external.min.js') }}"></script>
    <script src="{{ asset('js/charts/widgetcharts.js') }}"></script>
    <script src="{{ asset('vendor/Leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('js/charts/dashboard.js') }}"></script>
    <script src="{{ asset('js/charts/admin.js') }}"></script>
    <script src="{{ asset('js/fslightbox.js') }}"></script>
    <script src="{{ asset('vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('vendor/gsap/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/animation/gsap-init.js') }}"></script>
    <script src="{{ asset('js/stepper.js') }}"></script>
    <script src="{{ asset('js/form-wizard.js') }}"></script>
    <script src="{{ asset('js/circle-progress.js') }}"></script>
    <script src="{{ asset('js/prism.mini.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/moment.min.js') }}"></script>


@endsection
