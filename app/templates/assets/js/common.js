/**
 * Created by kaidi on 2/12/15.
 */
(function ($) {

    var blogIndex       = parseInt($("#blogIndex").val());

    var $userSettingBtn = $("#userSettingBtn");
    var $userSetting    = $("#userSetting");
    var $postText       = $("#postText");
    var $navBtn         = $("#navBtn");
    var $navNavRow      = $("#userNavRow");
    var $postMobileAdd  = $("#postMobileAdd");


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

    function loadingMoreBlogs() {
        var clientHeight = $(window).height();
        var scrollTop    = $(document).scrollTop();
        var scrollHeight = document.body.scrollHeight;

        if(clientHeight + scrollTop >= scrollHeight - 10){
            $(document).off("scroll", loadingMoreBlogs);
            $.ajax({
                url: "more-self-blog",
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

    var app = {

        init: function() {
            $userSetting.hide();
            $postText.focus();
        },

        addEvent: function() {
            $(document).on("scroll", loadingMoreBlogs);
            $userSettingBtn.on("click", userSettingBtnClicker);
            $navBtn.on("click", navBtnClicker);
            $postMobileAdd.on("click", postMobileAddClicker);
        },

        run: function() {
            this.init();
            this.addEvent();
        }
    };

    app.run();

})(jQuery);
