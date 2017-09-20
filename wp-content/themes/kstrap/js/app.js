window.jQuery = window.$ = require('jquery');

import tether from 'tether';
global.Tether = tether;

require('bootstrap');
require('select2');
$.fn.select2.defaults.set("theme", "bootstrap");

//for sticky header
function sizeHeader() {
    var scroll = $(window).scrollTop();
    if(scroll > 10) {
        $('.sticky-header').addClass('smaller');
    }else{
        $('.sticky-header').removeClass('smaller');
    }
}

$(window).scroll(function (event) {
    sizeHeader();
});

//for sticky footer
$(document).ready(function (event) {
    var app = $('#app').height();
    var win = $(window).height();

    console.log(app);
    console.log(win);
    if (app > win ) {
        $(".sticky-footer").addClass('unstuck');
    }

    sizeHeader();

});

//Select2
$(document).ready(function (event) {
    $('.select2').select2();
});