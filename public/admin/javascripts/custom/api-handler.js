baseUrl = $('meta[name="base-url"]').attr('content');

function post(url, data, dontReload) {
    return apiCall(settings(url, 'POST', data), dontReload);
}

function put(url, data, dontReload) {
    return apiCall(settings(url, 'PUT', data), dontReload);
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
            loader('on');
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

function apiCall(params, dontReload) {
    var successCallBack = ajaxSuccess;
    if(dontReload === true)
        successCallBack = ajaxSuccessWithoutLoader;

    $.ajax(params).then(successCallBack, ajaxError)
}

var ajaxSuccessWithoutLoader = function (result, status, xhr) {
    loader('off');
    var message = '<div class="alert alert-success alert-important">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>' +
        result.message + '</div>';
    $('#message').html(message);

};

var ajaxSuccess = function (result, status, xhr) {
    loader('off');
    var message = '<div class="alert alert-success alert-important">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>' +
        result.message + '</div>';
    $('#message').html(message);

    setTimeout(function () {
        location.reload();
    }, 3000)

};

var ajaxError = function (xhr, status, error) {
    loader('off');

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