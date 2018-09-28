baseUrl = $('meta[name="base-url"]').attr('content');

function post(url, data, success, error) {
    return apiCall(settings(url, 'POST', data), success, error);
}

function put(url, data, success, error) {
    return apiCall(settings(url, 'PUT', data), success, error);
}

function get(url) {
    return apiCall(settings(url, 'GET'));
}

function destroy(url, success, error) {
    return apiCall(settings(url, 'DELETE'), success, error);
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

function apiCall(params, success, error) {
    var successCallBack = ajaxSuccess;
    var errorCallBack = ajaxError;

    if(typeof success !== 'undefined')
        successCallBack = success;

    if(typeof error !== 'undefined')
        errorCallBack = error;

    $.ajax(params).then(successCallBack, errorCallBack)
}

var ajaxSuccess = function (result, status, xhr) {
    outputMessage(result.message);

    setTimeout(function () {
        location.reload();
    }, 3000)

};

var ajaxError = function (xhr, status, error) {
    loader('off');

    var errorMessage = "";

    if(xhr.status === 422) {
        $.each(xhr.responseJSON.errors, function (key, value) {
            errorMessage += value[0] + "\n";
        });

    } else if(xhr.status === 400) {
        errorMessage = xhr;
    } else {
        errorMessage = xhr.statusText;
    }

    sweetAlert("Error!", errorMessage, "error");
};

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});