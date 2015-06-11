<div class="post-c">
    <div class="post">
        <div class="post-user">
            <input type="hidden" id="currentUserId" value="<?php echo $data['userId']; ?>">
            <img class="post-user-img left" src="<?php echo $data['avatar']; ?>">
        </div>
        <div class="post-action">
            <div class="post-action-bar">
                <div class="tab post-a-item" id="openBlogBtn">
                    <div class="post-a-icon">
                        <span class="glyphicon glyphicon-file"></span>
                    </div>
                    <div class="post-ab-t">Blog</div>
                </div>
                <div class="tab post-a-item" id="openPictureBtn">
                    <div class="post-a-icon">
                        <span class="glyphicon glyphicon-picture"></span>
                    </div>
                    <div class="post-ab-t">Picture</div>
                </div>
                <div class="tab post-a-item" id="openSoundBtn">
                    <div class="post-a-icon">
                        <span class="glyphicon glyphicon-headphones"></span>
                    </div>
                    <div class="post-ab-t">Sound</div>
                </div>
                <div class="tab post-a-item" id="openVideoBtn">
                    <div class="post-a-icon">
                        <span class="glyphicon glyphicon-facetime-video"></span>
                    </div>
                    <div class="post-ab-t">Video</div>
                </div>
                <div class="tab post-a-item" id="openMessageBtn">
                    <div class="post-a-icon">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </div>
                    <div class="post-ab-t">Message</div>
                </div>
                <div class="tab post-a-item" id="openPollBtn">
                    <div class="post-a-icon">
                        <span class="glyphicon glyphicon-stats"></span>
                    </div>
                    <div class="post-ab-t">Poll</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="post-c-m">
    <div class="post-abm-actions" id="postAbmActions">
        <ul>
            <li class="post-abm-btn">
                <span class="glyphicon glyphicon-file post-abm-a"></span>
            </li>
            <li class="post-abm-btn">
                <span class="glyphicon glyphicon-picture post-abm-a"></span>
            </li>
            <li class="post-abm-btn">
                <span class="glyphicon glyphicon-headphones post-abm-a"></span>
            </li>
            <li class="post-abm-btn">
                <span class="glyphicon glyphicon-facetime-video post-abm-a"></span>
            </li>
            <li class="post-abm-btn">
                <span class="glyphicon glyphicon-envelope post-abm-a"></span>
            </li>
            <li class="post-abm-btn">
                <span class="glyphicon glyphicon-stats post-abm-a"></span>
            </li>
        </ul>
    </div>
    <div id="postMobileAdd" class="post-abm-trigger" data-state="0">
        <span class="glyphicon glyphicon-plus post-abm-add"></span>
    </div>
</div>