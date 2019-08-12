<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-video-camera"></i>
        <?php
        echo Anchor(GetRewriteUrl($d['psUrl']), $d['dTitle']);
        ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            foreach ($d['dResults'] as $i) {
                ?>
                <div class="col-md-6 img-thumbnail">
                    <a href="http://www.youtube.com/watch?v=<?php echo $i['Url']; ?>" rel="prettyPhoto[vid_gal]">
                        <img src="http://i.ytimg.com/vi/<?php echo $i['Url']; ?>/hqdefault.jpg" alt="<?php echo $i['Title']; ?>" class="media-object img-responsive" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php
                            echo Anchor(GetRewriteUrl('video/i/' . $i['ID']), $i['Title'], 'title="' . $i['Title'] . '"');
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