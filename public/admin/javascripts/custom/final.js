$(document).ready(function () {

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