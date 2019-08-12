<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $_['_Lang']; ?>"><!--<![endif]-->
    <head>
        <base href="<?php echo SITE_URL; ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $d['dTitle']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="<?php echo $d['dDescription']; ?>" />
        <meta name="keywords" content="<?php echo $d['dKeywords']; ?>" />
        <meta name="author" content="<?php echo $s['sSite_Name']; ?>" />
        <meta property="og:title" content="<?php echo $d['dTitle']; ?>" />
        <meta property="og:url" content="<?php echo $d['pUrl']; ?>" />
        <meta property="og:image" content="<?php echo $d['pImage']; ?>" />
        <meta property="og:site_name" content="<?php echo $s['sSite_Name']; ?>" />
        <meta property="og:description" content="<?php echo $d['dDescription']; ?>" />

        <link rel="canonical" href="<?php echo $d['pfUrl']; ?>" />
        <meta name="copyright" content="<?php echo $s['sSite_Name']; ?>" />
        <meta name="Classification" content="<?php echo $s['sSite_Name']; ?>" />
        <meta name="DC.language" scheme="UTF-8" content="<?php echo $_['_Lang']; ?>" />
        <meta name="dcterms.contributor" content="<?php echo $d['pfUrl']; ?>" />
        <meta name="dcterms.coverage" content="Women" />
        <meta name="dcterms.creator" content="<?php echo $d['pfUrl']; ?>" />
        <meta name="dcterms.description" content="<?php echo $d['dDescription']; ?>" />
        <meta name="dcterms.format" content="text/html" />
        <meta name="dcterms.identifier" content="<?php echo $d['pfUrl']; ?>" />
        <meta name="dcterms.publisher" content="<?php echo $s['sSite_Name']; ?>" />
        <meta name="dcterms.rights" content="<?php echo $s['sSite_Name']; ?>" />
        <meta name="dcterms.source" content="<?php echo $s['sSite_Name']; ?>" />
        <meta name="dcterms.subject" content="<?php echo $d['dTitle']; ?>" />
        <meta name="dcterms.title" content="<?php echo $d['dTitle']; ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php echo SITE_URL; ?>RSS" />
        <link rel="icon" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>img/favicon.ico" />

        <link rel="dns-prefetch" href="//connect.facebook.net" />
        <link rel="dns-prefetch" href="//s-static.ak.facebook.com" />
        <link rel="dns-prefetch" href="//ssl.google-analytics.com" />
        <link rel="dns-prefetch" href="//cm.g.doubleclick.net" />
        <link rel="dns-prefetch" href="//stats.g.doubleclick.net" />
        <link rel="dns-prefetch" href="//www.facebook.com" />

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>style.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>styles/icons.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>styles/animate.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>styles/responsive.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>styles/rtl.css" media="screen" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>

            <!-- Favicon -->
            <link rel="shortcut icon" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>images/favicon.ico" />
            <link rel="apple-touch-icon" href="<?php echo APP_CURRENT_URL_TEMPLATE; ?>images/apple-touch-icon.png" />

            <!--[if IE]>
                    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
                    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
    </head>
    <body>
        <div id="layout" class="boxed">
            <header id="header">
                <div class="a_head">
                    <div class="row clearfix">
                        <div class="breaking_news righter">
                            <div class="freq_out">
                                <div class="freq"><div class="inner_f"></div><div id="layerBall"></div></div>
                            </div><!-- /freq -->
                            <ul id="js-news-rtl" class="js-hidden">
                                <?php echo $d['dTicker']; ?>
                            </ul><!-- /js news -->
                        </div><!-- /breaking news -->

                        <div class="right_bar">

                            <div class="social social_head">
                                <a href="https://twitter.com/<?php echo $s['sTwitter']; ?>" class="bottomtip" target="_blank" title="Twitter"><i class="fa-twitter"></i></a>
                                <a href="https://fb.com/<?php echo $s['sFacebook']; ?>" class="bottomtip" target="_blank" title="Facebook"><i class="fa-facebook"></i></a>
                                <a href="https://plus.google.com/<?php echo $s['sGoogle_Plus']; ?>" target="_blank" class="bottomtip" title="Google Plus"><i class="fa-google-plus"></i></a>
                                <a href="https://www.youtube.com/channel/<?php echo $s['sYoutube']; ?>" target="_blank" class="bottomtip" title="Youtube"><i class="fa-youtube"></i></a>
                                <a href="<?php echo SITE_URL; ?>RSS/feed.xml" target="_blank" class="bottomtip" title="RSS"><i class="fa-rss"></i></a>
                            </div><!-- /social -->

                            <span id="date_time"></span><!-- /date -->
                        </div><!-- /right bar -->
                    </div><!-- /row -->
                </div><!-- /a head -->

                <div class="b_head">
                    <div class="row clearfix">
                        <div class="logo">
                            <a href="<?php echo GetRewriteUrl('home'); ?>" title="<?php echo $s['sSite_Name']; ?>">
                                <img src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>images/logo.png" alt="<?php echo $s['sSite_Name']; ?>" />
                            </a>
                        </div><!-- /logo -->

                        <div class="ads">
                            <?php echo GetBanner($d['dBanners'], 'Header'); ?>
                        </div><!-- /ads -->
                    </div><!-- /row -->
                </div><!-- /b head -->

                <div class="row clearfix">
                    <div class="sticky_true">
                        <div class="c_head clearfix">
                            <nav>
                                <?php echo $d['dMainMenu']; ?>
                                <!-- /menu -->
                            </nav><!-- /nav -->

                            <div class="right_icons">
                                <a class="random_post bottomtip" href="<?php echo GetRewriteUrl('news/i'); ?>" title="Random Post"><i class="icon-media-shuffle"></i></a><!-- /random post -->

                                <div class="search">
                                    <div class="search_icon"><i class="fa-search"></i></div>
                                    <div class="s_form">
                                        <form action="<?php echo GetRewriteUrl('news'); ?>" id="search" method="get">
                                            <input id="inputhead" name="q" type="text" placeholder="<?php echo $_['_SearchWord']; ?> ...">
                                                <button type="submit"><i class="fa-search"></i></button>
                                        </form><!-- /form -->
                                    </div><!-- /s form -->
                                </div><!-- /search -->
                            </div><!-- /right icons -->
                        </div><!-- /c head -->
                    </div><!-- /sticky -->
                </div><!-- /row -->
            </header><!-- /header -->

            <div class="page-content">
                <div class="row clearfix">
                    <div class="grid_9 alpha">
                        <?php include_once $PageContents; ?>
                    </div><!-- end grid9 -->

                    <div class="grid_3 omega sidebar sidebar_a">
                        <div class="widget">
                            <?php echo GetBanner($d['dBanners'], 'Left1'); ?>
                        </div><!-- widget -->

                        <div class="widget">
                            <div class="ads_widget clearfix">
                                <?php echo GetBanner($d['dBanners'], 'Left2'); ?>
                                <div class="righter mt"><?php echo GetBanner($d['dBanners'], 'Left3'); ?></div>
                                <div class="lefter mt"><?php echo GetBanner($d['dBanners'], 'Left4'); ?></div>
                            </div><!-- widget -->
                        </div><!-- widget -->

                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_MostViewed']; ?></h4></div>

                            <div class="small_slider_hots owl-carousel owl-theme">
                                <?php
                                $j = 1;
                                $mvs = array_chunk($d['dMostViewed'], 4);
                                foreach ($mvs as $mv) {
                                    ?>
                                    <div class="item clearfix">
                                        <ul class="small_posts">
                                            <?php
                                            foreach ($mv as $i) {
                                                ?>
                                                <li class="clearfix">
                                                    <a class="s_thumb hover-shadow" href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                                        <img width="70" height="70" src="<?php echo GetImageThumbnail($i['Picture'], 70, 70); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                                                        <span><?php echo $j; ?></span>
                                                    </a>
                                                    <h3>
                                                        <?php echo Anchor(GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']), $i['Title']); ?>
                                                    </h3>
                                                    <div class="meta mb">
                                                        <?php
                                                        echo Anchor(GetRewriteUrl('news/c/' . $i['Category']), $i['CategoryName'], 'class="cat color' . $j . '"');
                                                        ?>
                                                    </div>
                                                </li>
                                                <?php
                                                $j++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /slides -->
                        </div><!-- /widget -->


                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_Facebook']; ?></h4></div>
                            <?php
                            FBInit();
                            FBLikeBox($s['sFacebook'], $s['sSite_Name']);
                            ?>
                        </div> <!-- widget -->
                        <!--                        <div class="widget">
                                                    <div class="title"><h4><?php echo $_['_Poll']; ?></h4></div>
                        <?php
                        $dpa = GetValue($d['dPollAnswered']);
                        if (!$dpa) {
                            ?>
                                                                <div class="wp-polls" id="site-poll">
                                                                    <form class="wp-polls-form" action="<?php echo GetRewriteUrl('home/poll') ?>" method="post">
                                                                        <p class="tac"><strong><?php echo $d['dPoll']['Q']; ?></strong></p>
                                                                        <div class="wp-polls-ans">
                                                                            <ul class="wp-polls-ul">
                            <?php
                            foreach ($d['dAns'] as $a) {
                                ?>
                                                                                            <li>
                                                                                                <input type="radio" name="poll_choice" value="<?php echo $a['ID']; ?>" />
                                                                                                <label><?php echo $a['A']; ?></label>
                                                                                            </li>
                                <?php
                            }
                            ?>
                                                                            </ul>
                                                                            <input type="button" name="vote" value="<?php echo $_['_PollNow']; ?>" class="Buttons" onclick="$('#frm-poll').submit();" />
                                                                            <input type="button" name="results" value="   <?php echo $_['_PollResults']; ?>   " class="Buttons" />
                                                                        </div>
                                                                    </form>
                                                                </div>
                            <?php
                        } else {
                            include APP_CURRENT_PAGES_TEMPLATE . 'home/poll.php';
                        }
                        ?>
                                                </div> widget -->

                    </div><!-- /grid3 sidebar A -->
                </div><!-- /row -->
            </div><!-- /end page content -->

            <footer id="footer">
                <div class="row clearfix">
                    <div class="grid_3">
                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_About']; ?></h4></div>
                            <p>
                                <?php echo $s['sDescription']; ?>
                                <br /><br />
                                <?php echo $_['_Email']; ?>:	<a href="mailto:<?php echo $s['sEmail']; ?>"><?php echo $s['sEmail']; ?></a>
                            </p>
                        </div><!-- /widget -->
                    </div><!-- /grid3 -->

                    <div class="grid_3">
                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_LastNews']; ?></h4></div>
                            <ul class="small_posts">
                                <?php
                                $j = 1;
                                $LNews = array_slice($d['dLastArticles'], 0, 3);
                                foreach ($LNews as $i) {
                                    ?>
                                    <li class="clearfix">
                                        <a class="s_thumb hover-shadow" href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                            <img width="70" height="70" src="<?php echo GetImageThumbnail($i['Picture'], 70, 70); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                                        </a>
                                        <h3><a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>"><?php echo $i['Title']; ?></a></h3>
                                        <div class="meta mb">
                                            <a class="cat color<?php echo $j; ?>" href="<?php echo GetRewriteUrl('news/c/' . $i['Category'], $i['CategoryAlias']); ?>" title="<?php echo $i['CategoryName']; ?>"><?php echo $i['CategoryName']; ?></a>
                                        </div>
                                    </li>
                                    <?php
                                    $j++;
                                }
                                ?>
                            </ul>
                        </div><!-- /widget -->
                    </div><!-- /grid3 -->

                    <div class="grid_3">
                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_MostViewed']; ?></h4></div>
                            <ul class="small_posts">
                                <?php
                                $j = 4;
                                $LNews = array_slice($d['dMostViewed'], 0, 3);
                                foreach ($LNews as $i) {
                                    ?>
                                    <li class="clearfix">
                                        <a class="s_thumb hover-shadow" href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>">
                                            <img width="70" height="70" src="<?php echo GetImageThumbnail($i['Picture'], 70, 70); ?>" alt="<?php echo $i['PictureDescription']; ?>" />
                                        </a>
                                        <h3><a href="<?php echo GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']); ?>"><?php echo $i['Title']; ?></a></h3>
                                        <div class="meta mb">
                                            <a class="cat color<?php echo $j; ?>" href="<?php echo GetRewriteUrl('news/c/' . $i['Category'], $i['CategoryAlias']); ?>" title="<?php echo $i['CategoryName']; ?>"><?php echo $i['CategoryName']; ?></a>
                                        </div>
                                    </li>
                                    <?php
                                    $j++;
                                }
                                ?>
                            </ul>
                        </div><!-- /widget -->
                    </div><!-- /grid3 -->

                    <div class="grid_3">
                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_MailingList']; ?></h4></div>
                            <form style="border:1px solid #ccc;padding:3px;text-align:center;" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=sethanem', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                                    return true">
                                <p><?php echo $_['_Email']; ?> :</p>
                                <p><input type="text" style="width:140px" name="email"/></p><input type="hidden" value="sethanem" name="uri"/><input type="hidden" name="loc" value="en_US"/>
                                <input type="submit" value="<?php echo $_['_Subscribe']; ?>" />
                            </form>
                        </div><!-- /widget -->

                        <div class="widget">
                            <div class="title"><h4><?php echo $_['_Follow']; ?></h4></div>
                            <div class="social">
                                <a href="https://twitter.com/<?php echo $s['sTwitter']; ?>" target="_blank" class="bottomtip" title="Twitter"><i class="fa-twitter"></i></a>
                                <a href="https://fb.com/<?php echo $s['sFacebook']; ?>" target="_blank" class="bottomtip" title="Facebook"><i class="fa-facebook"></i></a>
                                <a href="https://plus.google.com/<?php echo $s['sGoogle_Plus']; ?>" target="_blank" class="bottomtip" title="Google Plus"><i class="fa-google-plus"></i></a>
                                <a href="https://www.youtube.com/channel/<?php echo $s['sYoutube']; ?>" target="_blank" class="bottomtip" title="Youtube"><i class="fa-youtube"></i></a>
                                <a href="<?php echo SITE_URL; ?>RSS/feed.xml" target="_blank" class="bottomtip" title="RSS"><i class="fa-rss"></i></a>
                            </div><!-- /social -->
                        </div><!-- /widget -->
                    </div><!-- /grid3 -->

                </div><!-- /row -->

                <div class="row clearfix">
                    <div class="footer_last">
                        <span class="copyright">© <?php echo $_['_Copyright']; ?></span>

                        <div id="toTop" class="toptip" title="Back to Top"><i class="icon-arrow-thin-up"></i></div>
                    </div><!-- /last footer -->
                </div><!-- /row -->

            </footer><!-- /footer -->

        </div><!-- /layout -->

        <!-- Scripts -->
        <script type="text/javascript" src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>js/ipress.js"></script>
        <script type="text/javascript" src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>js/jquery.ticker.js"></script>
        <script type="text/javascript" src="<?php echo APP_CURRENT_URL_TEMPLATE; ?>js/custom.js"></script>
        <script type="text/javascript">
                                /* <![CDATA[ */
                                function date_time(id) {
                                    date = new Date;
                                    year = date.getFullYear();
                                    month = date.getMonth();
                                    months = new Array(<?php echo "'" . $_['_January'] . "','" . $_['_February'] . "','" . $_['_March'] . "','" . $_['_April'] . "','" . $_['_May'] . "','" . $_['_June'] . "','" . $_['_Jully'] . "','" . $_['_August'] . "','" . $_['_September'] . "','" . $_['_October'] . "','" . $_['_November'] . "','" . $_['_December'] . "'"; ?>);
                                    d = date.getDate();
                                    day = date.getDay();
                                    days = new Array(<?php echo "'" . $_['_Sunday'] . "','" . $_['_Monday'] . "','" . $_['_Tuesday'] . "','" . $_['_Wednesday'] . "','" . $_['_Thursday'] . "','" . $_['_Friday'] . "','" . $_['_Saturday'] . "'"; ?>);
                                    h = date.getHours();
                                    if (h < 10) {
                                        h = "0" + h;
                                    }
                                    m = date.getMinutes();
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    s = date.getSeconds();
                                    if (s < 10) {
                                        s = "0" + s;
                                    }
                                    result = '' + days[day] + ' ' + months[month] + ' ' + d + ' ' + year + ' ' + h + ':' + m + ':' + s;
//                                    result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year;
                                    document.getElementById(id).innerHTML = '<b dir="<?php echo $_['_Direction']; ?>">' + result + '</b>';
                                    setTimeout('date_time("' + id + '");', '1000');
                                    return true;
                                }
                                window.onload = date_time('date_time');
                                /* ]]> */
        </script>
        <?php echo $s['sExtraScripts']; ?>
    </body>
</html>