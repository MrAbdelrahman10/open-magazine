<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo$_ChangeEmail; ?></h3>
            <div class="form">
                <form id="form" action="<?php echo GetRewriteUrl($psUrl) ?>" method="post">
                    <p class="contact"><label for="Email"><?php echo $_Email ?></label></p>
                    <input id="cEmail" name="cEmail" placeholder="<?php echo $_Email ?>" type="text" value="<?php echo $dEmail; ?>">
                    <p><span class="error" id="err-cEmail"></span></p>

                    <br>
                    <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="buttom" id="submit"', false) ?>
                </form>
            </div>
        </div>
    </div><!-----------internal-------------->
</div>
<?php

?>