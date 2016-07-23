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

});

/**********************
    -- AJAX FORMS --
**********************/

$(function ($) {
  $(".ajax-form, .ajax-link").on("click submit", function (ev) {
      ev.preventDefault();
      var action = $(this).attr("action");
      var method = $(this).attr("method");
      var success = $(this).data("success");
      var lock = false;
      var data = {};
      data.message = $(this).data("message");
      //data.callback = $(this).data("callback");
      if(typeof data.message == "undefined") {
          data.message = "Data updated !";
      }

      if ($(this).is(".ajax-link")) {
          data.idUser = $(this).data("user");
          data.idTeam = $(this).data("team");
          data.type = $(this).data("type");

          action = $(this).data("url");
          action = window.location.origin+"/"+window.location.pathname.split("/",2)[1]+"/"+action;
          if($(this).is(".prompt")){
            var promptInput = prompt("Add a message with your ask");
            if(promptInput){
              data.messageInvit = promptInput;
              lock = true;
            }else if(promptInput == null){
              return;
            }else if(promptInput === ""){
              data.messageInvit = "I want to join you !";
              lock = true;
            }
          }else{
            if(confirm("Are you sure ?")){
              lock = true;
            }
          }
      } else {
          $.each($(this).find("input, select, textarea"), function () {
              if ($(this).attr("type") == "checkbox" || $(this).attr("type") == "radio") {
                  if ($(this).is(":checked")) {
                      data[$(this).attr("name")] = $(this).val();
                  }
              } else if (($(this).val().length > 0)) {
                  data[$(this).attr("name")] = $(this).val();
              }
          });
      }

      if (!$.isEmptyObject(data) && lock == true) {
            $.ajax({
                method: method,
                url: action,
                data: data
            }).success(function (data) {
                showMessage(data.message, "success");
                triggerCallback(data);
              // J'aimerais bien rajouter un petit refresh de window ici.
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
        //window.location.reload(false);
    }, 5000);
}

/***************************
    -- Notification box --
 ****************************/

$(function ($) {
    $("#popin-notifications").append("<ul class='dropdown-menu notifications right' id='liste-notifications' style='width: "+ width +"px'>");
  	var nbNotifications = 0;
    $.getJSON( webrootJs+"notification/list", function(notifications) {
        var nbNotifications = 0;
        $("#liste-notifications").append("<li class=\"notifications-heading global\">Notifications</li></ul><div ><ul id='scroll'>");
        for (var notification in notifications) {
            if (notifications[notification].opened == 1){
              $("#scroll").append("<li id=\"notif\" class=\"notifications-li opened scroll \"><a href="+notifications[notification].action+" data-id=\"" + notifications[notification].id + "\">"+notifications[notification].datetime+ ": "+notifications[notification].message+"</a></li>");
            } else {
              $("#scroll").append("<li id=\"notif\" class=\"notifications-li not-opened scroll \"><a href="+notifications[notification].action+" data-id=\"" + notifications[notification].id + "\">"+notifications[notification].datetime+ ": "+notifications[notification].message+"</a></li>");
            }
            nbNotifications++;
        }
        if(nbNotifications != 0){
            $("#notification-icon").attr("class", "icon-menu fa fa-bell");
        }
        $("#popin-notifications").append("</ul></div>");
    })
    var width = $( window ).width();
    var height = $( window ).height();
     $("#liste-notifications").css("width", width/2);
     $("#scroll").css("max-height", height/2);
     $( window ).resize(function() {
        var width = $( window ).width();
        var height = $( window ).height();
        $("#liste-notifications").css("width", width/2);
        $("#scroll").css("max-height", height/2);
    });
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

/***************************
 -- Search box --
 ****************************/

$(function ($) {
    $("#select-criteria").change(function(){
        $("#search-team").val("");
        $("#all-teams").show();
        $("#pages").show();
    });
    $("#search-team").keyup(function(){
        var search = $('#search-team').val();
        var select = $('#select-criteria').val();
        if (select == 1){
            var column = "teamName";
        } else if (select == 2){
            var column = "sports";
        } else {
            var column = "description";
        }
        var arraySearch = [column,search];
        if (search != "") {
            $("#all-teams").hide();
            $("#pages").hide();
            $.getJSON(webrootJs+"team/search/"+arraySearch, function(teams) {
                var nbTeams =0;
                if (teams != null) {
                    $("#search-team-results").empty();
                    for (var team in teams) {
                            $("#search-team-results").append('<div class="col-sm-6">' +
                                '                            <div class="panel panel-primary">' +
                                '                            <div class="panel-heading"><h3 class="center header-li "><a href="' + webrootJs + 'team/show/' + teams[team].id + '"> Group ' + teams[team].teamName + '</a></h3></div>' +
                                '                            <div class="panel-body">' +
                                '                            <ul class="header-ul">' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Name : </span>' +
                                '                        <span class="form-content">' + teams[team].teamName + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Date Of Creation : </span>' +
                                '                        <span class="form-content">' + teams[team].dateCreated + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Sports : </span>' +
                                '                        <span class="form-content">' + teams[team].sports + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Description : </span>' +
                                '                        <span class="form-content">' + teams[team].description + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Number of numbers : </span>' +
                                '                        <span class="form-content">' + teams[team].nbMember + '</span>' +
                                '                            </li>' +
                                '                            </ul>' +
                                '                            </div>' +
                                '                            </div>' +
                                '                            </div>'
                            );
                        nbTeams++;
                    }
                } else {
                    $( "#search-team-results" ).empty();
                    $("#search-team-results").append('<div class="col-sm-12">' +
                        '                            <div class="panel panel-primary">' +
                        '                            <div class="panel-heading"><h3 class="center header-li ">No Group found</a></h3></div></div>');
                }
            });
        } else {
            $( "#search-team-results" ).empty();
            $("#all-teams").show();
            $("#pages").show();
        }
    });
});
