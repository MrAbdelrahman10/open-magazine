<div class="col-md-12">
    <?php
    if ($d['dResults']) {
        $i = &$d['dResults'];
        ?>
        <h2><?php echo Anchor(GetRewriteUrl($d['psUrl']), $d['dTitle']); ?></h2>
        <div class="clearfix"></div>
        <ul class="list-inline">
            <li class="inline">
                <i class="glyphicon glyphicon-calendar"></i> <?php echo $i['CreatedDate']; ?>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div class="img-thumbnail col-md-10 col-md-offset-1">
            <a href="<?php echo GetImageOriginal($i['Picture']); ?>" rel="prettyPhoto[i_gal]">
                <img src="<?php echo GetImageOriginal($i['Picture']); ?>" alt="<?php echo $i['Title']; ?>" class="img-responsive" />
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="post-foot well">
            <h4><?php echo $_['_Share']; ?></h4>
            <div class="social">
                <?php
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