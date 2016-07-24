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

      // Handle click on empty input
      if ($(ev.target).attr("href") == undefined && ev.type == "click") {
          return;
      }

      ev.preventDefault();
      var action = $(this).attr("action");
      var method = $(this).attr("method");
      var success = $(this).data("success");
      var lock = false;
      var data = {};
      data.message = $(this).data("message");
      data.callback = $(this).data("callback");
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
            var promptInput = prompt("Add a message with your invitation");
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
          lock = true;
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
            $("#notification-icon").css("class", "icon-menu fa fa-bell");
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
        console.debug("chatte");
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
                    items += "<li data-discussion='" + data.message[i].id +
                    "' class='js-discussion-list-item'> To: " +
                    data.message[i].pen_pal + "</li>"
                }
                $list.find("ul").html(items);
            }
            $(".js-discussion-list-item").click(function (ev) {
                var discussionId = $(ev.target).data("discussion");
                refreshMessages(gblCurrentUserId, discussionId);
                if (typeof refreshMessagesInterval != "undefined") {
                    clearInterval(refreshMessagesInterval);
                }
                refreshMessagesInterval = setInterval(function () {
                    refreshMessages(gblCurrentUserId, discussionId);
                }, 5000);
            });
            //listenForChooseDiscussion(currentUserId);
        });
    }
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
        $("#search-content").val("");
        $("#all-content").show();
        $("#pages").show();
    });
    $("#search-content").keyup(function(){
        var search = $('#search-content').val();
        var select = $('#select-criteria').val();

        //Valeurs des options du select
        if (page == "team"){
            if (select == 1){
                var column = "teamName";
            } else if (select == 2){
                var column = "sports";
            } else {
                var column = "description";
            }
        } if (page == "user") {
            if (select == 1){
                var column = "username";
            } else if (select == 2){
                var column = "country";
            } else {
                var column = "city";
            }
        } if (page == "event") {
            if (select == 1){
                var column = "name";
            } else if (select == 2){
                var column = "owner_name";
            } else if (select == 3){
                var column = "tags";
            }
        }
        var arraySearch = [column,search];
        if (search != "") {
            $("#all-content").hide();
            $("#pages").hide();
            if (page == "team"){
                //Recherche Team
                $.getJSON(webrootJs+"team/search/"+arraySearch, function(teams) {
                    if (teams != null) {
                        $("#search-content-results").empty();
                        for (var team in teams) {
                            $("#search-content-results").append('<div class="col-sm-6">' +
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
                                '                            </ul>' +
                                '                            </div>' +
                                '                            </div>' +
                                '                            </div>');
                        }
                    } else {
                        $( "#search-content-results" ).empty();
                        $("#search-content-results").append('<div class="col-sm-12">' +
                            '                            <div class="panel panel-primary">' +
                            '                            <div class="panel-heading"><h3 class="center header-li ">No Group found</a></h3></div></div>');
                    }
                });
            } if (page == "user") {
                //Recherche User
                $.getJSON(webrootJs+"user/search/"+arraySearch, function(users) {
                    if (users != null) {
                        $("#search-content-results").empty();
                        for (var user in users) {
                            $("#search-content-results").append('<div class="col-sm-6">' +
                                '                            <div class="panel panel-primary2">' +
                                '                            <div class="panel-heading"><h3 class="center header-li "><a href="' + webrootJs + 'user/show/' + users[user].id + '"> User ' + users[user].username + '</a></h3></div>' +
                                '                            <div class="panel-body">' +
                                '                            <ul class="header-ul">' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Email : </span>' +
                                '                        <span class="form-content">' + users[user].email + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Country : </span>' +
                                '                        <span class="form-content">' + users[user].country + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">City : </span>' +
                                '                        <span class="form-content">' + users[user].city  + '</span>' +
                                '                            </li>' +
                                '                            <li class="li-list">' +
                                '                            <span class="form-info">Birthday : </span>' +
                                '                        <span class="form-content">' + users[user].birthday  + '</span>' +
                                '                            </li>' +
                                '                            </ul>' +
                                '                            </div>' +
                                '                            </div>' +
                                '                            </div>'
                            );
                        }
                    } else {
                        $( "#search-content-results" ).empty();
                        $("#search-content-results").append('<div class="col-sm-12">' +
                            '                            <div class="panel panel-primary2">' +
                            '                            <div class="panel-heading"><h3 class="center header-li ">No User found</a></h3></div></div>');
                    }
                });
            } if(page == "event") {
                $.getJSON(webrootJs+"event/search/"+arraySearch, function(events) {
                    if (events != null) {
                        $("#search-content-results").empty();
                        $.each(events, function (key, data) {
                            console.debug(key); // On s'en fout
                            console.debug(data);
                            $("#search-content-results").append(' <div class="panel panel-success">' +
                                '                                <div class="panel-heading">'+ data.eventName +'</div>' +
                                '                            <div class="panel-body">' +
                                '                                <p class="underlined">Owner : '+events[event].owner_name+'</p>' +
                                '                            <div class="row">' +
                                '                                <div class="col-sm-6">' +
                            '                                <div class="tag-box">' +
                                '                            '+events[event].tags+'' +
                            '                        <a href="#"><?= $tag ?></a>' +
                                '                            <?php endforeach; ?>' +
                                '                        </div>' +
                                '                            </div>' +
                            '                            <div class="col-sm-6">' +
                                '                            '+events[event].description+'' +
                                '                        </div>' +
                                '                            </div>' +
                                '                            <ul class="item-list">' +
                                '                                <li>From : '+events[event].from_date+'</li>' +
                                '                            <li>To : '+events[event].to_date+'</li>' +
                                '                            <li>Joignable until '+events[event].joignable_until+'</li>' +
                                '</ul>' +
                                '                                <p>People : </p>' +
                            '                            <ul class="item-list">' +
                            '                            <!--<?php foreach ($events->gatherUsers() as $key => $user): ?>-->' +
                            '                        <!--<li><?= $user["username"] ?></li>-->' +
                                '                            <?php endforeach; ?>' +
                                '                        </ul>' +
                                '                            </div>' +
                            '                            <div class="panel-footer">' +
                                '                            <!--<?php if (in_array($_SESSION["user_id"], $events->getUsersId()) && $events->getOwner() != $_SESSION["user_id"]): ?>-->' +
                                '                        <a <!--href="<?= WEBROOT; ?>event/leave/<?= $events->getId();?-->>/<!--<?= $_SESSION[\'user_id\']?>-->" class="btn btn-danger">Leave</a>' +
                            '                            <!--<?php elseif (!in_array($_SESSION["user_id"], $events->getUsersId())): ?>-->' +
                            '                        <a <!--href="<?= WEBROOT; ?>event/join/<?= $events->getId();?>-->" class="btn btn-success">Join</a>' +
                            '                          <!--  <?php endif; ?>-->' +
                            '                       <!-- <?php if ($events->getOwner() == $_SESSION["user_id"]): ?>-->' +
                            '                        <a <!--href="<?= WEBROOT; ?>event/update/<?= $events->getId() ?>-->" class="btn btn-primary">Manage</a>' +
                            '                            <!--<?php endif; ?>-->' +
                            '                        </div>'
                          );
                      });
                    } else {
                        $( "#search-content-results" ).empty();
                        $("#search-content-results").append('<div class="col-sm-12">' +
                            '                            <div class="panel panel-primary">' +
                            '                            <div class="panel-heading"><h3 class="center header-li ">No Group found</a></h3></div></div>');
                    }
                });

            }
        } else {
            $( "#search-content-results" ).empty();
            $("#all-content").show();
            $("#pages").show();
        }
    });
});
