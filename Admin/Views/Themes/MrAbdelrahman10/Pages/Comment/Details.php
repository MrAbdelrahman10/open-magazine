<div id="details">
    <p>
        <label><?php echo $_UserName; ?></label>
       <?php echo $dUserName; ?>
    </p>
    <p>
        <label><?php echo $_Email; ?></label>
       <?php echo $dEmail; ?>
    </p>
    <p>
        <label><?php echo $_Title; ?></label>
        <?php echo $dTitle; ?>
    </p>
    <p>
        <label><?php echo $_Contents; ?></label>
        <?php echo $dContents; ?>
    </p>
    <p>
        <label><?php echo $_CreatedDate; ?></label>
        <?php echo $dCreatedDate; ?>
    </p>
    <p>
        <label for="State"><?php echo $_State; ?></label>
        <?php echo CheckBox('State', $dState, 'data-State="false"') ?>
    </p>
</div>