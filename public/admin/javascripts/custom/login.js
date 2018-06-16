$(document).ready(function () {
    $('#loginForm').validate({
        rules : {
            username : {
                required: true
            },
            password : {
                required: true
            }
        },

        messages : {
            username : {
                required: "Username is required."
            },
            password : {
                required: "Password is required."
            }
        },

        submitHandler: function (form) {
            post($(form).attr('action'), $(form).serialize());
        }
    });
});