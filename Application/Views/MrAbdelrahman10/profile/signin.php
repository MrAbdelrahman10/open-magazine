<div id="login">
    <div class="ten columns center">
        <h1><?php echo $_SignIn; ?></h1>
        <?php
            if (isset($dError)) {
                ?>
        <h3 class="error"><?php echo $dError ?></h3>
                <?php
            }
            ?>
        <form method="post" action="<?php echo GetRewriteUrl('profile/signin'); ?>" id="loginform" name="loginform">
            <div class="form-line">
                <i class="fa fa-user"></i>
                <input type="text" size="20" class="input" id="user_login" name="l-UserName" placeholder="<?php echo $_UserName ?>">
            </div>
            <div class="form-line">
                <i class="fa fa-lock"></i>
                <input type="password" size="20" class="input" id="user_pass" name="l-Password" placeholder="<?php echo $_Password ?>">
            </div>
            <input type="submit" value="<?php echo $_SignIn ?>" id="member-login" class="btn">
        </form>
    </div>
</div>