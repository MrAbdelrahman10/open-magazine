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
            <label><?php echo $_Category; ?></label>
            <?php echo $d['Name']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Alias; ?></label>
            <?php echo $d['Alias']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_ParentCategory; ?></label>
            <?php echo $d['ParentName']; ?>
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
            <?php echo CheckBox('State', $d['State'], null, null, false) ?>
        </div>
    </div>
    <?php
}