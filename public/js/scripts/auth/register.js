$('#validation').validate({
    rules: {
        first_name: {
          required: true
      },
      last_name: {
        required: true
     },
     email: {
        required: true
     },
     phone_number: {
        required: true
     },
     password: {
        required: true
     },
     confirm_password: {
        required: true,
        equalTo: '#password'
     },

    },
    messages: {
      first_name: {
          required: "This first name field is required",
      },
      last_name: {
        required: "This last name field is required",
      },
      email: {
        required: "This email field is required",
      },
      phone_number: {
        required: "This phone number field is required",
      },
      password: {
        required: "This password field is required",
      },
      confirm_password: {
        required: "This confirm password field is required",
      },

    }
})
