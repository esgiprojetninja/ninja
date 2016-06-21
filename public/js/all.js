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
            }).success(function (data) {
                showMessage(data.message, "success");
                console.debug(data);
            }).fail(function (jqXHR, textStatus) {
                console.debug(jqXHR);
                var errors = (JSON.parse(jqXHR.responseText));
                var errorText = "";
                if (errors.errorText.length > 0) {
                    errorText = errors.errorText;
                } else {
                    errorText = "Request failed :(";
                }
                showMessage(errorText, "danger");
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

/********************
    -- Inbox --
********************/

$(function ($) {
    var $list = $(".js-discussion-list");
    if ($list.length) {
        $.ajax({
            method: "GET",
            url: location.origin + "/inbox/getDiscussions",
        }).success(function (data) {
            //showMessage(data.message, "success");
        }).fail(function (jqXHR, textStatus) {
            console.debug(jqXHR);
        }).then(function (data) {
            console.debug(data);
            var currentUserId = Number(data.current_user_id);
            for (i = 0; i < data.message.length; i ++) {
                var penPals = [];
                for(j = 0; j < data.message[i].users.length; j++) {
                    var user = data.message[i].users[j];
                    if(Number(user.id) !== currentUserId) {
                        console.debug(user);
                        penPals.push(user.username);
                    }
                }
                $list.find("ul").append(
                    "<li data-discussion='" + data.message[i].id +
                    "' class='js-discussion-list-item'> To: " +
                    penPals.join(", ") + "</li>"
                );
            }
        });
    }
});
