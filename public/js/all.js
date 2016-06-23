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

/**************************
    -- DOCUMENT EVENTS -- 
**************************/

$(function ($) {
    // notifications
    $('div.notifications').on("click","a", function() {
        var id = $(this).data("id");
        var $a = $(this);
        $.get('/notification/delete/' + id,function(){
            $a.parent().remove();
        });
    });

    $('#popupNotifications').on("click","a", function() {
        var id = $(this).data("id");
        var $a = $(this);
        $.get('/notification/delete/' + id,function(){
            $a.parent().remove();
        });
    });



    // msg-box
    $(".js-close-msg-box").click(function (ev) {
        $(this).parent().parent().fadeOut();
    });

    $("a.kickUser").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/kick/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId, idUser: userId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });

    $("a.demoteUser").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/demote/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId, idUser: userId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });

    $("a.promoteUser").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/promote/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId, idUser: userId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });

    $("a.leaveTeam").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/leave/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });


    $("a.deleteTeam").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/delete/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });

    $("a.joinTeam").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/join/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });

    $("a.refuseInvit").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/refuseInvit/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId},
            success : function(response){
             console.debug(response);
            }
          });
      }
    });

});

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
                showMessage("Data was updated !", "success");
            }).fail(function (jqXHR, textStatus) {
                showMessage("Request failed :(", "danger");
            });
        }
    });
});

/***************************
    -- Message box --
****************************/

function showMessage(msg, code) {
    $box = $(".msg-box");
    $box.find(".text .text-content").html(msg);
    $box.addClass(code);
    $box.fadeIn();
    setTimeout(function () {
        $box.fadeOut();
    }, 5000);
}

/***************************
    -- Notification box --
 ****************************/

$(function ($) {
    $("#popupNotifications").append("<ul class='dropdown-menu notifications left' id='listeNotifications'>");
    for (var keyNotification in notificationsJS) {
        $("#listeNotifications").append("<div><li>" +notificationsJS[keyNotification].message+"<a href=\"#\" data-id=\""+notificationsJS[keyNotification].id+"\"> VU</a></div></li>");
    }
    $("#popupNotifications").append("</ul>");
});
