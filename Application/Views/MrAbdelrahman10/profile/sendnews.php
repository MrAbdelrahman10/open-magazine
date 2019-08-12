<div id="wraper_all">
    <div id="wraper-internal">
        <div id="register">
            <h3><?php echo $_AddPost; ?></h3>
            <?php
            $dbool = '<option value="0">' . $_No . '</option>' . '<option value="1">' . $_Yes . '</option>';
            ?>
            <div class="form">
                <form id="form" action="<?php echo GetRewriteUrl($psUrl) ?>" method="post">

                    <p class="contact"><label for="Title"><?php echo $_Title ?></label></p>
                    <input id="Title" name="Title" placeholder="<?php echo $_Title ?>" type="text" value="<?php echo GetValue($daTitle); ?>">
                    <?php echo InputHidden('Alias', GetValue($dAlias)); ?>
                    <p><span class="error" id="err-Title"></span></p>

                    <p class="contact"><label for="Contents"><?php echo $_Contents ?></label></p>
                    <textarea id="Contents" name="Contents" placeholder="<?php echo $_Contents ?>" class="editor"><?php echo GetValue($dContents); ?></textarea>
                    <p><span class="error" id="err-Contents"></span></p>

                    <p class="contact"><label for="Category"><?php echo $_Category ?></label></p>
                    <select name="Category" id="Category">
                        <?php echo $dPostCategories; ?>
                    </select>
                    <p><span class="error" id="err-Category"></span></p>

                    <?php echo Label('Picture', $_Picture) ?>
                    <?php
                    echo
                    Img('Image', GetImageThumbnail(GetValue($dPicture)), 'class="img-polaroid pull-left" data-toggle="modal"');
                    ?>
                    <iframe src="<?php echo GetRewriteUrl('General/UploadImage'); ?>" class="pull-left"></iframe>
                    <?php echo InputHidden('Picture', GetValue($dPicture)) ?>

                    <p class="contact"><label for="State"><?php echo $_State ?></label></p>
                    <select name="State" id="State">
                        <?php echo $dbool; ?>
                    </select>
                    <p><span class="error" id="err-State"></span></p>

                    <br>
                    <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="buttom" id="submit"', false) ?>
                </form>
            </div>
        </div>
    </div><!-----------internal-------------->
</div>
<?php

?>