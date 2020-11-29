require('./bootstrap');
var $ = require( "jquery" );

$(document).ready(function(){
    
    // in home: scorrere le liste con le freccette

    $('i.right').click(function(){
        var elemDaScrollare = $(this).siblings('.lista');
        var currentPosition = elemDaScrollare.scrollLeft();
        currentPosition += 290;
        elemDaScrollare.scrollLeft(currentPosition);
    });

    $('i.left').click(function(){
        var elemDaScrollare = $(this).siblings('.lista');
        var currentPosition = elemDaScrollare.scrollLeft();
        currentPosition -= 290;
        elemDaScrollare.scrollLeft(currentPosition);
    });

    // in home: al click sull'icona si scrolla di 100vh e l'icona ruota
    
    var icon = $('i.rotate');
    var vheight = $(window).height();
    var vheight = vheight - 70;
    
    $('i.rotate').click(function() {
        $(this).addClass("down");
        $('html, body').animate({
            scrollTop: (Math.floor($(window).scrollTop() / vheight)+1) * vheight
        }, 1000); 
    });
    
    window.onscroll = function() {
        var scrollToTop = $(document).scrollTop();
        if (icon.hasClass("down") && scrollToTop == vheight){ //587
            $('i.rotate').removeClass("down");
        }
    }
});
