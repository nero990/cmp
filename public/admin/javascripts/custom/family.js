$(document).ready(function () {
    $('#family').validate({
        rules : {
            name : {
                required: true,
                minlength: 2
            },
            address : {
                required: true,
                minlength: 5
            },
            streets : {
                required: true
            }
        },
        messages : {
            name : {
                required: "Please enter BCC zone name",
                minlength: "Name must contain at least 2 characters"
            },
            address : {
                required: "Please enter BCC zone address",
                minlength: "Address must contain at least 5 characters"
            },
            streets : {
                required: 'Add at least one street'
            }
        },
        submitHandler : function (form) {
            if($(form).find('input').first().val() === "PUT") put($(form).attr('action'), $(form).serialize());
            else post($(form).attr('action'), $(form).serialize());
        }
    });


    $('.family-type').click(function () {
        console.log($(this).val());

        if($(this).val() === '1') {
            $('#childrenBlock').show();
        }else {
            $('#childrenBlock').hide();
        }
    });
});