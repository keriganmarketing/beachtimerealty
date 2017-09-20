window.jQuery = window.$ = require('jquery');

import tether from 'tether';

global.Tether = tether;

require('bootstrap');
require('select2');
$.fn.select2.defaults.set("theme", "bootstrap");

//for sticky header
function sizeHeader() {

    var scroll = $(window).scrollTop();
    if (scroll > 10) {
        $('.sticky-header').addClass('smaller');
    } else {
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
    if (app > win) {
        $(".sticky-footer").addClass('unstuck');
    }

    sizeHeader();

});

//Select2
$(document).ready(function (event) {

    var omniBox;
    $.getJSON("http://mls.kerigan.com/api/buildomni", function(json){
        omniBox = $.map(json, function(el) { return el });

        $('.select2-omni-field').select2({
            placeholder: 'City, area, subdivision or zip',
            data: omniBox
        });

    });

    $('.select2-property-type').select2({
        placeholder: 'Property type'
    });
    $('.select2-price-min').select2({
        placeholder: 'Min price'
    });
    $('.select2-price-max').select2({
        placeholder: 'Max price'
    });

    $('.select2-price-min').on('select2:select', function (e) {
        var maxVal = $('.select2-price-min').val();
        console.log (maxVal);
        if(maxVal < 1000000){
            maxVal = +maxVal + +100000;
        }else{
            maxVal = +maxVal + +1000000;
        }
        $('.select2-price-max').val(maxVal).trigger("change");
    });

    $('.select2-price-max').on('select2:select', function (e) {
        var maxVal = $('.select2-price-max').val();
        console.log (maxVal);
        if(maxVal < 2000000){
            maxVal = +maxVal - +100000;
        }else{
            maxVal = +maxVal - +1000000;
        }
        $('.select2-price-min').val(maxVal).trigger("change");
    });

});
