<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-birthday-cake"></i>
        <?php
        echo Anchor(GetRewriteUrl($d['psUrl']), $d['dTitle']);
        ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            foreach ($dResults as $i) {
                ?>
                <div class="col-md-6 img-thumbnail">
                    <a href="<?php echo GetImageOriginal($i['Picture']); ?>" rel="prettyPhoto[vid_gal]">
                        <img src="<?php echo GetImageThumbnail($i['Picture'], 340, 340); ?>" alt="<?php echo $i['Title']; ?>" class="media-object img-responsive" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php
                            echo Anchor(GetRewriteUrl('comic/i/' . $i['ID']), $i['Title'], 'title="' . $i['Title'] . '"');
                            ?>
                        </h4>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php echo $d['dRenderNav']; ?>
    </div>
</div>