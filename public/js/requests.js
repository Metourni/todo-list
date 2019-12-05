'use strict';

function sendRequest(token, data, url, method) {
    return $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: method,
        url: url,
        dataType: 'json',
        data: data,
        contentType: false,
        processData: false
    });
}


function sendRequestHtml(token, data, url, method, beforeSend = () => {}) {
    return $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        type: method,
        url: url,
        dataType: 'html',
        beforeSend: beforeSend,
        data: data,
        contentType: false,
        processData: false
    });
}
