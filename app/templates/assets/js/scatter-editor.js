/**
 * Created by kaidi on 15-1-15.
 */

(function($, win) {

    var frameDoc;
    var editorNode;

    var editor = win.SCATTER_EDITOR = function(id) {
        
        var parent   = "#" + id;
        var htmlMode = false;

        this.node    = null;
        this.trackId = id;


        initEditor();

        this.node = editorNode;

        function initEditor() {
            createFramework();
            createContent();
            addEventHandler();

            frameDoc   = getIFrameDocument(".sc-editor-iframe");
            editorNode = $(".sc-editor-iframe").contents().find("body").find(".sc-editor");

            editorNode.on("keydown", function() {
                var currentHeight = parseInt($(this).css('height')) + 30;
                if (currentHeight >= 150) {
                    $(".sc-editor-iframe").css('height', currentHeight + 'px');
                }
            });
            editorNode.focus();

            //node = editorNode;
        }
        
        function createFramework() {
            var frameworkHTMLs = [];
            frameworkHTMLs.push("<div class='sc-e-title'><input type='text' placeholder='Title'></div>");
            frameworkHTMLs.push("<div class='sc-e-bar'>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-bold' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-italic' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-strike' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-link' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-unlink' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-number-list' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-dot-list' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-image' data-state='0'></span>");
            frameworkHTMLs.push("<span class='sc-e-bar-i sc-e-bar-html' data-state='0'></span>");
            frameworkHTMLs.push("</div>");
            frameworkHTMLs.push("<iframe class='sc-editor-iframe' scrolling='no'></iframe>");

            $(parent).append($(frameworkHTMLs.join("\n")));
        }
        
        function createContent() {
            var $framework    = $(".sc-editor-iframe");
            var $frameContent = $framework.contents();

            var headerHTMLs = [];
            headerHTMLs.push("<link href='http://fordrinking.com/app/templates/assets/css/editor-content.css' rel='stylesheet' type='text/css'>");
            $frameContent.find("head").append($(headerHTMLs.join("\n")));

            var bodyHTMLs = [];
            bodyHTMLs.push("<div class='sc-editor' contenteditable='true'></div>");
            $frameContent.find("body").append($(bodyHTMLs.join("\n")));
        }

        function getIFrameDocument(nodeClass) {
            var iframe = $(nodeClass)[0];

            return iframe.contentDocument;
        }

        function addEventHandler() {
            $('.sc-e-bar-i').on('click', scItemClicker);
            $('.sc-e-bar-bold').on('click', boldClicker);
            $('.sc-e-bar-italic').on('click', italicClicker);
            $('.sc-e-bar-strike').on('click', strikeClicker);
            $('.sc-e-bar-link').on('click', linkClicker);
            $('.sc-e-bar-unlink').on('click', unlinkClicker);
            $('.sc-e-bar-number-list').on('click', numListClicker);
            $('.sc-e-bar-dot-list').on('click', dotListClicker);
            $('.sc-e-bar-image').on('click', imageClicker);
            $('.sc-e-bar-html').on('click', htmlClicker);
        }

        function scItemClicker() {
            var $current = $(this);
            var state = $current.data('state');
            if (state == 0) {
                $current.addClass('sc-e-bar-i-bg');
                $current.data('state', 1);
            } else {
                $current.removeClass('sc-e-bar-i-bg');
                $current.data('state', 0);
            }
        }

        function boldClicker() {
            formatDoc('bold');
        }

        function italicClicker() {
            formatDoc('italic');
        }

        function strikeClicker() {
            formatDoc('strikeThrough');
        }

        function linkClicker() {
            formatDoc('createLink');
        }

        function unlinkClicker() {
            formatDoc('unlink');
        }

        function numListClicker() {
            formatDoc('insertOrderedList');
        }

        function dotListClicker() {
            formatDoc('insertUnorderedList');
        }

        function imageClicker() {
            formatDoc('insertImage');
        }

        function htmlClicker() {
            if (htmlMode) {
                setDocMode(1);   // "1" means rich mode
                htmlMode = false;
            } else {
                setDocMode(0);   // "0" means html mode
                htmlMode = true;
            }

        }

        function formatDoc(cmd, value) {
            if (!htmlMode) {
                frameDoc.execCommand(cmd, false, value);
            }
        }

        function setDocMode(mode) {

            var content;
            var contentNode = editorNode[0];

            if (mode == 0) {
                content = document.createTextNode(contentNode.innerHTML);
                contentNode.innerHTML = "";
                var preHTMLNode = document.createElement("pre");
                contentNode.contentEditable = false;
               // preHTMLNode.id = "sourceText";
                preHTMLNode.contentEditable = true;
                preHTMLNode.appendChild(content);
                contentNode.appendChild(preHTMLNode);
            } else {
                content = document.createRange();
                content.selectNodeContents(contentNode.firstChild);
                contentNode.innerHTML = content.toString();
                contentNode.contentEditable = true;
            }
            contentNode.focus();
        }
    };

    editor.prototype.GetValue = function() {
        console.log(this.node);
        //console.log(this.node.html());
        return this.node.html();
        //return "fuck";
    }

})(jQuery, window);

