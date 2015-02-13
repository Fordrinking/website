<div class="dashboard-c">
    <div class="dashboard">
        <div class="dash-title">
            <div class="dash-title-bg">
                <img src="<?php echo \helpers\url::template_path() . 'assets/img/dash-title-bg.png' ?>">
            </div>
            <div class="dash-u-avatar">
                <img src="<?php echo $data['avatar']; ?>">
            </div>
            <div class="dash-u-intro">Something about you!</div>
        </div>

        <div class="blogs-c">
            <input type="hidden" id="blogIndex" value="<?php echo $data['blogIndex']; ?>">
            <div class="blogs">
                <?php
                if($data['posts']){
                    foreach($data['posts'] as $row){ ?>
                        <div class="blog-item">
                            <div class="dash-blog-c">
                                <div class="blog-title">
                                    <div class='blog-info'>
                                        <div class='blog-date'><?php echo $row->postDate; ?></div>
                                    </div>
                                    <div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>
                                </div>
                                <div class="blog-body">
                                    <?php echo $row->content; ?>
                                </div>
                                <div class="blog-footer">
                                    <div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>
                                    <div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>
                                    <div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>