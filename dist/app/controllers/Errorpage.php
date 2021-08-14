<?php

class Errorpage extends Controller {
    public function error() {
        $this->view("pages/error");
    }
}