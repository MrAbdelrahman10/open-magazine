<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo$_ChangePassword; ?></h3>
            <div class="form">
                <form id="form" action="<?php echo GetRewriteUrl($psUrl) ?>" method="post">
                    <p class="contact"><label for="OldPassword"><?php echo $_OldPassword ?></label></p>
                    <input id="cOldPassword" name="cOldPassword" placeholder="<?php echo $_OldPassword ?>" type="text">
                    <p><span class="error" id="err-cOldPassword"></span></p>

                    <p class="contact"><label for="Password"><?php echo $_NewPassword ?></label></p>
                    <input id="cPassword" name="cPassword" placeholder="<?php echo $_NewPassword ?>" type="text">
                    <p><span class="error" id="err-cPassword"></span></p>

                    <br>
                    <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="buttom" id="submit"', false) ?>
                </form>
            </div>
        </div>
    </div><!-----------internal-------------->
</div>
<?php

?>