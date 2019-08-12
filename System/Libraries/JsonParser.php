<?php

/**
 * Description of JsonParser
 *
 * @author MrAbdelrahman10
 */
class JsonParser {

    public $data = null;
    public $success = true;
    public $error = null;

    public function Response() {
        header('Content-type: application/json');
        $json = array(
            'success' => $this->success,
            'error' => $this->error,
            'data' => $this->data
        );
        echo json_encode($json);
        exit();
    }

    public function Request() {
        $json = file_get_contents('php://input');
        return json_decode($json);
    }

}