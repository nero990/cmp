$(document).ready(function () {
    $('#churchEngagement').validate({
        rules : {
            name : {
                required: true,
                minlength: 2
            }
        },
        messages : {
            name : {
                required: "Please provide an engagement name",
                minlength: "Name must contain at least 2 characters"
            }
        }
    });

    $('.edit-engagement').click(function () {
        var data = JSON.parse($(this).attr('data-value'));

        $('#modalTitle').html('Edit Church Engagement');
        $('#name').val(data.name);
        /*var form = $('#createUserForm');
        var action  = form.attr('action');
        action += '/' + data.id;*/

        // form.attr('action', action);
        // console.log(action);
    });


    $('#newEngagement').click(function () {
        $('#modalTitle').html('New Church Engagement');
        $('#name').val("");

    });
});

