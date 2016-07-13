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
    $('#popin-notifications').on("click","a", function() {
        var $a = $(this);
        var id = $a.data("id");
        $.get('/notification/delete/' + id,function(){
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
        data.callback = $(this).data("callback");
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
                triggerCallback(data);
            }).fail(function (jqXHR, textStatus) {
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

/***************************
    -- Notification box --
 ****************************/

$(function ($) {
    $("#popin-notifications").append("<ul class='dropdown-menu notifications left' id='liste-notifications'>");
    $.getJSON( webrootJs+"notification/list", function(notifications) {
        var nbNotifications = 0;
        $("#liste-notifications").append("<li class=\"notifications-heading global\">Notifications</li></ul><div ><ul id='scroll'>");
        for (var notification in notifications) {
            console.log(notification);
            if (notifications[notification].opened == 1){
                $("#scroll").append("<li id=\"notif\" class=\"notifications-li opened\"><a href="+notifications[notification].action+" data-id=\"" + notifications[notification].id + "\">"+notifications[notification].message+"</a></li>");
            } else {
                $("#scroll").append("<li id=\"notif\" class=\"notifications-li notOpened\"><a href="+notifications[notification].action+" data-id=\"" + notifications[notification].id + "\">"+notifications[notification].message+"</a></li>");
                nbNotifications++;
            }
        }
        if(nbNotifications != 0){
            $("#notification-icon").attr("class", "icon-menu fa fa-flag");
        }
        $("#popin-notifications").append("</ul></div>");
    })
});

/********************
    -- Inbox --
********************/

$(function ($) {
    getDiscussions();
    $(".js-create-discussion").submit(function (ev) {
        getDiscussions();
    });
    var refreshMessagesInterval;
});

function getDiscussions() {
    var $list = $(".js-discussion-list");
    if ($list.length) {
        $.ajax({
            method: "GET",
            url: location.origin + "/inbox/getDiscussions",
        }).success(function (data) {
            //showMessage(data.message, "success");
        }).fail(function (jqXHR, textStatus) {
        }).then(function (data) {
            var currentUserId = Number(data.current_user_id);
            var items = "";
            if (data.message.length) {
                for (i = 0; i < data.message.length; i ++) {
                    var penPals = [];
                    for(j = 0; j < data.message[i].users.length; j++) {
                        var user = data.message[i].users[j];
                        if(Number(user.id) !== currentUserId) {
                            penPals.push(user.username);
                        }
                    }
                    items += "<li data-discussion='" + data.message[i].id +
                    "' class='js-discussion-list-item'> To: " +
                    penPals.join(", ") + "</li>"
                }
                $list.find("ul").html(items);
            }
            listenForChooseDiscussion(currentUserId);
        });
    }
}

function listenForChooseDiscussion(currentUserId) {
    $.each($(".js-discussion-list-item"), function (index, elem) {
        refreshMessages(currentUserId, $(elem).data("discussion"));
        refreshMessagesInterval = setInterval(function () {
            refreshMessages(currentUserId, $(elem).data("discussion"));
        }, 5000);
    });
}

function refreshMessages(currentUserId, discussionId) {
    var $chatBody = $(".chat-body");
    $chatBody.attr("data-discussion", discussionId);
    $messageForm = $chatBody.find(".js-inbox-message-form");
    $messageForm.find("input[name='discussion_id']").val(discussionId);
    $.ajax({
        method: "POST",
        url: location.origin + "/inbox/getMessages",
        data: {"discussion_id" : discussionId}
    }).success(function(data) {
        // SUCCESS
    }).fail(function (jqXHR, textStatus) {
        //FAIL
    }).then(function (data) {
        var $messageList = $chatBody.find(".js-message-list");
        $messageList.html("");
        var $messages = [];
        $.each(data, function (index, message) {
            var $messageBox = $("<div></div>");
            $messageBox.data("sender", message.sender_id);
            $messageBox.append(
                "<span class='content'>" +
                message.content +
                "</span>"
            );
            $messageBox.addClass("message");
            if (message.sender_id == currentUserId) {
                $messageBox.addClass("sender-is-current");
            }
            $messages.push($messageBox);
        });
        if ($messages.length > 0) {
            $.each($messages, function (index, $message) {
                $messageList.append($message);
            });
        } else {
            $messageList.html("No message yet.");
        }
    });
}


/*********************
    -- Callbacks --
*********************/

function triggerCallback(data) {
    switch(data.callback) {
        case "discussions":
            getDiscussions();
            break;
        case "messages":
            refreshMessages(data.current_user_id, data.discussion_id);
            break;
        default:
            null
    }
}

/**************************
    -- Inputs hints --
*************************/

$(function ($) {
    $(".js-time-input").click(function(ev) {
        if (!$(ev.target).parent().find(".hintBox").length) {
            $inputGrp = $(ev.target).parent();
            $hintBox = $(document.createElement("div"));
            $hintBox.addClass("hintBox");
            if ($(ev.target).hasClass("js-time")) {
                $hintBox.append("Please respect the following format => hh:mm");
            } else if ($(ev.target).hasClass("js-date")) {
                $hintBox.append("Please respect the following format => dd/mm/yyyy");
            }
            $inputGrp.append($hintBox);
        }
    });
    $(".js-time-input").blur(function(ev) {
        $(ev.target).parent().find(".hintBox").remove();
    });
});
