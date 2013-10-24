<?php
App::uses("User", "Model");

/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/08
 * Time: 13:28
 * To change this template use File | Settings | File Templates.
 */
class LoginController extends AppController {

    public $helpers = array('Form', 'Html', 'Session');

//    // TODO 必要かどうか不明
//    public $autoRender = false;
//    public $autoLayout = false;

    public function login() {
        $this->log("login", "debug");
    }

    public function logout() {
        $this->log("logout", "debug");
    }

    public function callback() {
        $this->log("callback", "debug");
    }

}