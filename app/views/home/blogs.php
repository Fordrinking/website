<div class="blogs-c">
    <input type="hidden" id="blogIndex" value="<?php echo $data['blogIndex']; ?>">
    <div class="blogs">
        <?php
        if($data['posts']){
            foreach($data['posts'] as $row){ ?>
            <div class="blog-item">
                <div class="blog-avatar-item">
                    <img class="blog-a-img left" src="<?php echo $row->getAvatar(); ?>">
                </div>
                <div class="blog-c">
                    <div class="blog-title">
                        <div class='blog-user'>
                            <img class='user-img left' src='<?php echo $row->getAvatar(); ?>'/>
                        </div>
                        <div class='blog-info'>
                            <div class='blog-username'><?php echo $row->getUsername(); ?></div>
                            <div class='blog-date'><?php echo $row->getPostDate(); ?></div>
                        </div>
                        <div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>
                    </div>
                    <div class="blog-body">
                        <?php echo $row->getContent(); ?>
                    </div>
                    <div class="blog-footer">
                        <div class='blog-f-btn blog-repost-btn'>
                            <i class='fa fa-share-square-o fa-lg'></i><?php echo $row->getShareNum(); ?>
                        </div>
                        <div class='blog-f-btn blog-comment-btn'>
                            <i class='fa fa-comment-o fa-lg'></i><?php echo $row->getCommentNum(); ?>
                        </div>
                        <div class='blog-f-btn blog-like-btn'>
                            <i class='fa fa-thumbs-o-up fa-lg'></i><?php echo $row->getLikeNum(); ?>
                        </div>
                    </div>
                    <div class="blog-extra" data-id="<?php echo $row->getId(); ?>">
                        <div class="blog-comment-header" data-state="0">
                            <div class="blog-comment-user">
                                <img class='user-img left' src="<?php echo $data['avatar']; ?>"/>
                            </div>
                            <div class="blog-comment-input">
                                <div style="margin-right: 30px;"><textarea class="blog-comment-area"></textarea></div>
                                <div class="blog-comment-input-f">
                                    <i class="fa fa-smile-o fa-lg"></i>
                                    <i class="fa fa-file-image-o fa-lg"></i>
                                    <button class="blog-comment-post-btn">Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        }
        ?>
    </div>
</div>