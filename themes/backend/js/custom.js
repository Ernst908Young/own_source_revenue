$(function() {
    //===== Accordion =====//		

    $('div.menu_body:eq(0)').show();
    $('.acc .title:eq(0)').show().css({color: "#2B6893"});

    $(".acc .title").click(function() {
        $(this).css({color: "#2B6893"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
        $(this).siblings().css({color: "#404040"});
    });


});