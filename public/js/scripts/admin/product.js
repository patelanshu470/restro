jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: projectlistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d){
                    d.restaurant_id = $('#restaurant_id').val()
                    d.category = $('#category').val()
                    d.type = $('#type').val()
                    d.status = $('#status').val()
                    // d.name = $('#name').val()
                }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'product_category', name: 'product_category'},
                    {data: 'restaurent_id', name: 'restaurent_id'},
                    {data: 'sell_price', name: 'sell_price'},
                    {data: 'status', name: 'status'},
                    {

                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
        });
        $("#restaurant_id").change(function () {
            Ot.draw();
        });
        $("#category").click(function () {
            Ot.draw();
        });
        $("#type").click(function () {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
        // $("#name").keyup(function () {
        //     Ot.draw();
        // });
    }
    jQuery(document).on('change', '.status', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var product_id = $(this).data('id');

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: productstatus,
            data: {'status': status, 'product_id': product_id},
            success: function(data){
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            }
        });
    });
});
$.validator.addMethod('time', function(value, element, param) {
    return value == '' || value.match(/^([01][0-2]):([01][0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-0]):([01][0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-0])$/);
}, 'Enter a valid time: hh:mm:ss');

$("#product_add_create").validate({
    rules: {
        name: {
            required: true,
        },
        cost_price: {
            required: true,
            number: true,
        },
        sell_price: {
            required: true,
            number: true,
        },
        category: {
            required: true,
        },
        subcategory: {
            required: true,
        },
        desc: {
            required: true,
        },
        type: {
            required: true,
        },
        weight_per_piece: {
            required: true,
            number: true,
        },
        quantity: {
            required: true,
            number: true,
        },
        size: {
            required: true,
        },
        "gallary[]": {
            required: true,
        },
        product_thumnail: {
            required:true,
        },
        discount: {
            number:true,
        },
        restaurant_id: {
            required:true,
        },
        cooking_time: {
            required:true,
            time: true
        }
    },

    messages: {
        name: {
            required: "This name field is required",
        },
        cost_price: {
            required: "This cost price field is required",
        },
        sell_price: {
            required: "This sell price field is required",
        },
        category: {
            required: "This category field is required",
        },
        desc: {
            required: "This description field is required",
        },
        type: {
            required: "This type  field is required",
        },
        weight_per_piece: {
            required: "This weight field is required",
        },
        quantity: {
            required: "This quantity field is required",
        },
        size: {
            required: "This size field is required",
        },
        "gallary[]": {
            required: "This gallary field is required",
        },

        product_thumnail: {
                required: "This thumnail field is required",
        },
        restaurant_id: {
            required: "This restaurant field is required",
        },
        subcategory: {
            required: "This subcategory field is required",
        },
    },

    submitHandler: function(form) {
        form.submit();
    }
});

var imgUpload = document.getElementById('upload-img')
  , imgPreview = document.getElementById('img-preview')
  , imgUploadForm = document.getElementById('form-upload')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;
imgUpload.addEventListener('change', previewImgs, true);
function previewImgs(event) {
  totalFiles = imgUpload.files.length;
       if(!!totalFiles) {
    imgPreview.classList.remove('img-thumbs-hidden');
  }
    for(var i = 0; i < totalFiles; i++) {
    wrapper = document.createElement('div');
    wrapper.classList.add('wrapper-thumb');
    removeBtn = document.createElement("span");
    nodeRemove= document.createTextNode('x');
    removeBtn.classList.add('remove-btn');
    removeBtn.appendChild(nodeRemove);
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    wrapper.appendChild(img);
    wrapper.appendChild(removeBtn);
    imgPreview.appendChild(wrapper);
       $('.remove-btn').click(function(){
      $(this).parent('.wrapper-thumb').remove();
    });
  }

}

// for conversion

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
// edit js

// validation
$("#edit_form").validate({
    rules: {
        name: {
            required: true,
        },
        cost_price: {
            required: true,
            number:true,
        },
        sell_price: {
            required: true,
            number:true,
        },
        category: {
            required: true,
        },
        subcategory: {
            required: true,
        },
        type: {
            required: true,
        },
        weight_per_piece: {
            required: true,
            number:true,
        },
        quantity: {
            required: true,
            number:true,
        },
        size: {
            required: true,
        },
        discount: {
            number:true,
        },

    },
    messages: {
        name: {
            required: "This  field is required",
        },
        cost_price: {
            required: "This  field is required",
        },
        sell_price: {
            required: "This  field is required",
        },
        category: {
            required: "This  field is required",
        },
        type: {
            required: "This  field is required",
        },
        weight_per_piece: {
            required: "This  field is required",
        },
        quantity: {
            required: "This  field is required",
        },
        size: {
            required: "This  field is required",
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
});
// Gallary validate  //
$('#submit_btn').click(function(){
    var child = document.querySelectorAll(".img-preview-thumb");
    $check=child.length;
  if($check <= 0){
      document.getElementById("gallary_error").innerHTML ="Gallary field is required";
      document.getElementById("submit_btn").disabled = true;
  }else{
    document.getElementById("submit_btn_real").click();
  }
});


$('.gallary_input').click(function(){
    document.getElementById("gallary_error").innerHTML =" ";
    document.getElementById("submit_btn").disabled = false;
});



 var imgUpload = document.getElementById('upload-img')
 , imgPreview = document.getElementById('img-preview')
 , imgUploadForm = document.getElementById('form-upload')
 , totalFiles
 , previewTitle
 , previewTitleText
 , img;

imgUpload.addEventListener('change', previewImgs, true);

function previewImgs(event) {
 totalFiles = imgUpload.files.length;
    if(!!totalFiles) {
   imgPreview.classList.remove('img-thumbs-hidden');
   }

 for(var i = 0; i < totalFiles; i++) {
   wrapper = document.createElement('div');
   wrapper.classList.add('wrapper-thumb');
   removeBtn = document.createElement("span");
   nodeRemove= document.createTextNode('x');
   removeBtn.classList.add('remove-btn');
   removeBtn.appendChild(nodeRemove);
   img = document.createElement('img');
   img.src = URL.createObjectURL(event.target.files[i]);
   img.classList.add('img-preview-thumb');
   wrapper.appendChild(img);
   wrapper.appendChild(removeBtn);
   imgPreview.appendChild(wrapper);

   $('.remove-btn').click(function(){
    //  removeImageShowDiv();
    var numItems = $('.remove-btn').length
    if(numItems <= 1){
      $('#img-preview').addClass('img-thumbs-hidden');
    }
     $(this).parent('.wrapper-thumb').remove();
   });
 }
}

