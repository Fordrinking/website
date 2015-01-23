/**
 * Created by kaidi on 15-1-15.
 */

(function($) {

    var width;
    var clientWidth;
    var clientHeight;

    var $container      = null;
    var $window         = $(window);
    var $openPictureBtn = $("#openPictureBtn");
    var $openBlogBtn    = $("#openBlogBtn");
    var $openSoundBtn   = $("#openSoundBtn");
    var $openVideoBtn   = $("#openVideoBtn");

    var editor;
    var photos;
    var photosEditor;
    var sound;
    var video;

    function closeModal() {
        $container.find('.scatter-modal').fadeOut(250, function() {
            $(this).remove();
        });

        $('.blind').fadeOut(250, function() {
            $(this).remove();
        });
    }

    function postInModal(event) {
        switch (event.data.kind) {
            case 'editor':
                postBlog();
                break;
            case 'photos':
                postPhotos();
                break;
            case 'sound':
                postSound();
                break;
            case 'video':
                postVideo();
                break;
            default:
        }
    }

    function createModal() {
        var modalHTMLs = [];
        modalHTMLs.push("<div class='scatter-modal'>");
        modalHTMLs.push("<div class='scatter-modal-wnd'>");
        modalHTMLs.push("<div class='sm-wnd-header'>");
        modalHTMLs.push("<div class='left'><span>Username</span></div>");
        modalHTMLs.push("<div class='right'><span class='glyphicon glyphicon-cog'></span></div>");
        modalHTMLs.push("</div>");
        modalHTMLs.push("<div id='postModalBody' class='sm-wnd-body'>");
        modalHTMLs.push("</div>");
        modalHTMLs.push("<div class='sm-wnd-footer'>");
        modalHTMLs.push("<div class='right'><button id='cancelModalBtn' class='modal-cancel-btn'>Cancel</button></div>");
        modalHTMLs.push("<div class='right'><button id='postModalBtn' class='modal-post-btn'>Post</button></div>");
        modalHTMLs.push("</div>");
        modalHTMLs.push("</div>");
        modalHTMLs.push("</div>");

        var $element = $(modalHTMLs.join("\n"));

        $container.append($element);
    }

    function resizeWindow() {
        clientWidth  = $window.width();
        clientHeight = $window.height();
        $container.find('.scatter-modal-wnd')
            .css('top',  '100px')
            .css('left', ((clientWidth  - width) / 2) + 'px');
    }

    function openModal(param) {
        //event.preventDefault();
        createModal();

        $container.find('.scatter-modal-wnd')
            .css('opacity', '0')
            .css('width',  width + 'px')
            .css('top',  '100px')
            .css('left', ((clientWidth  - width) / 2) + 'px')
            .fadeTo(500, 1);

        $('.scatter-modal')
            .append("<div class='blind'></div>")
            .find('.blind')
            .css('opacity', '0')
            .fadeTo(500, 0.8);

        $('.modal-cancel-btn').on('click', closeModal);
        $('.modal-post-btn').on('click', {kind: param}, postInModal);
    }

    function openBlogModal(event) {
        openModal(event.data.kind);
        editor = new SCATTER_EDITOR('postModalBody');
    }

    function openPictureModal(event) {
        openModal(event.data.kind);
        photos = new SCATTER_PHOTO('postModalBody');
        photosEditor = new SCATTER_EDITOR('postModalBody');

        var $container = $("#postModalBody");
        $container.find(".sc-e-title").remove();
        $container.find(".sc-e-bar").css('margin-top', '15px');
        $container.find(".sc-e-bar-image").remove();

    }

    function openSoundModal(event) {
        openModal(event.data.kind);
    }

    function openVideoModal(event) {
        openModal(event.data.kind);
        video = new SCATTER_VIDEO('postModalBody');
    }

    function postBlog() {
        $.ajax({
            url: "post-blog",
            type: "post",
            data: {
                content: editor.GetValue()
            },
            success: function(value) {
                closeModal();
                $(".blogs").prepend(value);
            }
        });
    }

    function postPhotos() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'post-photos', true);
        xhr.upload.addEventListener("progress", progressFunction, false);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                closeModal();
                $(".blogs").prepend(xhr.responseText);
            }
        };
        photos.attachData(photosEditor.GetValue());
        xhr.send(photos.GetData());

    }

    function progressFunction(evt) {

       /* var progressBar = document.getElementByIdx_x_x("progressBar");

        var percentageDiv = document.getElementByIdx_x_x("percentage");

        if (evt.lengthComputable) {

            progressBar.max = evt.total;

            progressBar.value = evt.loaded;

            percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";

        }*/

    }


    function postSound() {

    }

    function postVideo() {
        $.ajax({
            url: "post-video",
            type: "post",
            data: {
                content: video.GetURL()
            },
            success: function(value) {
                closeModal();
                $(".blogs").prepend(value);
            }
        });
    }

    var modal = {

        init: function() {
            width        = 540;
            clientWidth  = $window.width();
            clientHeight = $window.height();
            $container   = $(".post-c");

            $window.on("resize", resizeWindow);
            $openBlogBtn.on("click", {kind: "editor"}, openBlogModal);
            $openPictureBtn.on("click", {kind: "photos"}, openPictureModal);
            $openSoundBtn.on("click", {kind: "sound"}, openSoundModal);
            $openVideoBtn.on("click", {kind: "video"}, openVideoModal);
        },

        run: function() {
            this.init();
        }
    };

    modal.run();

})(jQuery);

