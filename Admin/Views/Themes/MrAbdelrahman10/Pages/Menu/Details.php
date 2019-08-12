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
            <label><?php echo $_ParentMenu; ?></label>
            <?php GetValue($d['ParentName']); ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Link; ?></label>
            <?php echo $d['Link']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Description; ?></label>
            <?php echo $d['Description']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_SortingOrder; ?></label>
            <?php echo $d['SortingOrder']; ?>
        </div>
        <div class="formRow">
            <label for="State"><?php echo $_State; ?></label>
            <?php echo CheckBox('State', $d['State'], null, null, false); ?>
        </div>
    </div>
    <?php
}