$(document).ready(
    function() {
        $("#different_address").click(function() {
            $("#view_different_address").toggle();
        });
});

$('#checkout').validate({
    rules: {
        billing_contact_name: {
            required: true,
        },
        shipping_name: {
            required: true,
        },
        billing_contact_number: {
            required: true,
        },
        shipping_phone_number: {
            required: true,
        },
        billing_contact_email: {
            required: true,
        },
        shipping_email: {
            required: true,
        },
        billing_street: {
            required: true,
        },
        shipping_street_address: {
            required: true,
        },
        billing_landmark: {
            required: true,
        },
        shipping_landmark: {
            required: true,
        },
        billing_country: {
            required: true,
        },
        shipping_country: {
            required: true,
        },
        billing_state: {
            required: true,
        },
        shipping_state: {
            required: true,
        },
        billing_city: {
            required: true,
        },
        shipping_city: {
            required: true,
        },
        billing_pincode: {
            required: true,
        },
        shipping_pincode: {
            required: true,
        },
        payment_method: {
            required: true,
        }
    },
    messages: {
        name: {
            required: "This Name field is required",
        },
        shipping_name: {
            required: "This Name field is required",
        },
        phone_number: {
            required: "This mobile number field is required",
        },
        shipping_phone_number: {
            required: "This mobile number field is required",
        },
        email: {
            required: "This email field is required",
        },
        shipping_email: {
            required: "This email field is required",
        },
        street: {
            required: "This street field is required",
        },
        shipping_street_address: {
            required: "This street field is required",
        },
        landmark: {
            required: "This landmark field is required",
        },
        shipping_landmark: {
            required: "This landmark field is required",
        },
        pincode: {
            required: "This pincode field is required",
        },
        shipping_pincode: {
            required: "This pincode field is required",
        },
        country: {
            required: "This country field is required",
        },
        shipping_country: {
            required: "This country field is required",
        },
        state: {
            required: "This state field is required",
        },
        shipping_state: {
            required: "This state field is required",
        },
        city: {
            required: "This city field is required",
        },
        shipping_city: {
            required: "This city field is required",
        },
        payment_method: {
            required: "The payment method field is required",
        },
    },
});

$('#checkout1').validate({
    rules: {
        delivery_day: {
            required: true,
        },
        delivery_time: {
            required: true,
        },
        payment_method: {
            required: true,
        }
    },
    messages: {
        delivery_day: {
            required: "This delivery time field is required",
        },
        delivery_time: {
            required: "This time slote field is required",
        },
        payment_method: {
            required: "The payment method field is required",
        },
    },
});
