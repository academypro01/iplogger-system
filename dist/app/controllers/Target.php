<?php

class Target extends Controller {
    public $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    public function add($data=null){
        if($data != null){
            $target_id = filter_var($data, FILTER_SANITIZE_STRING);
            $this->userModel->addInformation($target_id);
        }else{
            header("Location: ".URLROOT."errorPage/error");
        }
    }
}