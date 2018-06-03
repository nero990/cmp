baseUrl = $('meta[name="base-url"]').attr('content');

function post(url, data) {
    return apiCall(settings(url, 'POST', data));
}

function put(url, data) {
    return apiCall(settings(url, 'PUT', data));
}

function get(url) {
    return apiCall(settings(url, 'GET'));
}

function destroy(url) {
    return apiCall(settings(url, 'DELETE'));
}

function settings(url, method, data) {
    if(data === undefined) data = [];

    return {
        /*contentType: 'application/json',*/
        headers: {
            'Accept': 'application/json'
        },
        url: getUrl(url),
        type: method,
        data: data,
        beforeSend: function () {
            spinner('on');
        }
    };
}

function spinner(v) {
    if(v === 'on'){
        $('body').addClass('no-scroll');
        $('.loader').show();
    } else {
        $('body').removeClass('no-scroll');
        $('.loader').hide();
    }
}

function getUrl(url) {
    if (!url.includes('http')) {
        url = baseUrl + '/' + url;
    }
    return url;
}

function apiCall(params) {
    $.ajax(params).then(ajaxSuccess, ajaxError)
}

var ajaxSuccess = function (result, status, xhr) {
    spinner('off');
    var message = '<div class="alert alert-success alert-important">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>' +
        result.message + '</div>';
    $('#message').html(message);

    setTimeout(function () {
        location.reload();
    }, 5000)

};

var ajaxError = function (xhr, status, error) {
    spinner('off');

    var errorsHtml = '<div class="alert alert-danger alert-important">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>';

    if(xhr.status === 422) {
        var errorObject = xhr.responseJSON;

        $.each(errorObject.errors, function (key, value) {
            errorsHtml += "<p>" + value[0] + "</p>";
        });

    } else if(xhr.status === 400) {
        errorsHtml += "<p>" + xhr  + "</p>"
    } else {
        errorsHtml += "<p>" + xhr.statusText  + "</p>"
    }
    errorsHtml += "</div>";

    $('#message').html(errorsHtml);
};

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});