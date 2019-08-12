<?php

/**
 * home page
 */
class homeController extends Controller {

    private function gSlideShow() {
        $SlideShow = Cache::Get('SlideShow');
        if (!$SlideShow) {
            $SlideShow = $this->Model->GetSliderArticles();
            Cache::Set('SlideShow', $SlideShow);
        }
        return $SlideShow;
    }

    private function gFeatured() {
        $Featured = Cache::Get('Featured');
        if (!$Featured) {
            $Featured = $this->Model->GetFeaturedArticles();
            Cache::Set('Featured', $Featured);
        }
        return $Featured;
    }

    private function gIndex() {
        $Data = Cache::Get('HomeCategory');
        if (!$Data) {
            $allcats = $this->Model->GetHomeCategory();
            foreach ($allcats as $c) {
                if ($c['HPSO'] > 0) {
                    $Posts = $this->Model->GetArticleByCategory($c['ID']);
                    if ($Posts) {
                        $Data[] = array('Category' => $c,
                            'Posts' => $Posts);
                    }
                }
            }
            Cache::Set('HomeCategory', $Data);
        }
        return $Data;
    }

    /**
     *
     */
    public function index() {
        $this->Data['dTitle'] = $this->Settings['sSite_Name'];

        $this->Data['dLastNews'] = $this->gIndex();
        $this->Data['dSlideShow'] = $this->gSlideShow();
        $this->Data['dResults'] = $this->gFeatured();

        $this->View->Render();
    }

    /**
     * @link http://mrabdelrahman10.com/home/index_m
     * @return array return array of SlideShow News And Featured News <br />
     * Featured News are array of array contain Category And news in this Category
     * @example http://mrabdelrahman10.com/home/index_m
     */
    public function index_m() {
        EchoJson($this->gIndex());
    }

    /**
     * @link http://mrabdelrahman10.com/home/slideshow
     * @return array return array of SlideShow News <br />
     * @example http://mrabdelrahman10.com/home/slideshow
     */
    public function slideshow() {
        EchoJson($this->gSlideShow());
    }

    /**
     * @link http://mrabdelrahman10.com/home/notification
     * @return array return array of Mobile Notification News <br />
     * @example http://mrabdelrahman10.com/home/notification
     */
    public function notification() {
        EchoJson($this->Model->GetNotifications());
    }

    public function poll() {
        if (Request::IsPost()) {

            $Poll = $this->Model->GetLastPoll();

            $rData = array();
            $rData['PollID'] = $Poll['ID'];
            $rData['ID'] = $this->Filter($_POST['ans']);
            $this->Model->UpdatePoll($rData);
        }
        $Data = $this->Model->GetLastPoll();
        $this->Data['dQ'] = $Data['Q'];
        $this->Data['dState'] = $Data['State'];
        $this->Data['dAns'] = $Data['Ans'];
        $this->View->RenderOnly();
    }

    /**
     *
     */
    public function error() {
        $this->Data['dTitle'] = $this->_['_PageNotFound'];
        $this->View->Render();
    }

    /**
     *
     */
    public function pray() {
        $this->Data['dTitle'] = $this->_['_Pray'];
        $this->View->Render();
    }

    /**
     *
     */
    public function weather() {
        $this->Data['dTitle'] = $this->_['_Weather'];
        $this->View->Render();
    }

    /**
     *
     */
    public function currency() {
        $this->Data['dTitle'] = $this->_['_Currency'];
        $this->View->Render();
    }

    /**
     *
     */
    public function stock() {
        $this->Data['dTitle'] = $this->_['_Stock'];
        $this->View->Render();
    }

    /**
     *
     */
    public function contactus() {
        $this->Data['dTitle'] = $this->_['_Contact'];
        if (Request::IsPost()) {
            require APP_LIB . 'Mail.php';
            $s = $_POST['mName'];
            $m = $_POST['mMessage'];
            $e = $_POST['mEmail'];
            $Subject = $this->Filter($s);
            $Message = $this->Filter($m);
            $Mail = new Mail();
            $Mail->Subject = $Subject . ' From: ' . $e;
            $Mail->Body = $Message;
            $Mail->From = $e;
            $Mail->FromName = $this->Settings['sSite_Name'];
            $Mail->To = $this->Settings['sEmail'];
            $Mail->Send();
            $this->Data['dMsg'] = $this->_['_SendedSuccessfully'];
        }
        $this->View->Render();
    }

}