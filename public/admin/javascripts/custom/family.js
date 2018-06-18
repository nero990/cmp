$(document).ready(function () {
    $('#familyCreate').validate({
        rules : {
            name : {
                required: true,
                minlength: 2
            },
            type : {
                required: true
            },
            first_name : {
                required: true,
                minlength: 2
            },
            middle_name : {
                minlength: 2
            },
            last_name : {
                required: true,
                minlength: 2
            },
            email : {
                email: true
            }

        },
        messages : {
            name : {
                required: "Enter family name.",
                minlength: "Family name must contain at least 2 characters."
            },
            type : {
                required: "Select a family type."
            },
            email : {
                email: "Invalid email provided."
            },
            first_name : {
                required: "Enter first name.",
                minlength: "First name must be at least 2 characters long."
            },
            middle_name : {
                minlength: "Middle name must be at least 2 characters long."
            },
            last_name : {
                required: "Enter last name.",
                minlength: "Last name must be at least 2 characters long."
            }
        },
        submitHandler : function (form) {
            post($(form).attr('action'), $(form).serialize(), true);
        }
    });

    $('#familyUpdate').validate({
        rules : {
            name : {
                required: true,
                minlength: 2
            },
            type : {
                required: true
            }

        },
        messages : {
            name : {
                required: "Please provide family name",
                minlength: "Family name must contain at least 2 characters"
            },
            type : {
                required: "Please select a family type"
            }
        },
        submitHandler : function (form) {
            put($(form).attr('action'), $(form).serialize(), true);
        }
    });


    $('.family-type').click(function () {

        if($(this).val() === '1') {
            $('#childrenBlock').show();
        }else {
            $('#childrenBlock').hide();
        }
    });
});