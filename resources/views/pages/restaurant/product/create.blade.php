@extends('layouts/contentLayoutMaster')
@section('title', 'Product')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
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

        #product_thumnail-error {
            margin-bottom: 6px;
            position: relative;
            top: 20px;
            right: 100px;
            width: 300px;
            font-size: 1rem;
            background: transparent;
        }

        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
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
        #image_preview{
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }
        .img-div{
            position: relative;
            display: inline-block;
            margin: 1rem 0;
        }
        .img-thumbnail{
            background: #fff;
            border: 1px solid none;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgb(0 0 0 / 12%);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }
        .middle{
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
    </style>
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
        <div>

            <form method="POST" enctype="multipart/form-data" id="product_add_create" name="product_add"
                class="product_add" onsubmit="return validateForm()" action="{{ route('product.store') }}">
                @csrf
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
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="furl">Product Name:</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Product Name">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Product Description</label>
                                            <textarea class=" form-control" id="desc" name="desc"> </textarea>
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
                                            <div class="profile-img-edit position-relative ">
                                                <img class="profile-pic rounded avatar-100 "
                                                    src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                                <div class="upload-icone bg-primary">
                                                    <i class="fa-solid fa-pen" style="color:white;"></i>
                                                    <input class="file-upload-test form-control "
                                                        style="position:relative; bottom:30px; right:5px;opacity:0"
                                                        accept=".jpg,.jpeg,.png" name="product_thumnail"
                                                        id="product_thumnail" type="file">
                                                </div>
                                            </div>
                                            <div class="img-extension mt-">
                                                <div class="d-inline-block align-items-center">
                                                    <span>Product Thumbnail</span><br>
                                                    <small>Recommended size:356x356px</small><br>
                                                    <span><a href="javascript:void();">.jpg .png .jpeg</a></span><br>
                                                    <span id="error" style="color: red"></span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group col-md-6">
                                            <label class="form-label" for="furl">Product Gallary:</label>
                                            <div class="form-group ">
                                                <input type="file" accept=".jpg,.jpeg,.png" class="form-control"
                                                    name="gallary[]" multiple id="upload-img" />
                                            </div>
                                            <div class="img-thumbs img-thumbs-hidden" id="img-preview">

                                            </div>
                                        </div> --}}
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-label" for="furl">Product Gallary: <p style="color:red;" id="error_product_galary">Please select more than 3 Image </p></label>
                                                <input type="file" name="gallary[]" id="images" multiple
                                                accept=".jpg,.jpeg,.png" class="form-control" required>
                                            </div>
                                            <div class="form-group">
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
                                            <label class="form-label">Select Category:</label>
                                            <select name="category" id="category-dropdown" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option disabled selected>product category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select SubCategory:</label>
                                            <select name="subcategory" id="subcategory-dropdown"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option disabled selected>Select Sub-Category</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Type:</label>
                                            <select name="type" id="type" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option disabled selected>product type</option>
                                                <option value="veg">Veg</option>
                                                <option value="non_veg">Non Veg</option>

                                            </select>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Addons:</label>
                                            <select id="choices-multiple-remove-button" name="addons[]"
                                                class="selectpicker form-control rounded-pill" multiple>
                                                @foreach ($addon as $on)
                                                    <option value="{{ $on->id }}">{{ $on->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Weight</label>
                                            <input type="number" class="form-control" name="weight_per_piece"
                                                id="weight" placeholder="Per Item in gram ">
                                        </div> --}}

                                        {{-- <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Quantity:</label>
                                            <input type="number" id="quantity" class="form-control" name="quantity"
                                                placeholder="Quantity">
                                        </div> --}}
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Avg Cooking Time:</label>
                                            <input type="text" class="form-control" name="cooking_time"
                                                id="cooking_time" placeholder="Avg Cooking Time" maxlength="8">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Select Size:</label>
                                            <select name="size" id="size" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option disabled selected>product size</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Large">Large</option>
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
                                            {{-- attention:  --}}

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="instaurl">Cost Price:</label>
                                            <input type="number" class="form-control" name="cost_price" id="cost_price"
                                                placeholder="Cost Price">

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1">Sell Price</label>
                                            <input type="number" class="form-control" name="sell_price" id="sell_price"
                                                placeholder="Sell Price">
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label class="form-label">Discount Type:</label>
                                            <select name="discount_type" id="discount_type"
                                                class="selectpicker form-control" data-style="py-0">
                                                <option disabled >Discount type</option>
                                                <option value="percent" selected>Percent(%)</option>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="discount">Discount </label>
                                            <input type="number" class="form-control" name="discount" id="discount"
                                                placeholder="0">
                                             {{-- <span class="preview_discount" >0.00</span> --}}
                                        </div>

                                        {{-- attention:  --}}
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="discount"><strong>Final Price</strong></label>
                                            <input type="text" class="form-control" name="final_price" readonly
                                                id="final_price" placeholder="0">

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
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
{{-- // for stopping user to enter more than 100% --}}
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


    });
});
</script>

{{-- for stoping user to entering -ve no  --}}
<script>
    $(document).ready(function() {
      $('#sell_price,#cost_price,#discount,#quantity,#weight').on('input', function() {
        var value = parseFloat($(this).val());
        if (isNaN(value) || value < 0) {
          $(this).val('');
        }
      });
    });
  </script>
{{-- script for adding final price to restaurent product  --}}

<script>
    $('#discount,#sell_price,#discount_type').on('keyup', function(e) {

        var sp = $('#sell_price').val();
        $('#final_price').val(sp);
        var discount = $('#discount').val();
        var dis_type = $('#discount_type').find(":selected").val();

        if (dis_type == "percent") {
            var final = sp * discount / 100;

            f_final = sp - final;
            $('#final_price').val(f_final.toFixed(2));
            return false;
        }
        if (dis_type == "amount") {
            var per = sp - discount;
            $('#final_price').val(per.toFixed(2));
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
            $('#final_price').val(f_final);
            return false;
        }
        if (dis_type == "amount") {
            var per = sp - discount;
            $('#final_price').val(per);
            return false;
        }
    });
</script>

{{-- end  --}}







<script>
    $(document).ready(function() {
        $("body").on("click", "#action-icon", function(evt) {
        var fileUpload = $("#images");
        if (parseInt(fileUpload.get(0).files.length)>4){
            $('#error_product_galary').slideUp("slow");
            $('button:submit').attr('disabled',false);

        } else {
            $('#error_product_galary').slideDown("slow");
            $('button:submit').attr('disabled',true);
        }
        if (parseInt(fileUpload.get(0).files.length) == 1) {
            $('#image_preview').css('display', 'none');

        }

        });
    });
</script>

<script>
var fl = document.getElementById('product_thumnail');
fl.onchange = function(e){
    var ext = this.value.match(/\.(.+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'tif':
            break;
        default:
            this.value='';
    }
};
</script>
<script>
    var uploadImg = document.getElementById('images');
    uploadImg.onchange = function(e){
    for (var i = 0; i < uploadImg.files.length; i++) {
       var f = uploadImg.files[i];
    var ext = f.name.match(/\.(.+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':
            break;
        default:
            this.value='';
    }
    }
}
</script>
<script>
    $('#discount,#sell_price').on('keyup',function(e){

var sp = $('#sell_price').val();
var discount = $('#discount').val();

var dis_type = $('#discount_type').find(":selected").val();
if(dis_type == "percent"){
   var final=sp*discount/100;
    $('.preview_discount').text('$'+final.toFixed(2));
   return false;
}
if(dis_type == "amount"){
  var per=discount*100/sp;
  $('.preview_discount').text(per.toFixed(2)+'%');
  return false;
}

});

//   edit total amount js
$(document).ready(function() {
var sp = $('#sell_price').val();
var discount = $('#discount').val();

var dis_type = $('#discount_type').find(":selected").val();
if(dis_type == "percent"){
   var final=sp*discount/100;
    $('.preview_discount').text('$'+final.toFixed(2));
   return false;
}
if(dis_type == "amount"){
  var per=discount*100/sp;
  $('.preview_discount').text(per.toFixed(2)+'%');
  return false;
}
})
</script>
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
    $("#images").change(function (e) {
        var $fileUpload = $("#images");
        if (parseInt($fileUpload.get(0).files.length)>3){
            $('#error_product_galary').slideUp("slow");
            $('button:submit').attr('disabled',false);

        } else {
            $('button:submit').attr('disabled',true);
        }
        if (parseInt($fileUpload.get(0).files.length)>0){
            $('#image_preview').css('display', '');
        }
    });
</script>
<script>
    $('#cooking_time').on('input', function (event) {
        this.value = this.value.replace(/[^0-9,:]/g, '');
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


        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,

            });


        });
    </script>

    <script>

        //   Category Dropdown Change Event
        $('#category-dropdown').on('change', function() {
            var catId = this.value;
            // $("#state-dropdown").html('');
            $.ajax({
                url: "{{ route('fetchSubCat') }}",
                type: "GET",
                data: {
                    catId: catId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#subcategory-dropdown').html('<option value="" disabled selected>Select Sub-Category</option>');
                    $.each(result.subcat, function(key, value) {
                        $("#subcategory-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });
    </script>
    {{-- attention:   --}}
{{-- <script>

     $('#discount,#sell_price').keyup(function(){


      var sp = $('#sell_price').val();
      var discount = $('#discount').val();

      var dis_type = $('#discount_type').find(":selected").val();
      if(dis_type == "percent"){
         var final=sp*discount/100;
          $('.preview_discount').text('$'+final.toFixed(2));
         return false;
      }
      if(dis_type == "amount"){
        var per=discount*100/sp;
        $('.preview_discount').text(per.toFixed(2)+'%');
        return false;
      }

    });


</script> --}}


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
