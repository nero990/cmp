$(document).ready(function () {
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
            put($(form).attr('action'), $(form).serialize());
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