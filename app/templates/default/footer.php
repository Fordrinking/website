   </div>
 </div>


<!-- JS -->
<?php
if($data['js']){
    $js = array();
    array_push($js, helpers\url::template_path() . 'assets/js/jquery-1.11.1-min.js');
    array_push($js, helpers\url::template_path() . 'assets/js/common.js');
    foreach($data['js'] as $row) {
        array_push($js, helpers\url::template_path() . 'assets/js/' . $row . '.js');
    }
    helpers\Assets::js($js);
} else {
    helpers\assets::js(array(
        helpers\url::template_path() . 'assets/js/jquery-1.11.1-min.js',
        helpers\url::template_path() . 'assets/js/default.js',
        helpers\url::template_path() . 'assets/js/scatter-editor.js',
        helpers\url::template_path() . 'assets/js/scatter-photo.js',
        helpers\url::template_path() . 'assets/js/scatter-video.js',
        helpers\url::template_path() . 'assets/js/modal.js'
    ));
}
?>
</body>
</html>