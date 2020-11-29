$(document).ready(function(){

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