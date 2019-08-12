<form method="POST" enctype="multipart/form-data" id="form" class="form">
    <input type="hidden" name="ID" id="ID" value="<?php echo (isset($did)) ? $did : 0; ?>" />
    <input type="hidden" name="UserID" id="UserID" value="<?php echo $pUser['ID']; ?>" />
    <p>
        <?php echo InputBox('Title', $_Title, (isset($dTitle) ? $dTitle : null)) ?>
    </p>
    <p>
        <?php echo TextArea('Contents', $_Contents, isset($dContents) ? $dContents : null) ?>
    </p>
    <p>
        <label for="State"><?php echo $_State; ?></label>
        <?php echo CheckBox('State', isset($dState) ? ($dState == 1 ? true : false) : false) ?>
        <span class="Error" id="err-State"></span>
    </p>
    <p class="form-actions">
        <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="btn btn-large btn-primary"', false) ?> 
        <?php echo Anchor(ADM_BASE . $pID, $_Back, 'class="btn btn-large btn-danger"') ?> 
    </p> 
</form>