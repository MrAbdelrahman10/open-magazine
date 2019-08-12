<?php
if (GetValue($dRow)) {
    $d = &$dRow;
    ?>
    <div id="details">
        <div class="formRow">
            <label><?php echo $_ID; ?></label>
            <?php echo $d['ID']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Title; ?></label>
            <?php echo $d['Title']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Alias; ?></label>
            <?php echo $d['Alias']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Contents; ?></label>
            <?php echo $d['Contents']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Description; ?></label>
            <?php echo $d['Description']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Keywords; ?></label>
            <?php echo $d['Keywords']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_PictureDescription; ?></label>
            <?php echo $d['PictureDescription']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Viewed; ?></label>
            <?php echo $d['Viewed']; ?>
        </div>
        <div class="formRow">
            <label for="Category"><?php echo $_Category; ?></label>
            <?php echo $d['CategoryName']; ?>
        </div>
        <div class="formRow">
            <label for="Picture"><?php echo $_Picture; ?></label>
            <img src="<?php echo GetImageThumbnail($d['Picture']); ?>" id="Image" name="Image" class="tumb" />
        </div>
        <div class="formRow">
            <label><?php echo $_CreatedDate; ?></label>
            <?php echo $d['CreatedDate']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_ModifiedDate; ?></label>
            <?php echo $d['ModifiedDate']; ?>
        </div>
        <div class="formRow">
            <label for="State"><?php echo $_State; ?></label>
            <?php echo CheckBox('State', $d['State'], null, null, false) ?>
        </div>
        <label><?php echo $_Photos; ?></label>
        <div class="col-md-12">
            <?php
            $Pics = unserialize($d['SliderPictures']);
            foreach ($Pics as $p) {
                echo Img('', GetImageThumbnail($p), 'class="col-md-3 img-responsive img-thumbnail"');
            }
            ?>
        </div>
    </div>
    <?php
}