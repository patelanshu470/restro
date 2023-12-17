@extends('layouts/contentLayoutMaster')
@section('title', 'Restaurant Information')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/css/intlTelInput.css" rel="stylesheet" />
    <style>
        #restro_image-error {
            margin-bottom: 4px;
            position: relative;
            top: 20px;
            right: 130px;
            background: transparent;
            /* left: 0; */
            font-size: 0.8rem;
            width: 370px;
        }

        #cover_image-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        #logo_image-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        .img-thumbs {
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }

        .img-thumbs-hidden {
            display: none;
        }

        .wrapper-thumb {
            position: relative;
            display: inline-block;
            margin: 1rem 0;
            justify-content: space-around;
        }

        .img-preview-thumb {
            background: #fff;
            border: 1px solid none;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }

        .remove-btn {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: .7rem;
            top: -5px;
            right: 10px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .remove-btn:hover {
            box-shadow: 0px 0px 3px grey;
            transition: all .3s ease-in-out;
        }

        #product_thumnail-error {
            margin-bottom: 6px;
            position: relative;
            top: 20px;
            right: 100px;
            width: 300px;
            font-size: 1rem;
            background: transparent;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        #image_preview {
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }

        .img-div {
            position: relative;
            display: inline-block;
            margin: 1rem 0;
        }

        .img-thumbnail {
            background: #fff;
            border: 1px solid none;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgb(0 0 0 / 12%);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }

        .middle {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: .7rem;
            top: -5px;
            right: 10px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .selected-flag {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        /* @media (min-width: 1440px) {
                                        #phone_number {
                                        width: 10px;
                                    }
                                    } */
        .flag-container {
            height: 48px;
        }

        @media only screen and (min-width: 768px) {
            #phone_number {
                width: 600px;
            }

            #phone1 {
                width: 400px;
            }
        }

        @media only screen and (min-width: 1920px) {
            #phone_number {
                width: 840px;
            }

            #phone1 {
                width: 550px;
            }
        }

        @media only screen and (max-width: 1024px) {
            #phone_number {
                width: 440px;
            }

            #phone1 {
                width: 280px;
            }
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
        <div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Restaurant Information</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('rest.info.store') }}"
                                    name="restaurant_create" id="validation" onsubmit="return validatesForm()">
                                    @csrf
                                    <div class="row">
                                        {{-- dynamic section  --}}
                                        @if (count($restaurant_info->restaurant_gallary) > 0 or $restaurant_info->facebook_url or $restaurant_info->instagram_url)

                                            <div class="form-group col-md-6">
                                                <div class="form-group ">
                                                    <label class="form-label" for="furl">Facebook Url:</label>
                                                    <input type="url" name="facebook_url" class="form-control"
                                                        value="{{ $restaurant_info->facebook_url }}" id="furl"
                                                        placeholder="Facebook Url" required>
                                                    <p id="facebook_error" class="check"
                                                        style="display:none; color:#ea5455;">
                                                        Please enter a valid Facebook url.
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="instaurl">Instagram Url:</label>
                                                    <input type="url" name="instagram_url" class="form-control"
                                                        value="{{ $restaurant_info->instagram_url }}" id="instaurl"
                                                        placeholder="Instagram Url" required>
                                                    <p id="insta_error" class="check" style="display:none; color:#ea5455;">
                                                        Please enter a valid Instagram url.
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="furl">Restaurant Gallary: </label> <br>
                                                <span id="gallary_error" style="color: #ea5455; display: none;">Please
                                                    select more than 3 Image</span>
                                                <div class="form-group ">
                                                    {{-- attention:  --}}
                                                    <input type="file" name="gallary[]" id="images" multiple
                                                        accept=".jpg,.jpeg,.png" class="form-control">
                                                </div>

                                                @if (count($restaurant_info->restaurant_gallary) > 0)
                                                    <div class="img-thumbs img-thumbs" id="img-previews">
                                                        @foreach ($restaurant_info->restaurant_gallary as $img)
                                                            <div class="wrapper-thumb" id="maind{{ $img->id }}">
                                                                <img src="{{ URL::asset('images/restaurant/gallary/' . $img->path) }}"
                                                                    for="upload-img" class="img-preview-thumb b">
                                                                <span class="removeBtn remove-btn" id="d{{ $img->id }}"
                                                                    data-url="{{ route('rest.gallary.del', $img->id) }}">x</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                @endif
                                                <div class="">
                                                    <div id="image_preview" style="width:100%;display: none;">
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group col-md-6">
                                                <div class="form-group ">
                                                    <label class="form-label" for="furl">Facebook Url:</label>
                                                    <input type="url" name="facebook_url" class="form-control"
                                                        id="furl" placeholder="Facebook Url" required>
                                                    <p id="facebook_error" class="check"
                                                        style="display:none; color:#ea5455;">
                                                        Please enter a valid Facebook url.
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="instaurl">Instagram Url:</label>
                                                    <input type="url" name="instagram_url" class="form-control" required
                                                        id="instaurl" placeholder="Instagram Url">
                                                    <p id="insta_error" class="check" style="display:none; color:#ea5455;">
                                                        Please enter a valid Instagram url.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="furl">Restaurant Gallary: <p
                                                            style="color:#ea5455;" id="error_resto_galary"
                                                            class="check">
                                                            Please select more than 3 Image </p></label>
                                                    <input type="file" name="gallary[]" id="images" multiple
                                                        accept=".jpg,.jpeg,.png" class="form-control" required>
                                                    <span><a href="javascript:void(0);">.jpg .png .jpeg</a></span>
                                                </div>
                                                <div class="form-group">
                                                    <div id="image_preview" style="width:100%;display: none;">
                                                    </div>
                                                </div>
                                            </div>

                                        @endif


                                        {{-- end  --}}


                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="restaurant_name">Restaurant Name:</label>
                                            <input type="text" class="form-control" name="" readonly
                                                value="{{ $restaurant_info->restaurant_name }}" id="restaurant_name"
                                                placeholder="Restaurant Name">
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{-- attention:  --}}
                                            <label class="form-label" for="restro_contact_number">Contact Number:</label>
                                            @php
                                                $default_country = App\Models\DefaultCountry::first();
                                            @endphp
                                            @if ($default_country)
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text">{{ $default_country->country_code }}</span>
                                                    <input type="text" name=""
                                                        value="{{ $restaurant_info->restro_contact_number }}"
                                                        id="" readonly class="form-control" style="width: 80%">
                                                </div>
                                            @else
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">+61</span>
                                                    <input type="text" name="" id="" readonly
                                                        value="{{ $restaurant_info->restro_contact_number }}"
                                                        class="form-control" style="width: 80%">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Street</label>
                                            <input type="text" class="form-control" name="" id="add1"
                                                readonly value="{{ $restaurant_info->address[0]->street }}"
                                                placeholder="Street">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add2">Landmark</label>
                                            <input type="text" class="form-control" name="" id="add2"
                                                readonly value="{{ $restaurant_info->address[0]->landmark }}"
                                                placeholder="Landmark">
                                        </div>

                                        <div class="form-group col-md-6">
                                            @php
                                                if ($restaurant_info->address) {
                                                    $country_name = App\Models\Country::find($restaurant_info->address[0]->country);
                                                    $get_c_name = $country_name->name;
                                                } else {
                                                    $get_c_name = '';
                                                }
                                            @endphp
                                            <label class="form-label" for="add2">Country:</label>
                                            <input type="text" class="form-control" name="" id="add2"
                                                readonly value="{{ $get_c_name }}" placeholder="country">
                                        </div>

                                        <div class="form-group col-md-6">
                                            @php
                                                if ($restaurant_info->address) {
                                                    $state_name = App\Models\State::find($restaurant_info->address[0]->state);
                                                    $get_s_name = $state_name->name;
                                                } else {
                                                    $get_s_name = '';
                                                }
                                            @endphp
                                            <label class="form-label" for="add2">State:</label>
                                            <input type="text" class="form-control" name="" id="add2"
                                                readonly value="{{ $get_s_name }}" placeholder="State">
                                        </div>


                                        <div class="form-group col-md-6">
                                            @php
                                                if ($restaurant_info->address) {
                                                    $city_name = App\Models\City::find($restaurant_info->address[0]->city);
                                                    $get_c_name = $city_name->name;
                                                } else {
                                                    $get_c_name = '';
                                                }
                                            @endphp
                                            <label class="form-label" for="add2">City:</label>
                                            <input type="text" class="form-control" name="" id="add2"
                                                readonly value="{{ $get_c_name }}" placeholder="city">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Pin Code:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $restaurant_info->address[0]->pincode }}" readonly
                                                name="" id="pno" placeholder="Pin Code">
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page-script')

    @if (count($restaurant_info->restaurant_gallary) > 0)
        <script src="{{ asset('js/scripts/admin/restaurant.js') }}"></script>


        <script>
            $(document).ready(function() {
                $("body").on("click", "#action-icon", function(evt) {
                    var fileUpload = $("#images");
                    // alert(fileUpload);
                    var numItems = $('#img-previews').children('div').length;
                    var checkimage = parseInt(fileUpload.get(0).files.length) + numItems;
                    // alert(checkimage);
                    if (checkimage - 1 > 3) {
                        $('#gallary_error').css('display', 'none');
                        $('button:submit').attr('disabled', false);

                    } else {
                        $('#gallary_error').css('display', '');
                        $('button:submit').attr('disabled', true);
                    }

                    if (parseInt(fileUpload.get(0).files.length) == 1) {
                        $('#image_preview').css('display', 'none');

                    }

                });
            });
        </script>


        <script>
            // var fl = document.getElementById('images');
            var uploadImg = document.getElementById('images');
            //uploadImg.files: FileList
            uploadImg.onchange = function(e) {
                // alert('d');
                for (var i = 0; i < uploadImg.files.length; i++) {
                    var f = uploadImg.files[i];
                    var ext = f.name.match(/\.(.+)$/)[1];
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                            break;
                        default:
                            this.value = '';
                    }
                }
            }
        </script>
        {{-- logo size validation.. --}}


        <script>
            $(document).ready(function() {
                var fileArr = [];
                $("#images").change(function() {
                    // check if fileArr length is greater than 0
                    if (fileArr.length > 0) fileArr = [];
                    $("#image_preview").html("");
                    var total_file = document.getElementById("images").files;
                    if (!total_file.length) return;
                    for (var i = 0; i < total_file.length; i++) {
                        if (total_file[i].size > 6291456) {
                            return false;
                        } else {
                            fileArr.push(total_file[i]);
                            $("#image_preview").append(
                                "<div class='img-div' id='img-div" +
                                i +
                                "'><img src='" +
                                URL.createObjectURL(event.target.files[i]) +
                                "' class='img-responsive image img-thumbnail' title='" +
                                total_file[i].name +
                                "'><div class='middle'><button type='button' id='action-icon' value='img-div" +
                                i +
                                "' class='btn ' role='" +
                                total_file[i].name +
                                "'><i class='fa-solid fa-xmark'></i></button></div></div>"
                            );
                        }
                    }
                });
                $("body").on("click", "#action-icon", function(evt) {
                    var divName = this.value;
                    var fileName = $(this).attr("role");
                    $(`#${divName}`).remove();
                    for (var i = 0; i < fileArr.length; i++) {
                        if (fileArr[i].name === fileName) {
                            fileArr.splice(i, 1);
                        }
                    }
                    document.getElementById("images").files = FileListItem(fileArr);
                    evt.preventDefault();
                });

                function FileListItem(file) {
                    file = [].slice.call(Array.isArray(file) ? file : arguments);
                    for (var c, b = (c = file.length), d = !0; b-- && d;)
                        d = file[b] instanceof File;
                    if (!d)
                        throw new TypeError(
                            "expected argument to FileList is File or array of File objects"
                        );
                    for (b = new ClipboardEvent("").clipboardData || new DataTransfer(); c--;)
                        b.items.add(file[c]);
                    return b.files;
                }
            });
        </script>

        <script>
            $("#images").change(function(e) {
                var $fileUpload = $("#images");
                if (parseInt($fileUpload.get(0).files.length) > 0) {
                    $('#image_preview').css('display', '');
                }
            });
        </script>
        <script>
            jQuery(document).on("click", ".removeBtn", function() {
                var url = $(this).attr("data-url");
                var del_id = $(this).attr("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085D6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: "get",
                            success: function(data) {

                                var numItems = $('.remove-btn').length
                                if (numItems <= 1) {
                                    $('#img-preview').addClass('img-thumbs-hidden');
                                }

                                $("div").remove('#main' + del_id);
                                var fileUpload = $("#images");
                                var checkimage = parseInt(fileUpload.get(0).files.length) +
                                    parseInt(data);
                                if (checkimage > 4) {
                                    $('#gallary_error').css('display', 'none');
                                    $('button:submit').attr('disabled', false);
                                } else {
                                    $('#gallary_error').css('display', '');
                                    $('button:submit').attr('disabled', true);
                                }

                                // alert(data);
                                if (data == 1) {
                                    $('#img-previews').css('display', 'none');

                                }

                            },
                        });

                        $(this).parents(".rem").parent().remove();
                    }
                });
            });
        </script>

        <script>
            $('#furl').keyup(function() {
                var dInput = this.value;
                // var url2 = 'https://www.instagram.com/';
                function validate_fb_url(url) {

                    if (/^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(url)) {

                        return 'facebook';
                    } else {
                        return 'unknown';
                    }
                }
                if (validate_fb_url(dInput) == 'facebook') {
                    $('#facebook_error').slideUp("slow");
                    $('button:submit').attr('disabled', false);
                } else {
                    $('#facebook_error').slideDown("slow");
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            $('#instaurl').keyup(function() {
                var dInput = this.value;

                function validate_fb_url(url) {

                    if (/^(https?:\/\/)?((w{3}\.)?)instagram.com\/.*/i.test(url)) {

                        return 'instagram';
                    } else {
                        return 'unknown';
                    }
                }
                if (validate_fb_url(dInput) == 'instagram') {
                    $('#insta_error').slideUp("slow");
                    $('button:submit').attr('disabled', false);
                } else {
                    $('#insta_error').slideDown("slow");
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            if ('{{ count($restaurant_info->restaurant_gallary) < 4 }}') {
                $('#gallary_error').css('display', '');
                $('button:submit').attr('disabled', true);
            }
            $("#images").change(function(e) {
                var fileUpload = $("#images");
                var numItems = $('#img-previews').children('div').length;

                var checkimage = parseInt(fileUpload.get(0).files.length) + numItems;
                if (checkimage > 3) {
                    $('#gallary_error').css('display', 'none');
                    $('button:submit').attr('disabled', false);
                }
            });
        </script>


        <script>
            $("button[type='submit']").mouseover(function() {
                var checkfburl = $("#gallary_error").css("display");
                if (checkfburl == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            $("button[type='submit']").mouseover(function() {
                var checklogo = $("#error2").css("display");
                // alert(checklogo);
                if (checklogo == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            $("button[type='submit']").mouseover(function() {
                var checkfburl = $("#facebook_error").css("display");
                if (checkfburl == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            $("button[type='submit']").mouseover(function() {
                var checkfburl = $("#insta_error").css("display");
                if (checkfburl == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
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
    @else
        <script>
            if ('{{ count($restaurant_info->restaurant_gallary) < 4 }}') {
                $('#gallary_error').css('display', '');
                $('button:submit').attr('disabled', true);
            }
            $("#images").change(function(e) {
                var fileUpload = $("#images");
                var numItems = $('#img-previews').children('div').length;

                var checkimage = parseInt(fileUpload.get(0).files.length) + numItems;
                if (checkimage > 3) {

                    $('#gallary_error').css('display', 'none');
                    $('button:submit').attr('disabled', false);
                }
            });
        </script>

        <script>
            $("#images").change(function(e) {
                var $fileUpload = $("#images");
                if (parseInt($fileUpload.get(0).files.length) > 0) {
                    $('#image_preview').css('display', '');
                }
            });
        </script>

        <script>
            jQuery(document).on("click", ".removeBtn", function() {
                var url = $(this).attr("data-url");
                var del_id = $(this).attr("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085D6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: "get",
                            success: function(data) {
                                // Swal.fire(
                                //     "Deleted!",
                                //     "Your data has been deleted.",
                                //     "success"
                                // );
                                var numItems = $('.remove-btn').length
                                if (numItems <= 1) {
                                    $('#img-preview').addClass('img-thumbs-hidden');
                                }

                                $("div").remove('#main' + del_id);
                                var fileUpload = $("#images");
                                var checkimage = parseInt(fileUpload.get(0).files.length) +
                                    parseInt(data);
                                if (checkimage > 4) {
                                    $('#gallary_error').css('display', 'none');
                                    $('button:submit').attr('disabled', false);
                                } else {
                                    $('#gallary_error').css('display', '');
                                    $('button:submit').attr('disabled', true);
                                }

                                // alert(data);
                                if (data == 1) {
                                    $('#img-previews').css('display', 'none');

                                }

                            },
                        });

                        $(this).parents(".rem").parent().remove();
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("body").on("click", "#action-icon", function(evt) {
                    var $fileUpload = $("#images");
                    if (parseInt($fileUpload.get(0).files.length) > 4) {
                        alert("ff");
                        $('#error_resto_galary').slideUp("slow");
                        $('button:submit').attr('disabled', false);

                    } else {
                        $('#error_resto_galary').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        // return false;
                    }

                    // alert(parseInt($fileUpload.get(0).files.length));

                    if (parseInt($fileUpload.get(0).files.length) == 1) {
                        $('#image_preview').css('display', 'none');

                    }
                });
            });
        </script>
        <script>
            var fl = document.getElementById('restro_image');
            fl.onchange = function(e) {
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'tif':
                        break;
                    default:
                        this.value = '';
                }
            };
        </script>
        <script>
            var fl = document.getElementById('cover_image');

            fl.onchange = function(e) {
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'tif':
                        break;
                    default:
                        this.value = '';
                }
            };
        </script>
        <script>
            var fl = document.getElementById('logo_image');

            fl.onchange = function(e) {
                // alert(this.value);
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'tif':
                        break;
                    default:
                        this.value = '';
                }
            };
        </script>
        <script>
            // var fl = document.getElementById('images');
            var uploadImg = document.getElementById('images');
            //uploadImg.files: FileList
            uploadImg.onchange = function(e) {
                // alert('d');
                for (var i = 0; i < uploadImg.files.length; i++) {
                    var f = uploadImg.files[i];
                    var ext = f.name.match(/\.(.+)$/)[1];
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                            break;
                        default:
                            this.value = '';
                    }
                }
            }
        </script>



        {{-- multi img  --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
        <script>
            $(document).ready(function() {
                var fileArr = [];
                $("#images").change(function() {
                    // check if fileArr length is greater than 0
                    if (fileArr.length > 0) fileArr = [];
                    $("#image_preview").html("");
                    var total_file = document.getElementById("images").files;
                    if (!total_file.length) return;
                    for (var i = 0; i < total_file.length; i++) {
                        if (total_file[i].size > 6291456) {
                            return false;
                        } else {
                            fileArr.push(total_file[i]);
                            $("#image_preview").append(
                                "<div class='img-div' id='img-div" +
                                i +
                                "'><img src='" +
                                URL.createObjectURL(event.target.files[i]) +
                                "' class='img-responsive image img-thumbnail' title='" +
                                total_file[i].name +
                                "'><div class='middle'><button type='button' id='action-icon' value='img-div" +
                                i +
                                "' class='btn ' role='" +
                                total_file[i].name +
                                "'><i class='fa-solid fa-xmark'></i></button></div></div>"
                            );
                        }
                    }
                });
                $("body").on("click", "#action-icon", function(evt) {
                    var divName = this.value;
                    var fileName = $(this).attr("role");
                    $(`#${divName}`).remove();
                    for (var i = 0; i < fileArr.length; i++) {
                        if (fileArr[i].name === fileName) {
                            fileArr.splice(i, 1);
                        }
                    }
                    document.getElementById("images").files = FileListItem(fileArr);
                    evt.preventDefault();
                });

                function FileListItem(file) {
                    file = [].slice.call(Array.isArray(file) ? file : arguments);
                    for (var c, b = (c = file.length), d = !0; b-- && d;)
                        d = file[b] instanceof File;
                    if (!d)
                        throw new TypeError(
                            "expected argument to FileList is File or array of File objects"
                        );
                    for (b = new ClipboardEvent("").clipboardData || new DataTransfer(); c--;)
                        b.items.add(file[c]);
                    return b.files;
                }
            });
        </script>



        <script>
            $('#furl').keyup(function() {
                var dInput = this.value;
                // var url2 = 'https://www.instagram.com/';
                function validate_fb_url(url) {

                    if (/^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(url)) {

                        return 'facebook';
                    } else {
                        return 'unknown';
                    }
                }
                if (validate_fb_url(dInput) == 'facebook') {
                    $('#facebook_error').slideUp("slow");
                    $('button:submit').attr('disabled', false);
                } else {
                    $('#facebook_error').slideDown("slow");
                    $('button:submit').attr('disabled', true);
                    //    return false;

                }
            });
        </script>
        <script>
            $('#instaurl').keyup(function() {
                var dInput = this.value;
                // var url2 = 'https://www.instagram.com/';
                function validate_fb_url(url) {

                    if (/^(https?:\/\/)?((w{3}\.)?)instagram.com\/.*/i.test(url)) {

                        return 'instagram';
                    } else {
                        return 'unknown';
                    }
                }
                if (validate_fb_url(dInput) == 'instagram') {
                    $('#insta_error').slideUp("slow");
                    $('button:submit').attr('disabled', false);
                } else {
                    $('#insta_error').slideDown("slow");
                    $('button:submit').attr('disabled', true);
                    // $("#instaurl").val('');

                }
            });
        </script>
        <script>
            $("#images").change(function(e) {
                var $fileUpload = $("#images");
                if (parseInt($fileUpload.get(0).files.length) > 3) {
                    $('#error_resto_galary').slideUp("slow");
                    $('button:submit').attr('disabled', false);

                } else {
                    $('button:submit').attr('disabled', true);
                }

                if (parseInt($fileUpload.get(0).files.length) > 0) {
                    $('#image_preview').css('display', '');

                }
            });
        </script>



        <script src="{{ asset('js/scripts/admin/restaurant.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $('#uname').keyup(function() {
                var email = this.value;
                $.ajax({
                    url: "{{ route('fetchEmail') }}",
                    type: "POST",
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.email) {
                            $("#uname").val('');
                            $('#email').css('display', '');
                        } else {
                            $('#email').css('display', 'none');
                        }
                        if (email == '') {
                            $('#email').css('display', 'none');
                        }
                    }
                });
            });
        </script>
        <script>
            $('#phone1').keyup(function() {
                var phone_number = this.value;
                $.ajax({
                    url: "{{ route('fetchphone_number') }}",
                    type: "POST",
                    data: {
                        phone_number: phone_number,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.phone_number) {
                            $("#phone1").val('');
                            $('#phone_number_error').css('display', '');
                        } else {
                            $('#phone_number_error').css('display', 'none');
                        }
                        if (email == '') {
                            $('#phone_number_error').css('display', 'none');
                        }
                    }
                });
            });
        </script>
        {{-- <script>
        $("button[type='submit']").mouseover(function() {
            var fileUpload = $("#images");
            if (parseInt(fileUpload.get(0).files.length) < 4) {
                $('button:submit').attr('disabled', true);
            }
        });
    </script> --}}

        <script>
            $("button[type='submit']").mouseover(function() {
                var checklogo = $("#error2").css("display");
                if (checklogo == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            $("button[type='submit']").mouseover(function() {
                var checkfburl = $("#facebook_error").css("display");
                if (checkfburl == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>
        <script>
            $("button[type='submit']").mouseover(function() {
                var checkfburl = $("#insta_error").css("display");
                if (checkfburl == 'block') {
                    $('button:submit').attr('disabled', true);
                }
            });
        </script>


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
    @endif



@endsection
