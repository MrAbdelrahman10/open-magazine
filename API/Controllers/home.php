<?php

/**
 * home page
 */
class homeController extends Controller {

    /**
     * @link http://mrabdelrahman10.com/home/index_m
     * @return array return array of SlideShow News And Featured News <br />
     * Featured News are array of array contain Category And news in this Category
     * @example http://mrabdelrahman10.com/home/index_m
     */
    public function last() {
        EchoJson($this->Model->GetFeaturedArticles());
    }

    /**
     * @link http://mrabdelrahman10.com/home/slideshow
     * @return array return array of SlideShow News <br />
     * @example http://mrabdelrahman10.com/home/slideshow
     */
    public function slideshow() {
        EchoJson($this->Model->GetSliderArticles());
    }

}