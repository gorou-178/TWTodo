<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/22
 * Time: 20:19
 * To change this template use File | Settings | File Templates.
 */

App::import('Controller', 'Login');

class TwitterLoginController extends LoginController {

    public function login() {
        $this->log("twitter login", "debug");
        return $this->redirect(array("action"=>"callback"));
    }

    public function callback() {
        $this->log("twitter callback", "debug");
        $twUser = "てすとてすと";
        $this->Session->write("User.me", $twUser);
        return $this->redirect(array("controller"=>"Todos", "action"=>"index"));
    }

    

}