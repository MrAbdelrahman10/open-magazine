<p>
    <?php echo Label('Picture', $_Picture) ?>
    <?php
    echo Img('Image', GetImageThumbnail(GetValue($dPicture)));
    ?>
    <iframe src="<?php echo GetRewriteUrl($pID . '/UploadImage'); ?>"></iframe>
    <?php echo InputHidden('Picture', GetValue($dPicture)) ?>
    <span class="Error" id="err-Picture"></span>
</p>