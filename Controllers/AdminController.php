<?php

class AdminController extends Controller {
    public function index() {

        $data = ['title' => 'Admin Page'];
        $this->view('admin', $data);  
    }
}