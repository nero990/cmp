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
            }
        }
    });
});