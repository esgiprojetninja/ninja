// Show or hide main menu
$(document).on("click", function (e) {
    e.stopPropagation();
    // TODO: USE JQUERY UI FOR EFFECT() IF POSSIBLE
    if (!$(e.target).parent().children(".dropdown-menu").length) {
        $(".dropdown-menu").hide();
    } else {
        $(e.target).parent().children(".dropdown-menu").toggle();
    }
});

// $(".popover-trigger").on("click", function (e) {
//     $(this).children(".popover-top").toggleClass("active");
// });

$(function ($) {
    $(".news-box .content").each(function() {
        var text = $(this).text().substring(0, 200);
        text += " ...";
        $(this).text(text);
    });
}, jQuery);