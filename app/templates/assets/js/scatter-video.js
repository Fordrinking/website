/**
 * Created by kaidi on 15-1-18.
 */

(function($, win) {

    var $textarea;

    var video = win.SCATTER_VIDEO = function(domID) {

        this.node = null;

        initVideo();

        this.node = $textarea;

        function initVideo() {
            createUI(domID);

            $textarea = $("#" + domID).find(".sc-v-url");
        }
    };

    function createUI(id) {
        var videoUIHTMLs = [];
        videoUIHTMLs.push("<div class='sc-v-c'>");
        videoUIHTMLs.push("<textarea class='sc-v-url' placeholder='Embed Code or Video URL'></textarea>");
        videoUIHTMLs.push("</div>");

        $("#" + id).append($(videoUIHTMLs.join("\n")));
    }

    video.prototype.GetURL = function() {
        return this.node.val();
    }

}(jQuery, window));
