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
    // console.log($().serializeObject());

    $('.disabledForm :input').prop('disabled', true);

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
        $("#page-wrapper").addClass('disabled-screen');
        $(".login2").addClass('disabled-screen');
    } else {
        $('.loader-img').hide();
        $(".login2").removeClass('disabled-screen');
    }
}