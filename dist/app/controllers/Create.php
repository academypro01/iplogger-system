<?php

class Create extends Controller {
    public $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    public function index() {
        $this->view('pages/create');
    }
    public function create() {
        $data = $_POST['redirect_link'];
        $data = filter_var($data, FILTER_SANITIZE_URL);
        $this->userModel->addNewUser($data);
    }
}