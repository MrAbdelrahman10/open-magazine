<?php

/**
 * Description of ThemeController
 *
 * @author abduo
 */
class ThemeController extends Controller implements ITheme {

    public function __construct() {
        parent::__construct();
        $this->GetBanners();
        $this->GetCategories();
        $this->GetFooterLinks();
        $this->GetLastGallery();
        $this->GetLastArticles();
        $this->GetLastComic();
        $this->GetLastVideos();
        $this->GetMainMenu();
//        $this->GetMostCommented();
        $this->GetMostViewed();
        $this->GetPages();
        $this->GetPoll();
        $this->GetTicker();
    }

    public function GetArticlesOnly() {
        $ArticlesOnly = Cache::Get('ArticlesOnly');
        if (!$ArticlesOnly) {
            $ArticlesOnly = $this->Model->GetArticlesOnly();
            Cache::Set('ArticlesOnly', $ArticlesOnly);
        }
        $this->Data['dArticlesOnly'] = $ArticlesOnly;
    }

    public function GetBanners() {
        //GetBannerPositions
        $BannerPositions = $this->GetBannerPositions();

        //Banner
        $Banners = Cache::Get('Banners');
        if (!$Banners) {
            foreach ($BannerPositions as $p) {
                $Bnrs = $this->Model->GetBanners($p['ID']);
                $Ads = array();
                foreach ($Bnrs as $Item) {
                    if ($Item['BannerType'] == BannerType::Code) {
                        $Ads[] = $Item['BannerCode'];
                    } else {
                        $Ads[] = Anchor($Item['Url'], Img('ads-' . $Item['ID'], GetImageThumbnail($Item['Picture'], $p['Width'], $p['Height']), 'class="img-responsive"'), 'target="_blank"', false);
                    }
                }

                $Banners[$p['BannerPositionAlias']] = $Ads;
            }
            Cache::Set('Banners', $Banners);
        }
        $this->Data['dBanners'] = $Banners;
    }

    public function GetCategories() {
//Categories
        $Categories = Cache::Get('Categories');
        if (!$Categories) {
            $Categories = $this->Model->GetCategories();
            Cache::Set('Categories', $Categories);
        }
        $this->Data['dCategories'] = $Categories;
    }

    public function GetFooterLinks() {
        //Categories
        $fCategories = Cache::Get('Categories-Footer');
        if (!$fCategories) {
            $fCategories = $this->BuildFooterCatgories($this->Model->GetFooterCategories(), $this->Model->GetAllPages());
            Cache::Set('Categories-Footer', $fCategories);
        }
        $this->Data['dFooterCategories'] = $fCategories;
    }

    public function GetLastAlbums() {
        $LastAlbums = Cache::Get('LastAlbums');
        if (!$LastAlbums) {
            $LastAlbums = $this->Model->GetLatestPhotoAlbum();
            Cache::Set('LastAlbums', $LastAlbums);
        }
        $this->Data['dLastAlbums'] = $LastAlbums;
    }

    public function GetLastArticles() {
        $LastArticles = Cache::Get('LastArticles');
        if (!$LastArticles) {
            $LastArticles = $this->Model->GetLastArticles();
            Cache::Set('LastArticles', $LastArticles);
        }
        $this->Data['dLastArticles'] = array_slice($LastArticles, 0, 4);
    }

    public function GetLastComic() {
        $LastComic = Cache::Get('LastComic');
        if (!$LastComic) {
            $LastComic = $this->Model->GetLastComic();
            Cache::Set('LastComic', $LastComic);
        }
        $this->Data['dLastComic'] = $LastComic;
    }

    public function GetMainMenu() {
        //Menu
        $Menus = Cache::Get('MainMenu');
        if (!$Menus) {
            $Menus = '<ul class="sf-menu">' . $this->BuildHTMLMenu($this->BuildMenu()) . '</ul>';
            Cache::Set('MainMenu', $Menus);
        }
        $this->Data['dMainMenu'] = $Menus;
    }

    public function GetMostViewed() {
//MostViewedPosts
        $MostViewedPosts = Cache::Get('MostViewedPosts');
        if (!$MostViewedPosts) {
            $MostViewedPosts = $this->Model->GetMostViewedArticles();
            Cache::Set('MostViewedPosts', $MostViewedPosts);
        }
        $this->Data['dMostViewed'] = $MostViewedPosts;
    }

    public function GetPages() {
//Page
        $Page = Cache::Get('Page');
        if (!$Page) {
            $Page = $this->Model->GetAllPages();
            Cache::Set('Page', $Page);
        }
        $this->Data['dPages'] = $Page;
    }

    public function GetPoll() {
        //Poll
        $Poll = Cache::Get('poll');
        if (!$Poll) {
            $Poll = $this->Model->GetLastPoll();
            Cache::Set('poll', $Poll);
        }
        $this->Data['dPoll'] = $Poll;
        $this->Data['dcPollID'] = $Poll['ID'];

        $pollres = Cookie::Get('poll-' . $Poll['ID']);
        $this->Data['dAns'] = $Poll['Ans'];
        $this->Data['dQ'] = $Poll['Q'];
        if ($pollres) {
            $this->Data['dState'] = $Poll['State'];
            $this->Data['dPollAnswered'] = 'Yes';
        }
    }

    public function GetTicker() {
//Ticker
        $Ticker = Cache::Get('Ticker');
        if (!$Ticker) {
            $Articles = $this->Model->GetLastArticles();
            foreach ($Articles as $i) {
                $Ticker .= '<li class="news-item">' . Anchor(GetRewriteUrl('news/i/' . $i['ID'], $i['Alias']), $i['Title']) . '</li>';
            }
            Cache::Set('Ticker', $Ticker);
        }
        $this->Data['dTicker'] = $Ticker;
    }

    public function BuildFooterCatgories($Categories, $Pages) {
        $Output = '';
        $Cats = array_chunk($Categories, 9);
        $j = 1;
        foreach ($Cats as $Cs) {
            $Output .= '<div class="cat-ftr-cont-sngl lefty cat-brd-5"><ul>';
            foreach ($Cs as $i) {
                $Output .= '<li>' . Anchor(BASE_URL . 'news/c' . $i['ID'], $i['Name']) . '</li>';
            }
            $Output .= '</ul>
                    </div>';
            $j++;
        }
        return $Output;
    }

    private function BuildHTMLMenu($Menus, $ID = null, $i = 1) {
        $Output = '';
        foreach ($Menus as $Item) {
            if ($Item['Parent'] == $ID) {
                if ($Item['IsParent'] == true && !$Item['Parent']) {
                    $Output .= '<li class="color' . $i . '">' .
                            Anchor($this->SetMenuLink($Item['Link']), $Item['Title']) . '<ul>';
                    $Output .= $this->BuildHTMLMenu($Menus, $Item['ID']);
                    $Output .= '</ul></li>';
                    $i++;
                } elseif ($Item['Parent']) {
                    $Output .= '<li>' . Anchor($this->SetMenuLink($Item['Link']), $Item['Title']) . '</li>';
                } else {
                    if (strstr($Item['Link'], 'home/index') || $Item['Link'] == 'home') {
                        $Output .= '<li class="current colordefault home_class">
      <a href="' . GetRewriteUrl('home') . '"><i class="icon-home"></i></a></li>';
                    } else {
                        $Output .= '<li class="color' . $i . '">' . Anchor($this->SetMenuLink($Item['Link']), $Item['Title']) . '</li>';
                        $i++;
                    }
                }
            }
        }
        return $Output;
    }

    public function GetLastVideos() {
        $LastVideos = Cache::Get('LastVideos');
        if (!$LastVideos) {
            $LastVideos = $this->Model->GetLastVideos();
            Cache::Set('LastVideos', $LastVideos);
        }
        $this->Data['dLastVideos'] = $LastVideos;
    }

    public function GetLastGallery() {

    }

}