<?php
if (GetValue($dRow)) {
    $d = &$dRow;
    ?>
    <div id="details">
        <input type="hidden" name="ID" id="ID" value="<?php echo (isset($dID)) ? $dID : 0; ?>" />
        <div class="formRow">
            <label><?php echo $_Q; ?></label>
            <?php echo $d['Q']; ?>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $_Answers; ?></div>
            <div class="panel-body">
                <div id="Answers">
                    <?php
                    $arr = GetValue($d['Answers']);
                    $Total = 0;
                    foreach ($arr as $a) {
                        $Total += $a['Value'];
                    }
                    $c = count($arr);
                    $Total = $Total > 0 ? $Total : 1;
                    foreach ($arr as $r) {
                        $bar = round(($r['Value'] / $Total) * 100, 2);
                        ?>
                        <div class="col-sm-12">
                            <label class="col-sm-12">
                                <b class="pull-right"><?php echo $r['A']; ?></b>
                                <i class="pull-left"><?php echo $r['Value']; ?></i>
                            </label>
                            <span class="clearfix"></span>
                            <div class="progress progress-bar-danger">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $bar; ?>" aria-valuemin="0" aria-valuemax="<?php echo $Total; ?>" style="width: <?php echo $bar; ?>%;">
                                    <?php echo $bar; ?>%
                                </div>
                            </div>
                            <hr class="clearfix" />
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="formRow">
            <label for="State"><?php echo $_State; ?></label>
            <?php echo CheckBox('State', $d['State'], null, null, false); ?>
        </div>
        <hr class="clearfix" />
    </div>
    <?php
}
?>