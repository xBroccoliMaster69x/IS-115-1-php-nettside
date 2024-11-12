<?php

class UserController extends Controller {
    public function index() {

        $userData = ['name' => 'Broc Olli', 'email' => 'Broc@BroccoliMail.com'];
        $this->view('user', $userData);
    }
}
