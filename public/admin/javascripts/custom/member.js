$(document).ready(function () {
    $('.deceased').click(function () {

        if($(this).val() === '1') {
            $('#deceasedDate').show();
        }else {
            $('#deceasedDate').hide();
        }
    });
});