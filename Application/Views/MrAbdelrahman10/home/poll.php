<div id="poll-container">
    <p class="tac"><strong><?php echo $dPoll['Q']; ?></strong></p>
    <div class="pull-right">
        <?php
        $total = 0;
        $count = count($dAns);
        for ($i = 0; $i < $count; $i++) {
            $total = $total + $dAns[$i]['Value'];
        }
        for ($i = 0; $i < count($dAns); $i++) {
            $a = $dAns[$i];
            $w = $total > 0 ? (int) (($a['Value'] / $total) * 100) : 0;
            ?>
            <h4><?php echo $a['A']; ?></h4>
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-success pull-right" role="progressbar" aria-valuenow="<?php echo $w; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $w; ?>%">
                    <span class="sr-only"><?php echo $w; ?>% <?php echo $a['Title']; ?></span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>