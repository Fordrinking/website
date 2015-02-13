
<div class="head-bar-c">
    <div class="head-bar">
        <?php if (isset($_SESSION[SESSION_PREFIX.'loggedin']) &&
        $_SESSION[SESSION_PREFIX.'loggedin']) { ?>
        <div class="h-search left">
        <?php } else { ?>
        <div class="h-logo">
        <?php } ?>
            <img class="h-search-img left" src="<?php echo \helpers\url::template_path() . 'assets/img/fordrinking-logo.png' ?>">
        </div>
        <div class="h-search-item left">
            <input class="h-search-i" type="text" id="h-search-input" placeholder="search and find">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </div>
        <div class="h-user">
            <div class="h-tab-row collapse" id="userNavRow">
                <?php if (isset($_SESSION[SESSION_PREFIX.'loggedin']) &&
                    $_SESSION[SESSION_PREFIX.'loggedin']) { ?>
                    <div id="h-tab-avatar" class="tab">
                        <img class="h-nav-avatar" src="<?php echo $data['avatar']; ?>">
                        <span class="h-nav-username"><?php echo $data['username']; ?></span>
                    </div>
                <?php } else { ?>

                <?php } ?>
                <div class="tab">
                    <a href="/home">
                        <em class="h-icon glyphicon glyphicon-home"></em>
                        <em class="h-tab-s">Home</em>
                    </a>
                </div>
                <div class="tab">
                    <a href="/explore">
                        <em class="h-icon glyphicon glyphicon-globe"></em>
                        <em class="h-tab-s">Explore</em>
                    </a>
                </div>
                <?php if (isset($_SESSION[SESSION_PREFIX.'loggedin']) &&
                          $_SESSION[SESSION_PREFIX.'loggedin']) { ?>
                    <div id="h-tab-divider" class="tab">
                        <i></i>
                    </div>
                    <div id="h-tab-message" class="tab">
                        <a href="/message">
                            <em class="h-icon glyphicon glyphicon-envelope"></em>
                            <em class="h-tab-s">Message</em>
                        </a>
                    </div>
                    <div id="h-tab-account" class="tab">
                        <a href="/account/dashboard">
                            <em class="h-icon glyphicon glyphicon-dashboard"></em>
                            <em class="h-tab-s">Account</em>
                        </a>
                    </div>
                    <div id="h-tab-auth" class="tab">
                        <a href="/logout">
                            <em class="h-icon glyphicon glyphicon-off"></em>
                            <em class="h-tab-s">Logout</em>
                        </a>
                    </div>
                    <div id="h-tab-action" class="tab pos-rel">
                        <a id="userSettingBtn" data-state="0">
                            <em class="h-icon glyphicon glyphicon-user"></em>
                        </a>
                        <div id="userSetting">
                            <ul>
                                <li class="mar-tb-10">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    <span class="mar-l-10"><a href="/account/dashboard" class="h-user-s-a">Account</a></span>
                                </li>
                                <li class="mar-tb-10">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                    <span class="mar-l-10"><a href="/help" class="h-user-s-a">Help</a></span>
                                </li>
                                <li class="mar-tb-10">
                                    <span class="glyphicon glyphicon-off"></span>
                                    <span class="mar-l-10"><a href="/logout" class="h-user-s-a">Logout</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } else { ?>

                <?php } ?>
            </div>
            <div class="h-nav" id="navBtn" data-state="0">
                <span class="glyphicon glyphicon-th-large"></span>
            </div>
        </div>
    </div>
</div>