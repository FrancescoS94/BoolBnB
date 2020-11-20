require('./bootstrap');
var $ = require( "jquery" );

$(document).ready(function(){

// in home: scorrere le liste con le freccette

    $('i.right').click(function(){
        var elemDaScrollare = $(this).siblings('.lista');
        var currentPosition = elemDaScrollare.scrollLeft();
        currentPosition += 350;
        elemDaScrollare.scrollLeft(currentPosition);
    });

    $('i.left').click(function(){
        var elemDaScrollare = $(this).siblings('.lista');
        var currentPosition = elemDaScrollare.scrollLeft();
        currentPosition -= 350;
        elemDaScrollare.scrollLeft(currentPosition);
    });

});