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

/**********************
    -- AJAX FORMS --
**********************/

$(function ($) {
    $(".ajax-form").submit(function (ev) {
        ev.preventDefault();
        var action = $(this).attr("action");
        var method = $(this).attr("method");
        var success = $(this).data("success");
        var data = {};
        if(typeof success == "undefined") {
            success = "Data updated !";
        }
        $.each($(this).find("input, select, textarea"), function () {
            if ($(this).attr("type") == "checkbox" || $(this).attr("type") == "radio") {
                if ($(this).is(":checked")) {
                    data[$(this).attr("name")] = $(this).val();
                }
            } else {
                if ($(this).val().length > 0) {
                    data[$(this).attr("name")] = $(this).val();
                }
            }

        });
        if (!$.isEmptyObject(data)) {
            $.ajax({
                method: method,
                url: action,
                data: data
            }).success(function (msg) {
                showMessage(success);
            }).fail(function (jqXHR, textStatus) {
                console.warning("Request failed" + textStatus);
            });
        }
    });
});

/***************************
    -- Message box --
****************************/

function showMessage(msg) {
    console.debug(msg);
}
