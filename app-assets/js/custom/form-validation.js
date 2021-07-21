//Login Validation
$("#loginForm").validate({
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        },
    },
    //For custom messages
    messages: {
        username: {
            required: "Username is required",
        },
        password: {
            required: "Password is required"
        }
    },
    errorElement: 'div',
    errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error)
        } else {
            error.insertAfter(element);
        }
    }
});