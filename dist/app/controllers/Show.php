<?php

class Show extends Controller {
    public $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    public function showInformation($data) {
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        $result = $this->userModel->show($data);
        $this->view("pages/show", $result);
    }
}