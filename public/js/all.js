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
    // msg-box
    $(".js-close-msg-box").click(function (ev) {
        $(this).parent().parent().fadeOut();
    });

    /**************************
         -- MANAGE TEAM -- 
    **************************/

    $("a.kickUser").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure to kick him ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/kick/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId, idUser: userId},
            success : function(response){
             window.location.reload();
            }
          });
      }
    });

    $("a.demoteUser").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure to demote him ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/demote/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId, idUser: userId},
            success : function(response){
             window.location.reload();
            }
          });
      }
    });

    $("a.promoteUser").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure to promote him ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/promote/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId, idUser: userId},
            success : function(response){
             window.location.reload();
            }
          });
      }
    });

    $("a.leaveTeam").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure to leave the team ?')) {
          $.ajax({
            url: "http://localhost:8888/ninja/team/leave/",
            type : "POST",
            dataType: "json",
            data: {idTeam: teamId},
            success : function(response){
             window.location.reload();
            }
          });
      }
    });


    $("a.deleteTeam").click(function(ev){
        ev.preventDefault();
        var userId = $(this).data("user");
        var teamId = $(this).data("team");
        if (confirm('Are you sure to delete this team ?')) {
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

    /**************************
         -- MANAGE ADMIN -- 
    **************************/
    $("#iframeAdmin").hide();

    $("a.addUser").click(function(ev){
        $("#hiddenUsers").hide();
        $("#hiddenTeams").hide();
        $("#iframeAdmin").show();
        $("#frameAdminGlobal").attr("src","user/subscribe");
        $("#frameAdminGlobal").attr("style","height:600px;left:-65px;top:-200px;position:relative");
    })

    $("a.addTeam").click(function(ev){
        $("#hiddenUsers").hide();
        $("#hiddenTeams").hide();
        $("#iframeAdmin").show();
        $("#frameAdminGlobal").attr("src","team/create");
        $("#frameAdminGlobal").attr("style","height:300px;left:-65px;top:-70px;position:relative");
    })

    $("a.manageUser").click(function(ev){
        $("#iframeAdmin").hide();
        $("#hiddenTeams").hide();
        $("#hiddenUsers").show();
        $("#frameAdminGlobal").attr("style","height:300px;left:-65px;top:-70px;position:relative");
    })
    
    $("a.manageTeam").click(function(ev){
        $("#iframeAdmin").hide();
        $("#hiddenUsers").hide();
        $("#hiddenTeams").show();
        $("#frameAdminGlobal").attr("style","height:300px;left:-65px;top:-70px;position:relative");
    })

    $("a.editUser").click(function(ev){
        $("#iframeAdmin").show();
        var userId = $(this).data("user");
        $("#frameAdminGlobal").attr("src","user/edit/"+userId);
        $("#frameAdminGlobal").attr("style","height:500px;left:-65px;top:-70px;position:relative");
    })

    $("a.editTeam").click(function(ev){
        $("#iframeAdmin").show();
        var teamId = $(this).data("team");
        $("#frameAdminGlobal").attr("src","team/edit/"+teamId);
        $("#frameAdminGlobal").attr("style","height:500px;left:-65px;top:-70px;position:relative");
    })

    $("a.deleteUser").click(function(ev){
        var userId = $(this).data("user");
        if (confirm('Are you sure to delete this user ?')) {
            $("#frameAdminGlobal").attr("src","user/delete/"+userId);
            window.location.reload();
        }
    })

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
