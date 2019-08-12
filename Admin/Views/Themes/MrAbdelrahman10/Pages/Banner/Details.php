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
            <label><?php echo $_BannerName; ?></label>
            <?php echo $d['Name']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_CreatedDate; ?></label>
            <?php echo $d['CreatedDate']; ?>
        </div>
        <div class="formRow">
            <label for="State"><?php echo $_State; ?></label>
            <?php echo CheckBox('State', $d['State'], null, null, false) ?>
        </div>
    </div>
    <?php
}