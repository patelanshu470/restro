@extends('layouts/contentLayoutMaster')
@section('title', 'Product')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
    <style>
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

        .mt-100 {
            margin-top: 100px
        }

        .choices__inner {
            border-radius: 1.25rem !important;
            background-color: #fff;
            height: auto;
        }

        .choices__input {
            background-color: #fff;

        }

        .choices__list.choices__list--dropdown {
            height: 13rem;
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

        .select2-container--default .select2-selection--multiple {
            /* height: 45px; */
            display: block;
            /* width: 100%; */
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
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: solid #E3E1E1 1px;
            outline: 0
        }
    </style>
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
        <div>
            <form method="POST" enctype="multipart/form-data" id="edit_form" name="product_edit_edit"
                action="{{ route('products.update', $data->id) }}">
                @csrf
                @method('PUT')
                {{-- Food Info  --}}
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"> Food Info</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row ">
                                        <div class="form-group col-md-6 ">
                                            <label class="form-label" for="furl">Product Name:</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $data->name }}" id="fname" placeholder="Product Name"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Product Description</label>
                                            <textarea class=" form-control" name="desc">@php echo $data->desc @endphp </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  Food Image card start  --}}
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Food Image</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row ">
                                        <div class="form-group col-md-4 ">
                                            <div class="profile-img-edit position-relative">
                                                <img class="profile-pic rounded avatar-100" style=""
                                                    src="{{ $data->thumbnail ? URL::asset('images/product/thumbnail/' . $data->thumbnail) : asset('no-image.jpg') }}"
                                                    alt="profile-pic">
                                                <div class="upload-icone bg-primary">
                                                    <i class="fa-solid fa-pen" style="color:white;"></i>
                                                    <input class="file-upload-test" accept=".jpg,.jpeg,.png"
                                                        name="product_thumnail" id="product_thumnail" type="file"
                                                        style="position:relative; bottom:30px; right:5px;opacity:0">
                                                </div>
                                            </div>
                                            <div class="img-extension mt-">
                                                <div class="d-inline-block align-items-center">
                                                    <span>Product Thumbnail</span><br>
                                                    <span><a href="javascript:void();">.jpg .png .jpeg</a></span><br>
                                                    <span id="error" style="color: red"></span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="form-label" for="furl">Product Gallary: <p
                                                    style="color:#ea5455;" id="gallary_error">Please select more than 3
                                                    Image </p></label>
                                            {{-- <span id="gallary_error" style="color: #ea5455; display: none;">Please select more than 3 Image</span> --}}

                                            <div class="form-group ">
                                                <input type="file" name="gallary[]" id="images" multiple
                                                    accept=".jpg,.jpeg,.png" class="form-control">
                                            </div>
                                            {{-- <span id="gallary_error" style="color: red"></span> --}}
                                            @if (count($data->gallary) > 0)
                                                <div class="img-thumbs img-thumbs" id="img-previews">
                                                    @foreach ($data->gallary as $img)
                                                        <div class="wrapper-thumb" id="maind{{ $img->id }}">
                                                            <img src="{{ URL::asset('images/product/gallary/' . $img->path) }}"
                                                                for="upload-img" class="img-preview-thumb b">
                                                            <span class="removeBtn remove-btn" id="d{{ $img->id }}"
                                                                data-url="{{ route('admin.product.del', $img->id) }}">x</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                {{-- <div class="img-thumbs img-thumbs-hidden" id="img-preview" >
                                            <div class="wrapper-thumb" >
                                            </div>
                                      </div> --}}
                                            @endif
                                            <div class="">
                                                <div id="image_preview" style="width:100%;display: none;">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- card end  --}}
                </div>
                {{-- food detail  --}}
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Food Details</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Restaurant:</label>
                                            <select name="restaurant_id" id="restaurant_id"
                                                class="selectpicker form-control select2">
                                                <option disabled selected>Select Restaurant</option>
                                                @foreach ($restaurant as $restaurants)
                                                    <option value="{{ $restaurants->id }}"
                                                        {{ $restaurants->id == $data->restaurent_id ? 'Selected' : '' }}>
                                                        {{ $restaurants->restaurant_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Category:</label>
                                            <select name="category" id="category-dropdown"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option disabled selected>product category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $cat->id == $data->product_category ? 'Selected' : '' }}>
                                                        {{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                        @endphp
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Sub-Category:</label>
                                            <select name="subcategory" id="subcategory-dropdown"
                                                class="selectpicker form-control" data-style="py-0" required>
                                                <option disabled selected>product Sub-category</option>
                                                @foreach ($subcategory as $subcat)
                                                    <option value="{{ $subcat->id }}"
                                                        {{ $subcat->id == $data->subcategory_id ? 'Selected' : '' }}>
                                                        {{ $subcat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Type:</label>
                                            <select name="type" id="country-dropdown"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option disabled selected>Product type</option>
                                                <option {{ $data->type == 'veg' ? 'selected' : '' }} value="veg">Veg
                                                </option>
                                                <option {{ $data->type == 'non_veg' ? 'selected' : '' }} value="non_veg">
                                                    Non Veg</option>
                                            </select>
                                        </div>
                                        @php
                                            $adonID = $data->addon_id ? json_decode($data->addon_id) : null;
                                        @endphp
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Addons:</label>
                                            <select id="" name="addons[]"
                                                class="addons_select form-control rounded-pill select2" multiple>
                                                @if ($adonID)
                                                    @foreach ($addon as $on)
                                                        <option value="{{ $on->id }}"
                                                            {{ in_array($on->id, json_decode($data->addon_id)) ? 'selected' : '' }}>
                                                            {{ $on->name }} </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($addon as $on)
                                                        <option value="{{ $on->id }}">{{ $on->name }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Weight</label>
                                            <input type="number" class="form-control"
                                                value="{{ $data->weight_per_piece }}" name="weight_per_piece"
                                                id="add1" placeholder="Per Item in gram ">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Quantity:</label>
                                            <input type="text" class="form-control" value="{{ $data->quantity }}"
                                                name="quantity" placeholder="Quantity">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Cooking Time:</label>
                                            <input type="text" class="form-control" value="{{ $data->cooking_time }}"
                                                name="cooking_time" id="pno" placeholder="Cooking Time">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Size:</label>
                                            <select name="size" id="country-dropdown"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option disabled selected>product size</option>
                                                <option {{ $data->size == 'Medium' ? 'selected' : '' }} value="Medium">
                                                    Medium</option>
                                                <option {{ $data->size == 'Regular' ? 'selected' : '' }} value="Regular">
                                                    Regular</option>
                                                <option {{ $data->size == 'Large' ? 'selected' : '' }} value="Large">
                                                    Large
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- card end  --}}
                {{-- Amount --}}
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Amount</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="instaurl">Cost Price:</label>
                                            <input type="text" class="form-control" value="{{ $data->cost_price }}"
                                                name="cost_price" id="lname" placeholder="Cost Price">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Sell Price</label>
                                            <input type="text" class="form-control" value="{{ $data->sell_price }}"
                                                name="sell_price" id="sell_price" placeholder="Sell Price">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Discount Type:</label>
                                            <select name="discount_type" id="discount_type"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option disabled selected>Discount type</option>
                                                <option value="percent"
                                                    {{ $data->discount_type == 'percent' ? 'selected' : '' }}>Percent(%)
                                                </option>
                                                <option value="amount"
                                                    {{ $data->discount_type == 'amount' ? 'selected' : '' }}>Amount($)
                                                </option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Discount </label>
                                            <input type="text" class="form-control" value="{{ $data->discount }}"
                                                name="discount" id="discount" placeholder="Discount Price">
                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-label" for="discount"><strong>Final Price</strong></label>
                                            <input type="text" class="form-control" name="final_price" readonly
                                                value="{{ $data->final_price }}" id="final_price" placeholder="0">
                                            {{--                                             
                                            <label class="form-label fw-bold">Total:</label>
                                            <span class="preview_discount" style="color:green">0.00</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end  --}}
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card" style="background:transparent ">
                    <div class="card-body p-0">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    {{-- <button type="button" id="submit_btn"    class="btn btn-primary">Update</button> --}}
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- button end  --}}
            </form>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $("body").on("click", "#action-icon", function(evt) {
                var fileUpload = $("#images");
                var numItems = $('.img-thumbs').children('div').length;
                // alert(numItems);
                var checkimage = parseInt(fileUpload.get(0).files.length) + numItems;
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
        var fl = document.getElementById('product_thumnail');
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
        var uploadImg = document.getElementById('images');
        uploadImg.onchange = function(e) {
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



    {{-- attention:  --}}
    <script>
        $(document).ready(function() {
            $('#discount').on('input', function() {
                var dis_type_check = $('#discount_type').find(":selected").val();

                // stop user from entering more than 100% 
                if (dis_type_check == "percent") {
                    var val = parseInt($(this).val(), 10);
                    if (isNaN(val) || val < 0) {
                        $(this).val(0);
                    } else if (val > 100) {
                        $(this).val(100);
                    }
                }

                // stop user from entering greater than selling price
                if (dis_type_check == "amount") {

                    var sp_f = $('#sell_price').val();

                    var val = parseInt($(this).val(), 10);
                    if (isNaN(val) || val < 0) {
                        $(this).val(0);
                    } else if (val > sp_f) {
                        $(this).val(sp_f);
                    }
                }

            });
        });
    </script>


    {{-- product discount.. --}}
    <script>
        $('#discount,#sell_price,#discount_type').on('keyup', function(e) {

            var sp = $('#sell_price').val();
            $('#final_price').val(sp);
            var discount = $('#discount').val();
            var dis_type = $('#discount_type').find(":selected").val();

            if (dis_type == "percent") {
                var final = sp * discount / 100;

                f_final = sp - final;
                $('#final_price').val(f_final.toFixed(0));
                return false;
            }
            if (dis_type == "amount") {
                var per = sp - discount;
                $('#final_price').val(per.toFixed(0));
                return false;
            }
        });


        $('#discount_type').change('change', function(e) {

            var sp = $('#sell_price').val();
            $('#final_price').val(sp);
            var discount = $('#discount').val();
            var dis_type = $('#discount_type').find(":selected").val();

            if (dis_type == "percent") {
                var final = sp * discount / 100;

                f_final = sp - final;
                $('#final_price').val(f_final.toFixed(0));
                return false;
            }
            if (dis_type == "amount") {
                var per = sp - discount;
                $('#final_price').val(per.toFixed(0));
                return false;
            }
        });


    </script>
    {{-- end product discount... --}}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var select = $('.select2');

        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });
    </script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script>
        function deleteRecord(id) {
            Swal.fire({
                title: 'Confirmation!',
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085D6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del' + id).click();
                } else
                    return false;
            });
        }


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
        // attention:
        //   Category Dropdown Change Event
        $('#category-dropdown').on('change', function() {
            var catId = this.value;
            $.ajax({
                url: "{{ route('fetchSubCat') }}",
                type: "GET",
                data: {
                    catId: catId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#subcategory-dropdown').html('<option value="">Select SubCategory</option>');
                    $.each(result.subcat, function(key, value) {
                        $("#subcategory-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            if ('{{ count($data->gallary) > 3 }}') {
                $('#gallary_error').css('display', 'none');
                $('button:submit').attr('disabled', false);
            } else {
                $('#gallary_error').css('display', '');
                $('button:submit').attr('disabled', true);
            }
        });
        $("#images").change(function(e) {
            var fileUpload = $("#images");
            var numItems = $('#img-previews').children('div').length;
            var checkimage = parseInt(fileUpload.get(0).files.length) + numItems;
            // alert(checkimage);
            if (checkimage > 3) {
                $('#gallary_error').css('display', 'none');
                $('button:submit').attr('disabled', false);
            }
        });
    </script>
    <script>
        $('#restaurant_id').on('change', function() {
            var restaurant = this.value;
            $(".addons_select").html('');
            $.ajax({
                url: "{{ route('admin.fetchAddon') }}",
                type: "GET",
                data: {
                    restaurant: restaurant,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $.each(result.addons, function(key, value) {
                        $(".addons_select").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>

    <script src="{{ asset('js/scripts/restaurant/product.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

@endsection
