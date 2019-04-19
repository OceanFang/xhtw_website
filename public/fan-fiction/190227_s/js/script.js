$(function() {

    $(".r18").click(function() {
        alert("以下是18禁的內容，確定已滿規定之年齡");
    });

    $(".picbtn .btn").hover(function() {
        $(this).find(".vote").addClass("hover");
    }, function() {
        $(this).find(".vote").removeClass("hover");
    });

    $(".btngroup2 .btn").hover(function() {
        $(this).find(".vote, .fb").addClass("hover");
    }, function() {
        $(this).find(".vote, .fb").removeClass("hover");
    });


    $(".btn").hover(function() {
        $(this).children("a").css({ "background": "#fff", "color": "#e34858" });
    }, function() {
        if ($(this).hasClass("active")) {
            $(this).children("a").css({ "background": "#fff", "color": "#e34858" });
        } else {
            $(this).children("a").css({ "background": "#e34858", "color": "#fff" });
        }
    });


});