$(document).ready(function(){
    $(".page-content")
    .hide()
    .first()
    .show();
});
$(".category-button").click(function() {
    $(".category-button").removeClass("active");
    $(".category-button").removeClass("text-primary");
    $(this).addClass("active");
    $(this).addClass("text-primary");
});
// Makes variables for button and page content
var $categoryButton = $(".category-button");
var $pageContent = $(".page-content");

// Hide all page content shows first one
$(".page-content")
    .hide()
    // .second()
    .show();
// When button is clicked, show content
$categoryButton.on("click", function(e) {
    var $category = $(this).data("target");
    $pageContent
        .hide()
        .find('img').hide()
        .end()
        .filter("." + $category)
        .show()
        .find('img').fadeIn();
});

jQuery.validator.addMethod("password", function(value, element) {
    if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");

$('#password_change').validate({
    rules: {
        old_password: {
            required: true,
            required: true,
            password: true,
        },
        new_password: {
            required: true,
            required: true,
            minlength: 8,
            password: true,
        },
        confirm_password: {
            required: true,
            minlength: 8,
            equalTo: "#new_password",
        },
    },
    messages: {
        old_password: {
            required: "This old Password field is required",
        },
        new_password: {
            required: "This new password field is required",
            minlength: "Enter at least 8 characters",
        },
        confirm_password: {
            required: "This confirm password field is required",
            minlength: "Enter at least 8 characters",
            equalTo: "The password and its confirm are not the same",
        },
    },
});

$('#add_address').validate({
    rules: {
        street: {
            required: true,
        },
        landmark: {
            required: true,
        },
        pincode: {
            required: true,
        },
        country: {
            required: true,
        },
        state: {
            required: true,
        },
        city: {
            required: true,
        }
    },
    messages: {
        street: {
            required: "This street field is required",
        },
        landmark: {
            required: "This landmark field is required",
        },
        pincode: {
            required: "This pincode field is required",
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
    },
});

jQuery(document).on('change', 'input[name="default_address_chk"]', function() {
    // alert('f');
    var status = $(this).prop('checked') == true ? 1 : 0;
    var address_id = $(this).data('id');
    // alert(user_id);
    toastr.options = {
      "closeButton": true,
      "newestOnTop": true,
      "positionClass": "toast-top-right"
    };

    $.ajax({
        type: "GET",
        dataType: "json",
        url: updatedefaultaddress,
        data: {'status': status, 'address_id': address_id},
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

jQuery.validator.addMethod("email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");
$('#edit_profile').validate({
    rules: {
        first_name: {
            required: true,
        },
        last_name: {
            required: true,
        },
        phone_number: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
    },
    messages: {
        first_name: {
            required: "This first name field is required",
        },
        last_name: {
            required: "This last name field is required",
        },
        phone_number: {
            required: "This phone number field is required",
        },
        email: {
            required: "This email field is required",
        },
    },
});


$('#ProductReview').validate({
    rules: {
    star: {
        required: true,
        required: true,
    },
    description: {
        required: true,
        required: true,
    },
    attach: {
        required: true,
    }
},
messages: {
    star: {
        required: "This Star field is required",
    },
    description: {
        required: "This field is required",
    },
    attach: {
        required: "This field is required",
    }
},
});
