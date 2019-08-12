<?php
/**
 * Static Pages
 */
class pageController extends Controller {

    public function i($ID) {
        EchoJson($this->Model->GetByID(intval($ID)));
    }

}