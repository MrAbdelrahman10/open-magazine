<?php
$out = Cache::Get('HomePage');
if (!$out) {
    ob_start();
    ?>


    <div class="ipress_slider mbf">
        <div class="slider_a owl-carousel owl-theme">
            <?php
            $Sliders = array_chunk($d['dSlideShow'], 3);
            $k = 1;
            foreach ($Sliders as $Sldr) {
                ?>
                <div class="item clearfix">
                    <?php
                    $j = 1;
                    foreach ($Sldr as $i) {
                        $h = $j == 1 ? 500 : 250;
                        ?>
                        <div class="half">
                            <div class="slide_details">
                                <a class="cat color<?php echo $k; ?>" href="<?php echo GetRewriteUrl('news/c/' . $i['Category'], $i['CategoryAlias']); ?>" title="<?php echo $i['CategoryName']; ?>"><?php echo $i['CategoryName']; ?></a>
                                <span class="post_rating" title="<?php echo $i['CreatedDate']; ?>"><i class="fa fa-calendar"></i>
                                    <?php echo $_['_Since'] . ' ' . GetSinceTiming($i['CreatedDate']); ?>
                                </span>
                                <h3>
                                    <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>" title="<?php echo $i['Title']; ?>"><?php echo $i['Title']; ?></a>
                                </h3>
                            </div>
                            <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                <img src="<?php echo GetImageThumbnail($i['Picture'], 600, $h); ?>" alt="" />
                            </a>
                        </div><!-- /half -->
                        <?php
                        $j++;
                        $k++;
                    }
                    ?>
                </div><!-- /slide -->
                <?php
            }
            ?>
        </div><!-- /slider -->
    </div><!-- /slider ipress -->

    <div class="grid_8 omega posts righter">
        <?php
        /*
          <div class="post_day mbf clearfix">
          <div class="title colordefault"><h4>Post Of The Day</h4></div>

          <div class="grid_6 alpha relative">
          <a class="cat" href="#" title="View all posts under Travel">Travel</a>
          <a class="hover-shadow" href="single_post.html"><img src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>images/assets/r_4.jpg" alt=""></a>
          </div><!-- /grid6 alpha -->

          <div class="grid_6 omega">
          <div class="post_day_content">
          <h3> <a href="single_post.html">Here's What Instagram Ads Will Look Like</a> </h3>
          <div class="meta mb"> 3 hours ago    /    <a href="single_post.html">0 comments</a> </div>
          <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry unknown printer took a galley of type and scrambled it to make a type has survived not only fiv... </p>
          </div><!-- /post content -->
          </div><!-- /grid6 omega -->
          </div><!-- /post day -->
         */
        ?>
        <?php
        $jc = 1;
        $n = array_slice($d['dLastNews'], 0, 1);
        $c = $n[0]['Category'];
        $ps = $n[0]['Posts'];
        if ($ps) {
            ?>
            <div class="posts_block mbf clearfix">
                <div class="title color<?php echo $jc ?>">
                    <h4><?php echo $c['Name']; ?></h4>
                    <a href="#" class="feed toptip" title="RSS Feed"><i class="icon-feed"></i></a>
                </div><!-- /title bar -->
                <?php
                $i = GetValue($ps[0]);
                if ($i) {
                    ?>
                    <div class="grid_6 alpha">
                        <div class="mb hover-shadow">
                            <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                <img src="<?php echo GetImageThumbnail($i['Picture'], 280, 200); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                            </a>
                        </div>
                        <div class="post_m_content">
                            <h3>
                                <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>" title="<?php echo $i['Title']; ?>"><?php echo $i['Title']; ?></a>
                            </h3>
                            <div class="meta mb"> <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?> </div>
                            <p> <?php echo substr($i['Description'], 0, 50); ?>... </p>
                        </div><!-- post content -->
                    </div><!-- /grid6 omega -->
                    <?php
                }
                if ($ps) {
                    ?>

                    <div class="grid_6 omega">
                        <div class="small_slider_music owl-carousel owl-theme">
                            <div class="item clearfix">
                                <ul class="small_posts">
                                    <?php
                                    $ps = array_slice($n[0]['Posts'], 1, 4);
                                    foreach ($ps as $i) {
                                        ?>
                                        <li class="clearfix">
                                            <a class="s_thumb hover-shadow" href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                                <img width="70" height="70" src="<?php echo GetImageThumbnail($i['Picture'], 80, 80); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                                            </a>
                                            <h3>
                                                <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>" title="<?php echo $i['Title']; ?>"><?php echo $i['Title']; ?></a>
                                            </h3>
                                            <div class="meta mb"> <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?> </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div><!-- /slides -->
                    </div><!-- grid6 omega -->
                    <?php
                }
                ?>
            </div><!-- posts block Music -->
            <?php
        }
        ?>

        <?php
        $jc++;
        $n = array_slice($d['dLastNews'], 1, 1);
        $c = $n[0]['Category'];
        $ps = $n[0]['Posts'];
        if ($ps) {
            ?>
            <div class="posts_block mbf clearfix">
                <div class="title color<?php echo $jc ?>">
                    <h4><?php echo $c['Name']; ?></h4>
                    <a href="#" class="feed toptip" title="RSS Feed"><i class="icon-feed"></i></a>
                </div>

                <div class="carousel_TV">
                    <?php
                    foreach ($ps as $i) {
                        ?>
                        <div class="item hover-shadow">
                            <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                <img class="toptip" src="<?php echo GetImageThumbnail($i['Picture'], 280, 200); ?>" alt="<?php echo $i['PictureDescription']; ?>" title="<?php echo $i['Title']; ?>" />
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div><!-- posts block carousel -->
            <?php
        }
        ?>

        <div class="ads_block mbf">
            <?php GetBanner($d['dBanners'], 'Home'); ?>
        </div><!-- ads block -->

        <?php
        $ns = array_slice($d['dLastNews'], 2, 5);
        foreach ($ns as $n) {
            $jc++;
            $c = $n['Category'];
            $ps = $n['Posts'];
            if ($ps) {
                ?>
                <div class="posts_block mbf clearfix">
                    <div class="title color<?php echo $jc ?>">
                        <h4><?php echo $c['Name']; ?></h4>
                        <a href="#" class="feed toptip" title="RSS Feed"><i class="icon-feed"></i></a>
                    </div><!-- /title bar -->
                    <?php
                    $i = GetValue($ps[0]);
                    if ($i) {
                        ?>
                        <div class="grid_6 alpha">
                            <div class="mb hover-shadow">
                                <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                    <img src="<?php echo GetImageThumbnail($i['Picture'], 280, 200); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                                </a>
                            </div>
                            <div class="post_m_content">
                                <h3>
                                    <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>" title="<?php echo $i['Title']; ?>"><?php echo $i['Title']; ?></a>
                                </h3>
                                <div class="meta mb"> <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?> </div>
                                <p> <?php echo substr($i['Description'], 0, 50); ?>... </p>
                            </div><!-- post content -->
                        </div><!-- /grid6 omega -->
                        <?php
                    }
                    if ($ps) {
                        ?>

                        <div class="grid_6 omega">
                            <div class="small_slider_music owl-carousel owl-theme">
                                <div class="item clearfix">
                                    <ul class="small_posts">
                                        <?php
                                        $ps = array_slice($n['Posts'], 1, 4);
                                        foreach ($ps as $i) {
                                            ?>
                                            <li class="clearfix">
                                                <a class="s_thumb hover-shadow" href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                                    <img width="70" height="70" src="<?php echo GetImageThumbnail($i['Picture'], 80, 80); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                                                </a>
                                                <h3>
                                                    <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>" title="<?php echo $i['Title']; ?>"><?php echo $i['Title']; ?></a>
                                                </h3>
                                                <div class="meta mb"> <?php echo $_['_Since'] . GetSinceTiming($i['CreatedDate']); ?> </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div><!-- /slides -->
                        </div><!-- grid6 omega -->
                        <?php
                    }
                    ?>
                </div><!-- posts block Music -->
                <?php
            }
        }
        ?>

    </div><!-- end grid9 -->

    <div class="grid_4 alpha sidebar sidebar_b">
        <div class="widget">
            <div class="title"><h4><?php echo $_['_Video']; ?></h4></div>
            <?php
            $i = GetValue($d['dLastVideos'][0]);
            if ($i) {
                ?>
                <iframe width="280" height="158" src="//www.youtube.com/embed/<?php echo $i['Url']; ?>" frameborder="0" allowfullscreen></iframe>
                <?php
                echo Anchor(GetRewriteUrl('video/i/' . $i['ID']), $i['Title']);
            }
            ?>
        </div><!-- widget -->


        <div class="widget">
            <div class="title"><h4><?php echo $_['_Selected_Articles']; ?></h4></div>
            <?php
            foreach ($d['dResults'] as $i) {
                ?>
                <div class="relative hover-shadow mb">
                    <a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                        <img src="<?php echo GetImageThumbnail($i['Picture'], 280, 250); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                    </a>
                    <div class="r_content">
                        <a class="cat color<?php echo $k; ?>" href="<?php echo GetRewriteUrl('news/c/' . $i['Category'], $i['CategoryAlias']); ?>" title="<?php echo $i['CategoryName']; ?>"><?php echo $i['CategoryName']; ?></a>
                        <div class="r_title"><a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>" title="<?php echo $i['Title']; ?>"><?php echo $i['Title']; ?></a></div>
                    </div>
                </div><!-- relative -->
                <?php
            }
            ?>
        </div><!-- widget -->

        <div class="widget">
            <div class="title"><h4><?php echo $_['_Tags']; ?></h4></div>
            <div class="tags">
                <?php
                $Tags = explode(',', $s['sKeywords']);
                foreach ($Tags as $i) {
                    echo Anchor(GetRewriteUrl('news') . '?q=' . $i, $i);
                }
                ?>
            </div>
        </div><!-- widget -->
        <?php
        /*
          <div class="widget">
          <div class="title"><h4>Like Us</h4></div>
          <div class="bg_light">
          <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fenvato&amp;width=313&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=true&amp;appId=138798126277575" height="292"></iframe>
          </div>
          </div><!-- widget -->
         */
        ?>
    </div><!-- end grid9 -->

    <?php
    $out = ob_get_contents();
    Cache::Set('HomePage', $out);
    ob_end_clean();
}
echo $out;
