<?php
if (GetValue($dRow)) {
    $d = &$dRow;
    ?>
    <div id="details">
        <input type="hidden" name="ID" id="ID" value="<?php echo (isset($dID)) ? $dID : 0; ?>" />
        <div class="formRow">
            <label><?php echo $_Title; ?></label>
 		 <?php echo $d['Title']; ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Description; ?></label>
                <?php echo $d['Description']; ?>
        </div>
        <div class="formRow">
            <label for="State"><?php echo $_State; ?></label>
 	 <?php echo CheckBox('State', $_State, null, null, false) ?>
        </div>
        <div class="formRow">
            <label><?php echo $_Video; ?></label>
            <iframe width="500" height="315" src="http://www.youtube.com/embed/<?php echo $d['Url']; ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <?php
}
?>