<?php
$dbool = '<option value="0">' . $_No . '</option>' . '<option value="1">' . $_Yes . '</option>';
?>
<form method="POST" enctype="multipart/form-data" id="form" class="contactform">
    <form method="POST" enctype="multipart/form-data" id="form">
        <input type="hidden" name="ID" id="ID" value="<?php echo (isset($dID)) ? $dID : 0; ?>" />
        <input type="hidden" name="User" id="User" value="<?php echo $pUser['ID']; ?>" />
        <p> <?php echo InputBox('Title', $_Title, (isset($dTitle) ? $dTitle : null)) ?> </p>
        <p>
            <?php echo Label('Picture', $_Picture) ?>
            <?php
            echo Img('Image', GetImageThumbnail(GetValue($dPicture)), 'class="img-polaroid pull-left" data-toggle="modal"');
            ?>
            <iframe src="<?php echo GetRewriteUrl($pID . '/UploadImage'); ?>" class="pull-left"></iframe>
            <?php echo InputHidden('Picture', GetValue($dPicture)) ?>
        </p>

        <div class="field_text">
            <?php echo DropDown('State', $_State, $dbool) ?>
        </div>

        <div class="field_text">
            <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="button"', false) ?>
        </div>
    </form>