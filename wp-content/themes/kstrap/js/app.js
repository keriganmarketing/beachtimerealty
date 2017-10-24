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
    if (app < win) {
        $(".sticky-footer").addClass('stuck');
    }

    console.log(app);
    console.log(win);

    sizeHeader();

});

//Select2
$(document).ready(function (event) {

    $('.select2-omni-field').select2({
        placeholder: 'City, area, subdivision or zip',
        ajax: {
            url: 'http://mothership.kerigan.com/api/v1/omnibar',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public'
                }
                return query;
            }
        },
        "language": {
            "noResults": function(){
                return "No Results Found <a href='#' class='btn btn-danger'>Use it anyway</a>";
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 3,
        dropdownParent: $('.search-control')
    });

    $('.select2-property-type').select2({
        placeholder: 'Property type',
        dropdownParent: $('.search-control')
    });
    $('.select2-price-min').select2({
        placeholder: 'Min price',
        dropdownParent: $('.search-control')
    });
    $('.select2-price-max').select2({
        placeholder: 'Max price',
        dropdownParent: $('.search-control')
    });
    $('.select2-generic').select2({
        placeholder: 'Any',
        dropdownParent: $('.search-control')
    });

    $('.select2-price-min').on('select2:select', function (e) {
        var minVal = $('.select2-price-min').val();
        var maxVal = $('.select2-price-max').val();
        console.log('min:' + minVal);
        console.log('max:' + maxVal);

        if (maxVal === undefined || +minVal >= +maxVal) {
            if(minVal <= 900000){
                maxVal = +minVal + +100000
            }else{
                maxVal = +minVal + +1000000
            }
            $('.select2-price-max').val(maxVal).trigger("change");
        }
        console.log('min:' + minVal);
        console.log('max:' + maxVal);
    });

    $('.select2-price-max').on('select2:select', function (e) {
        var minVal = $('.select2-price-min').val();
        var maxVal = $('.select2-price-max').val();
        console.log('min:' + minVal);
        console.log('max:' + maxVal);

        if (minVal === undefined ||  +minVal >= +maxVal) {
            if(maxVal <= 1000000){
                minVal = +maxVal - +100000
            }else{
                minVal = +maxVal - +1000000
            }
            $('.select2-price-min').val(minVal).trigger("change");
        }
        console.log('min:' + minVal);
        console.log('max:' + maxVal);
    });


    //listings
    var $lightbox = $('#lightbox');

    $('#myCarousel').carousel({
        interval: false,
        ride: false
    });

    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'),
            //src = $img.attr('src'),
            target = $img.attr('data-slide-to'),
            css = {
                //'width': '100%',
                //'maxWidth': $(window).width() - 0,
                //'maxHeight': $(window).height() - 0

                'width': '1200px',
                'maxWidth': '100%',
                //'maxHeight': $(window).height() - 0
            };

        $lightbox.find('.close').addClass('hidden');
        //$lightbox.find('img').attr('src', src);
        //$lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);

        console.log(target);
        $('#myCarousel').carousel(Number(target));

    });

});
