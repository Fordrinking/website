
<div class="head-bar-c">
    <div class="head-bar">
        <?php if (isset($_SESSION[SESSION_PREFIX.'loggedin']) &&
        $_SESSION[SESSION_PREFIX.'loggedin']) { ?>
        <div class="h-search left">
        <?php } else { ?>
        <div class="left">
        <?php } ?>
            <img class="h-search-img left" src="<?php echo \helpers\url::template_path() . 'assets/img/fordrinking-logo.png' ?>">
        </div>
        <div class="h-search-item left">
            <input class="h-search-i" type="text" id="h-search-input" placeholder="search and find">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </div>
        <div class="h-user right">
            <div class="h-tab-row collapse" id="userNavRow">
                <a class="tab left">
                    <em class="h-icon glyphicon glyphicon-home"></em>
                    <em class="h-tab-s">Home</em>
                </a>
                <a class="tab left">
                    <em class="h-icon glyphicon glyphicon-globe"></em>
                    <em class="h-tab-s">Explore</em>
                </a>
                <?php if (isset($_SESSION[SESSION_PREFIX.'loggedin']) &&
                          $_SESSION[SESSION_PREFIX.'loggedin']) { ?>
                    <div class="left h-user-action">
                        <div class="tab left">
                            <a class="glyphicon glyphicon-envelope" href="#"></a>
                        </div>
                        <div id="userSettingBtn" class="tab left pos-rel" data-state="0">
                            <a class="glyphicon glyphicon-user" href="#"></a>
                            <div id="userSetting">
                                <ul>
                                    <li class="mar-tb-10">
                                        <span class="glyphicon glyphicon-cog"></span>
                                        <span class="mar-l-10"><a href="/account/dashboard" class="h-user-s-a">Account</a></span>
                                    </li>
                                    <li class="mar-tb-10">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                        <span class="mar-l-10"><a href="#" class="h-user-s-a">Help</a></span>
                                    </li>
                                    <li class="mar-tb-10">
                                        <span class="glyphicon glyphicon-off"></span>
                                        <span class="mar-l-10"><a href="/logout" class="h-user-s-a">Logout</a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>

                <?php } ?>
            </div>
            <?php if (isset($_SESSION[SESSION_PREFIX.'loggedin']) &&
            $_SESSION[SESSION_PREFIX.'loggedin']) { ?>
            <div class="h-tab-avatar">
                <img class="h-nav-avatar" src="<?php echo $data['avatar']; ?>">
                <span class="h-nav-username"><?php echo $data['username']; ?></span>
            </div>
            <?php } else { ?>

            <?php } ?>
            <div class="h-nav" id="navBtn" data-state="0">
                <span class="glyphicon glyphicon-th-large"></span>
            </div>
        </div>
    </div>
</div>