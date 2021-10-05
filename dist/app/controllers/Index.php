<?php

class Index extends Controller {
    public $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
        $this->view('pages/index');
    }
}