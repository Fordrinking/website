/**
 * Created by kaidi on 15-1-12.
 */

(function ($) {

    var blogIndex        = parseInt($("#blogIndex").val());

    var $loginBtn        = $("#signupBtn");
    var $userSettingBtn  = $("#userSettingBtn");
    var $userSetting     = $("#userSetting");
    var $postSubmit      = $("#postSubmit");
    var $postText        = $("#postText");
    var $signupAlertMsg  = $("#signupAlert");
    var $navBtn          = $("#navBtn");
    var $navNavRow       = $("#userNavRow");
    var $postMobileAdd   = $("#postMobileAdd");
    var $blogCommentArea = $(".blog-comment-header");

    var emailExist      = true;
    var usernameExist   = true;

    function signupBtnClicker() {

        var email    = $.trim($("#signupMail").val());
        var username = $.trim($("#signupName").val());
        var password = $.trim($("#signupPass").val());

        if (email == "") {
            $signupAlertMsg.html("Please Enter Email");
            return;
        }

        var emailPattern = /^\s*\w+(?:\.{0,1}[\w-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+\s*$/;
        if (!emailPattern.exec(email)){
            $signupAlertMsg.html("Invalid Email Format");
            return;
        }

        if (username == "") {
            $signupAlertMsg.html("Please Enter Username");
            return;
        }

        if (username.length > 16) {
            $signupAlertMsg.html("Username Is Too Long");
            return;
        }

        if (username.length < 4) {
            $signupAlertMsg.html("Username Is Too Short");
            return;
        }

        if (password == "") {
            $signupAlertMsg.html("Please Enter Password");
            return;
        }

        if (password.length > 16) {
            $signupAlertMsg.html("Password Is Too Long");
            return;
        }

        if (password.length < 4) {
            $signupAlertMsg.html("Password Is Too Short");
            return;
        }

        if (emailExist) {
            $signupAlertMsg.html("Email Exist, Please Login");
            return;
        }

        if (usernameExist) {
            $signupAlertMsg.html("Username Exist, Try Another");
            return;
        }

        $.ajax({
            url:  "signup",
            type: "post",
            data: {
                email:    email,
                username: username,
                password: password
            },
            success: function(value) {
                if (value == "email-exist") {
                    $("#signupAlert").html("Email Exist, Please Login");
                } else if (value == "user-exist") {
                    $("#signupAlert").html("Username Exist, Try Another");
                } else if (value == "user-added") {
                    window.location.href="http://fordrinking.com/home";
                }
            }
        });
    }

    function ajaxCheckSignupEmail() {
        var email = $.trim($("#signupMail").val());
        if (email == "") {
            return;
        }
        $.ajax({
            url: "signup-check-email",
            type: "post",
            data: {
                email: email
            },
            success: function(value) {
                if (value == "email-exist") {
                    $signupAlertMsg.html("Email Exist, Please Login");
                    emailExist = true;
                } else {
                    emailExist = false;
                }
            }
        });
    }

    function ajaxCheckSignupUsername() {
        var name = $.trim($("#signupName").val());
        if (name == "") {
            return;
        }
        $.ajax({
            url: "signup-check-name",
            type: "post",
            data: {
                username: name
            },
            success: function(value) {
                if (value == "user-exist") {
                    $signupAlertMsg.html("Username Exist, Try Another");
                    usernameExist = true;
                } else {
                    usernameExist = false;
                }
            }
        });
    }

    function userSettingBtnClicker(e) {
        var $this = $(this);
        if ($this.data("state") == 0) {
            $userSetting.slideDown(100);
            $this.data("state", 1);
        } else {
            $userSetting.slideUp(100);
            $this.data("state", 0);
        }
    }

    function navBtnClicker() {
        var $this = $(this);
        if ($this.data("state") == 0) {
            $navNavRow.removeClass("collapse");
            $this.data("state", 1);
        } else {
            $navNavRow.addClass("collapse");
            $this.data("state", 0);
        }
    }

    function postMobileAddClicker() {
        var $postAbmActions = $("#postAbmActions");
        var $this = $(this);
        if ($this.data('state') == 0) {
            $postAbmActions.slideDown();
            $this.data('state', 1);
        } else {
            $postAbmActions.slideUp();
            $this.data('state', 0);
        }
    }

    function postSubmitBtnClicker() {
        $.ajax({
            url: "post-text",
            type: "post",
            data: {
                content: $("#postText").val()
            },
            success: function(value) {
                $(".blogs").prepend(value);
            }
        })
    }

    function loadingMoreBlogs() {
        var clientHeight = $(window).height();
        var scrollTop    = $(document).scrollTop();
        var scrollHeight = document.body.scrollHeight;

        if(clientHeight + scrollTop >= scrollHeight - 10){
            $(document).off("scroll", loadingMoreBlogs);
            $.ajax({
                url: "more-blog",
                type: "post",
                data: {
                    blogIndex: blogIndex
                },
                success: function (data) {
                    $(".blogs").append(data);
                    blogIndex += 5;
                    $(document).on("scroll", loadingMoreBlogs);
                }
            });

        }
    }

    function commentClicker() {
        var $blogExtra = $(this).parents(".blog-c").find(".blog-extra");
        var $blogCommentHeader = $(this).parents(".blog-c").find(".blog-comment-header");
        if ($blogCommentHeader.data("state") == 0) {
            $blogCommentHeader.show();
            $blogCommentHeader.data("state", 1);
            $.ajax({
                url: "get-blog-comment",
                type: "post",
                data: {
                    blogId: $blogExtra.data("id")
                },
                success: function(value) {
                    $blogExtra.append(value);
                }
            });
        } else {
            $blogCommentHeader.hide();
            $blogCommentHeader.data("state", 0);
            $blogExtra.find(".blog-comment-body").remove();
        }
    }

    function postCommentClicker() {
        var $comment = $(this).parent().parent().find(".blog-comment-area");
        var commentValue = $comment.val();
        var $blogExtra = $(this).parents(".blog-extra");
        $.ajax({
            url: "give-blog-comment",
            type: "post",
            data: {
                blogId: $blogExtra.data("id"),
                userId: $("#currentUserId").val(),
                comment: commentValue
            },
            success: function(value) {
                var $blogCommentBody = $blogExtra.find(".blog-comment-body");
                if ($blogCommentBody.length == 0) {
                    $blogCommentBody = $("<div class='blog-comment-body'></div>");
                    $blogExtra.append($blogCommentBody);
                }
                $blogCommentBody.prepend(value);
            }
        });
    }

    var app = {

        init: function() {
            $userSetting.hide();
            $postText.focus();
            $blogCommentArea.hide();
        },

        addEvent: function() {
            $(document).on("scroll", loadingMoreBlogs);
            $loginBtn.on("click", signupBtnClicker);
            $userSettingBtn.on("click", userSettingBtnClicker);
            $postSubmit.on("click", postSubmitBtnClicker);
            $navBtn.on("click", navBtnClicker);
            $postMobileAdd.on("click", postMobileAddClicker);
            $("#signupMail").on("blur", ajaxCheckSignupEmail);
            $("#signupName").on("blur", ajaxCheckSignupUsername);
            $(".signup-form .form-item-t").on("keydown", function() {
                $signupAlertMsg.html("");
            });
            $(".blog-comment-btn").on("click", commentClicker);
            $(".blog-comment-post-btn").on("click", postCommentClicker);
        },

        run: function() {
            this.init();
            this.addEvent();
        }
    };

    app.run();

})(jQuery);
