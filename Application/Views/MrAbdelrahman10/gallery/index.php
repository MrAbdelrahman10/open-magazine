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
                <div class="col-md-6 img-thumbnail">
                    <?php
                    echo Anchor(GetRewriteUrl('gallery/i/' . $i['ID']), Img('', GetImageOriginal($i['Picture']), 'class="img-responsive"')
                            , 'title="' . $i['Title'] . '" class="media-object"');
                    ?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php
                            echo Anchor(GetRewriteUrl('gallery/i/' . $i['ID']), $i['Title'], 'title="' . $i['Title'] . '"');
                            ?>
                        </h4>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php echo $dRenderNav; ?>
    </div>
</div>