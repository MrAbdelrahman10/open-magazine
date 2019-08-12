<?php
$dbool = '<option value="0">' . $_No . '</option>' . '<option value="1">' . $_Yes . '</option>';
?>
<form method="POST" enctype="multipart/form-data" id="form" class="contactform">
    <input type="hidden" name="ID" id="ID" value="<?php echo (isset($dID)) ? $dID : 0; ?>" /> 
    <div class="field_text"> 
        <?php echo InputBox('Title', $_Title, (isset($dTitle) ? $dTitle : null)) ?> 	
        <?php echo InputHidden('Alias', (isset($dAlias) ? $dAlias : null)) ?> 	 
    </div>
    <div class="field_text">
        <?php echo TextArea('Description', $_Description, GetValue($dDescription), null, 'maxlength="500" class="tags"') ?> 
    </div> 
    <div class="field_text"> 
        <?php echo InputBox('Url', $_Url, GetValue($dUrl)) ?> 	
    </div>
    <div class="field_text">
        <?php echo DropDown('State', $_State, $dbool) ?>
    </div>

    <div class="field_text">
        <?php echo Anchor('javascript:void(0)', $_Save, 'onclick="$(\'#form\').submit();" class="button"', false) ?>
    </div>
</form>