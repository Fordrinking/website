/**
 * Created by kaidi on 15-1-16.
 */

(function($, win){

    var $urlInputArea;
    var photoNums = 0;

    var photos = win.SCATTER_PHOTO_INFO = [];
    var photo  = win.SCATTER_PHOTO = function(domID, selfID) {

        this.photoNumber = 0;
        this.PubSub = {};
        this.oninsertImage = null;

        initPhotos();

        function initPhotos() {
            createUI(domID);

            $urlInputArea = $('.sc-p-url-i');

            $('.sc-p-url-btn').on('click', urlBtnClicker);
            $('.sc-url-confirm').on('click', urlBtnConfirm);
            $('.sc-p-i-btn').on('click', photoBtnOpen);
        }

        photos[selfID] = {
            photoNumber: this.photoNumber
        }
    };

    function urlBtnConfirm() {
        $urlInputArea.css('display', 'none').data('state', 0);
    }

    function urlBtnClicker() {
        var state = $urlInputArea.data('state');
        if (state == 0) {
            $urlInputArea.css('display', 'block')
                .css('opacity', '0')
                .fadeTo(500, 1)
                .data('state', 1);
        } else {
            $urlInputArea.css('display', 'none')
                .data('state', 0);
        }
    }

    function photoBtnOpen() {
        var id= new Date().getTime();
        var $newImgUpload = $("<input style='display: none' name='imgFiles[]' id='imgFile" + id + "' type='file'>");
        $(".sc-p-files").append($newImgUpload);
        var $file = $("#imgFile" + id);
        $file.on("change", {file: $file[0]}, previewPhoto).click();
    }

    function deletePhoto() {
        var $parent = $(this).parent().parent();
        var index = $parent.index();
        $parent.remove();
        $(".sc-p-files").children().eq(index).remove();
        photoNums--;
        if (photoNums == 0) {
            $(".sc-p-insert").css('padding', '148px 0');
        }
    }

    function linkPhoto() {

    }

    function previewPhoto(event) {
        var file = event.data.file;
        photoNums++;

        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(file.files[0]);
            reader.onload = function (e) {
                console.log(e);
                var imgSrc        = e.target.result;
                var id            = new Date().getTime();
                var newPhotoHTMLs = [];

                newPhotoHTMLs.push("<div class='sc-p-new-load-item sc-p-id" + id + "'>");
                newPhotoHTMLs.push("<img class='sc-p-load-item-img' src='" + imgSrc + "'/>");
                newPhotoHTMLs.push("<div class='sc-p-img-action'>");
                newPhotoHTMLs.push("<div class='sc-p-action-i sc-p-link-img'>");
                newPhotoHTMLs.push("<span class='glyphicon glyphicon-link'></span>");
                newPhotoHTMLs.push("</div>");
                newPhotoHTMLs.push("<div class='sc-p-action-i sc-p-del-img'>");
                newPhotoHTMLs.push("<span class='glyphicon glyphicon-remove'></span>");
                newPhotoHTMLs.push("</div>");
                newPhotoHTMLs.push("</div>");
                newPhotoHTMLs.push("</div>");
                newPhotoHTMLs.push("</form>");

                $(".sc-p-load-imgs").append($(newPhotoHTMLs.join("\n")));
                $(".sc-p-insert").css('padding', '48px 0');

                var $newItem = $(".sc-p-id" + id);
                $newItem.on('mouseenter', function() {
                    $(this).find(".sc-p-img-action").show();
                }).on('mouseleave', function() {
                    $(this).find(".sc-p-img-action").hide();
                });
                $newItem.find(".sc-p-del-img").on("click", deletePhoto);
                $newItem.find(".sc-p-link-img").on("click", linkPhoto);

            };
        }
    }

    function createUI(id) {

        var uiHTMLs = [];
        uiHTMLs.push("<div class='sc-p-c'>");
        uiHTMLs.push("<form class='sc-p-form' id='uploadPhotoForm' enctype='multipart/form-data'>");
        uiHTMLs.push("<div class='sc-p-load-imgs'></div>");
        uiHTMLs.push("<div class='sc-p-insert'>");
        uiHTMLs.push("<span class='glyphicon glyphicon-picture sc-p-i-btn'></span>");
        uiHTMLs.push("<div class='sc-p-files'></div>");
        uiHTMLs.push("</div>");
        uiHTMLs.push("<div class='sc-p-url-c'>");
        uiHTMLs.push("<div class='sc-p-url'>");
        uiHTMLs.push("<span class='sc-p-url-btn'>URL</span>");
        uiHTMLs.push("<div class='sc-p-url-i' data-state='0'>");
        uiHTMLs.push("<div style='position: relative'>");
        uiHTMLs.push("<span class='glyphicon glyphicon-arrow-right sc-url-confirm'></span>");
        uiHTMLs.push("<span class='sc-angle-lt'></span>");
        uiHTMLs.push("<input id='scPhotoURL' type='text'>");
        uiHTMLs.push("</div>");
        uiHTMLs.push("</div>");
        uiHTMLs.push("</div>");
        uiHTMLs.push("</div>");
        uiHTMLs.push("</form>");
        uiHTMLs.push("</div>");

        $("#" + id).append($(uiHTMLs.join("\n")));
    }

    photo.prototype.GetData = function() {
        var formElement = document.getElementById("uploadPhotoForm");
        return new FormData(formElement);
    };

    photo.prototype.attachData = function(data) {
        $("#uploadPhotoForm").append($("<textarea id='scPhotoAttachData' name='attachData' style='display: none'></textarea>"));
        $("#scPhotoAttachData").val(data);
    }







}(jQuery, window));