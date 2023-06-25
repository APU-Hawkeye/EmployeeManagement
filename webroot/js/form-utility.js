$(function(){
    $('form[data-submit="disable"]').submit(function(){
        $(this).find(".ui.dimmer").addClass("active");
    });
});
