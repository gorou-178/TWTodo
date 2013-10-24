<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/22
 * Time: 20:19
 * To change this template use File | Settings | File Templates.
 */

class TwitterLoginController extends LoginController {

    public function login() {
        $this->log("twitter login", "debug");
    }

    public function callback() {
        $this->log("twitter callback", "debug");
    }

}