<div class="col-md-12">
    <?php
    if ($dResults) {
        $i = &$dResults;
        ?>
        <h2><?php echo Anchor(GetRewriteUrl($pUrl, $i['Alias']), $dTitle); ?></h2>
        <div class="clearfix"></div>
        <div class="col-md-10 col-md-offset-1">
            <?php echo $i['Contents']; ?>
        </div>
        <div class="ch25"></div>
        <div class="post-foot well">
            <h4><?php echo $_Share ?></h4>
            <div class="social">
                <?php
                ShareInit();
                ShareIt();
                ?>
            </div>
        </div>
        <hr />
        <div class="clearfix"></div>
        <?php
    }
    ?>
</div>