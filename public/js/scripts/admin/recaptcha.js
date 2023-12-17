$("#add_recaptcha").validate({
    rules: {
        site_key: {
            required: true,
        },
        secret_key: {
            required: true,
        },
    },
    messages: {
        site_key: {
            required: "This Site Key field is required",
        },
        secret_key: {
            required: "This Secrete Key field is required",
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
});


