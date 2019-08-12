<div class="col-md-12">
    <?php
    if ($dResults) {
        $i = &$dResults;
        ?>
        <h2><?php echo Anchor(GetRewriteUrl($d['psUrl']), $d['dTitle']); ?></h2>
        <div class="clearfix"></div>
        <ul class="list-inline">
            <li class="inline">
                <i class="glyphicon glyphicon-calendar"></i> <?php echo $i['CreatedDate']; ?>
            </li>
            <li class="inline">
                <i class="glyphicon glyphicon-camera"></i>
                <?php echo $i['Viewed']; ?>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="ch20"></div>
        <div class="col-md-12">
            <?php echo $i['Description']; ?>
        </div>
        <div class="col-md-12">
            <?php
            $Pics = unserialize($i['SliderPictures']);
            foreach ($Pics as $p) {
                ?>
                <div class="col-md-6 img-thumbnail">
                    <a href="<?php echo GetImageOriginal($p); ?>" rel="prettyPhoto[i_gal]">
                        <img src="<?php echo GetImageThumbnail($p, 250, 250); ?>" alt="<?php echo $i['Title']; ?>" class="media-object img-responsive" />
                    </a>
                </div>
                <?php
            }
            ?>
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
    <div class="row">
        <div class="text-center">
            <?php FBComments($pUrl); ?>
        </div>
    </div>
</div>