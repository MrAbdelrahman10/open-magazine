<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-photo"></i>
        <?php
        echo Anchor(GetRewriteUrl($psUrl), $dTitle);
        ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            foreach ($dResults as $i) {
                ?>
                <div class="img-thumbnail col-md-6 col-md-offset-3">
                    <?php
                    echo Anchor(GetRewriteUrl('paper_archive/i/' . $i['ID']), Img('', GetImageOriginal($i['Picture']), 'class="img-responsive"')
                            , 'title="' . $i['Title'] . '" class="media-object" target="_blank"', false);
                    ?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php
                            echo Anchor(GetRewriteUrl('paper_archive/i/' . $i['ID']), $i['Title'], 'title="' . $i['Title'] . '" target="_blank"');
                            ?>
                        </h4>
                    </div>
                </div>
                <hr class="clearfix" />
                <?php
            }
            ?>
        </div>
        <?php echo $dRenderNav; ?>
    </div>
</div>