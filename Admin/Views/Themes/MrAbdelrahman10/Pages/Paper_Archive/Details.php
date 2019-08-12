<?php
if (GetValue($dRow)) {
    $d = &$dRow;
    ?>
    <div id="details">
        <div class="formRow">
            <label><?php echo $_Title; ?></label>
            <?php echo $d['Title']; ?>
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
            <label for="State"><?php echo $_State; ?></label>
            <?php echo CheckBox('State', $d['State'], null, null, false); ?>
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
        <hr class="clearfix" />
    </div>
    <?php
}
?>