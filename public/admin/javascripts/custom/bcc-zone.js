$(document).ready(function () {
    $('#bccZoneForm').validate({
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
            if($(form).find('input').first().val() === "PUT") put($(form).attr('action'), $(form).serialize(), ajaxSuccess);
            else post($(form).attr('action'), $(form).serialize(), ajaxSuccess, ajaxError);
        }
    });

    var ajaxSuccess = function (result, status, xhr) {
        sweetAlert(result.title, result.message, "success", false, result.button_text, result.urlc);
    };

});