<?php

class Index extends Controller {
    public $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
        // $users = $this->userModel->showInformation('abc');
        // $data = [
        //     'title' => 'Home Page',
        //     'name'  => 'Majid',
        //     'data'  => $users,
        // ];
        $this->view('pages/index');
    }
}