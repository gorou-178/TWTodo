<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/22
 * Time: 20:23
 * To change this template use File | Settings | File Templates.
 */

class FacebookLoginController extends LoginController {

    public function login() {
        $this->log("facebook login", "debug");
    }

    public function callback() {
        $this->log("facebook callback", "debug");
    }

}