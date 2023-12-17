$('#validation').validate({
rules: {
    old_password: {
        required: true,
        required: true,
    },
    new_password: {
        required: true,
        required: true,
        minlength: 8,
    },
    confirm_password: {
        required: true,
        minlength: 8,
        equalTo: "#new_password",
    },
},
messages: {
    old_password: {
        required: "Enter old Password password",
    },
    new_password: {
        required: "Enter new password",
        minlength: "Enter at least 8 characters",
    },
    confirm_password: {
        required: "Please confirm new password",
        minlength: "Enter at least 8 characters",
        equalTo: "The password and its confirm are not the same",
    },
},
});
