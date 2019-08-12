<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo$_Register; ?></h3>
            <div class="form">
                <form id="form" action="<?php echo GetRewriteUrl('profile/signin') ?>" method="post">
                    <p class="contact"><label for="Email"><?php echo $_Email ?></label></p>
                    <input id="Email" name="Email" placeholder="<?php echo $_Email ?>" type="text">
                    <p><span class="error" id="err-Email"></span></p>

                    <br>
                    <?php echo Anchor('javascript:void(0)', $_Restore_Password, 'onclick="$(\'#form\').submit();" class="buttom" id="submit"', false) ?>
                </form>
            </div>
        </div>
    </div><!-----------internal-------------->
</div>
