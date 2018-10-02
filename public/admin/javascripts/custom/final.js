
$(document).ready(function () {
    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            var name = this.name.replace('[]', '');
            if (o[name] !== undefined) {
                if (!o[name].push) {
                    o[name] = [o[name]];
                }
                if(name.indexOf('[]' >= 0))
                    o[name].push(this.value || '');
            } else {
                o[name] = this.value || '';
            }
        });
        return o;
    };
    // console.log($().serializeObject());php

    $('.disabledForm :input').prop('disabled', true)


    $('#downloadCsv').click(function () {
        let encodedUri = encodeURI("data:text/csv;charset=utf-8," + $(this).attr("data-content"));
        window.open(encodedUri);
        return false;
    });

});

function duplicate() {
    var origin = document.getElementById('origin');
    var clone = origin.cloneNode(true); // "deep" clone
    clone.id = ""; // there can only be one element with an ID
    origin.parentNode.appendChild(clone);
}

function remove() {
    var origin = document.getElementById('origin');
    var clone = origin.parentNode.lastChild;
    if(clone !== origin) clone.remove();
}

function loader(mode) {
    if(mode === 'on'){
        $('.loader-img').show();
        $("body").addClass('disabled-screen');
    } else {
        $('.loader-img').hide();
        $("body").removeClass('disabled-screen');
    }
}

function outputMessage(message) {
    loader('off');

    message = '<div class="alert alert-success alert-important">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>' +
        message + '</div>';
    $('#message').html(message);
}

function sweetAlert(title, text, icon, timer = false, buttonText, url) {
    loader('off');

    if(icon === "success") $("#message").hide();

    swal({
        title: title,
        text: text,
        icon: icon,
        timer: timer,
        showCancelButton: (typeof buttonText !== 'undefined')
    }).then(
    function(){
        if (typeof url !== 'undefined') window.location.href = url;
    });
}


