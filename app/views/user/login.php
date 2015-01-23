<div class="login-c">
    <div class="login">
        <?php echo \core\Error::display($error); ?>
        <form class="login-form" action='' method='post'>
            <div class="form-item" style="margin-bottom:1px">
                <input class="form-item-t" name="loginMail" type="text" value="<?php echo $data['email'] ?>" placeholder="Email">
            </div>
            <div class="form-item">
                <input class="form-item-t" name="loginPass" type="password" placeholder="Password">
            </div>
            <div class="form-submit">
                <input class="form-btn" name="loginBtn" type="submit" value="Log in">
            </div>
            <div id="login-extra" class="form-item">
                <a href="/">Not have an Account? Sign up</a>
            </div>
        </form>

    </div>
</div>


