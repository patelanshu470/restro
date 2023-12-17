jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: restaurantlistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d){
                    d.restaurant_name = $('#restaurant_name').val(),
                    d.status = $('#status').val()
                }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'restaurant_name', name: 'restaurant_name'},
                    {data: 'restro_contact_number', name: 'restro_contact_number'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {

                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
        });
        $('#restaurant_name').keyup(function() {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
    }
    jQuery(document).on('change', '.status', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var restaurant_id = $(this).data('id');

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: restaurantstatus,
            data: {'status': status, 'restaurant_id': restaurant_id},
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
jQuery.validator.addMethod("email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");

jQuery.validator.addMethod("password", function(value, element) {
    if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");
$('#validation').validate({
    rules: {
        restro_image: {
            required: true
        },
        cover_image: {
            required: true
        },
        logo_image: {
            required: true
        },
        // "gallary[]": {
        //     required: true,
        // },
        restaurant_name: {
          required: true
        },
        restro_contact_number: {
            required: true,
        },
        street: {
            required: true
        },
        landmark: {
            required: true
        },
        country: {
            required: true
        },
        state: {
            required: true
        },
        city: {
            required: true
        },
        pincode: {
            required: true,
        },
        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        manager_number: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            password: true
        },
        confirm_password: {
            required: true,
            equalTo: "#pass",
        },
        status: {
            required: true
        },
    },
    messages: {
        restro_image: {
            required: "This Restaurant Image field is required",
        },
        cover_image: {
            required: "This Cover Image field is required",
        },
        logo_image: {
            required: "This Logo Image field is required",
        },
        restaurant_name: {
            required: "This Restaurant Name field is required",
        },
        restro_contact_number: {
            required: "This Countact Number field is required",
            number: "Please enter only number"
        },
        street: {
            required: "This street field is required",
        },
        landmark: {
            required: "This landmark field is required",
        },
        country: {
            required: "This country field is required",
        },
        state: {
            required: "This state field is required",
        },
        city: {
            required: "This city field is required",
        },
        pincode: {
            required: "This pincode field is required",
            number: "Please enter only number"
        },
        first_name: {
            required: "This first name field is required",
        },
        last_name: {
            required: "This last name field is required",
        },
        manager_number: {
            required: "This manager number field is required",
            number: "Please enter only number"
        },
        email: {
            required: "This email field is required",
        },
        password: {
            required: "This password field is required",
        },
        confirm_password: {
            required: "This confirm password field is required",
            equalTo: "Please enter the same value of Password"
        },
        status: {
            required: "This status field is required",
        },
        // "gallary[]": {
        //     required: "This gallary field is required",
        // },

    },
    submitHandler: function(form) {
        form.submit();
    }
});

$('#edit_validation').validate({
    rules: {
        restro_image: {
            required: true
        },
        cover_image: {
            required: true
        },
        logo_image: {
            required: true
        },
        restaurant_name: {
          required: true
        },
        restro_contact_number: {
            required: true,
        },
        street: {
            required: true
        },
        landmark: {
            required: true
        },
        country: {
            required: true,
        },
        state: {
            required: true,
        },
        city: {
            required: true,
        },
        pincode: {
            required: true,
        },
        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        manager_number: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true
        },
        confirm_password: {
            required: true,
            equalTo: "#pass",
        },
        status: {
            required: true
        },
    },
    messages: {
        restro_image: {
            required: "This Restaurant Image field is required",
        },
        cover_image: {
            required: "This Cover Image field is required",
        },
        logo_image: {
            required: "This Logo Image field is required",
        },
        restaurant_name: {
            required: "This Restaurant Name field is required",
        },
        restro_contact_number: {
            required: "This Countact Number field is required",
            number: "Please enter only number"
        },
        street: {
            required: "This street field is required",
        },
        landmark: {
            required: "This landmark field is required",
        },
        country: {
            required: "This country field is required",
        },
        state: {
            required: "This state field is required",
        },
        city: {
            required: "This city field is required",
        },
        pincode: {
            required: "This pincode field is required",
            number: "Please enter only number"
        },
        first_name: {
            required: "This first name field is required",
        },
        last_name: {
            required: "This last name field is required",
        },
        manager_number: {
            required: "This manager number field is required",
            number: "Please enter only number"
        },
        email: {
            required: "This email field is required",
        },
        password: {
            required: "This password field is required",
        },
        confirm_password: {
            required: "This confirm password field is required",
            equalTo: "Please enter the same value of Password"
        },
        status: {
            required: "This status field is required",
        },

    },
    submitHandler: function(form) {
        form.submit();
    }
});
// Gallary...
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
// Gallary Validation...
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
    if(numItems <= 0){
      $('#img-preview').addClass('img-thumbs-hidden');
    }
     $(this).parent('.wrapper-thumb').remove();
   });
 }
}

