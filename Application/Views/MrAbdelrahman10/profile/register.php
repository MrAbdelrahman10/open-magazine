<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo$_Register; ?></h3>
            <div class="form">
                <form id="form" action="<?php echo GetRewriteUrl('profile/signin') ?>" method="post">
                    <p class="contact"><label for="UserName"><?php echo $_UserName ?></label></p>
                    <input id="UserName" name="UserName" placeholder="<?php echo $_UserName ?>" type="text">
                    <p><span class="error" id="err-UserName"></span></p>
                    <br />
                    <p class="contact"><label for="Password"><?php echo $_Password ?></label></p>
                    <input type="password" id="Password" name="Password" placeholder="<?php echo $_Password ?>">
                    <p><span class="error" id="err-Password"></span></p>
                    <br />
                    <p class="contact"><label for="FullName"><?php echo $_FullName ?></label></p>
                    <input id="FullName" name="FullName" placeholder="<?php echo $_FullName ?>" type="text">
                    <p><span class="error" id="err-FullName"></span></p>
                    <br />
                    <p class="contact"><label for="Email"><?php echo $_Email ?></label></p>
                    <input id="Email" name="Email" placeholder="<?php echo $_Email ?>" type="text">
                    <p><span class="error" id="err-Email"></span></p>

                    <br>
                    <?php echo Anchor('javascript:void(0)', $_Register, 'onclick="$(\'#form\').submit();" class="buttom" id="submit"', false) ?>
                </form>
            </div>
        </div>
    </div><!-----------internal-------------->
</div>
