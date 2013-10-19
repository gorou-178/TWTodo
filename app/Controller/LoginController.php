<?php

require_once ('codebird.php');

use Codebird\Codebird;

define("CONSUMER_KEY", "nOcbpjvl3jUnB7ipKw8Rg");
define("CONSUMER_SECRET", "ygjLuY2QPKUcKJsHgdApaliO1Ssn6U3SH55lDtYNs");
define("SITE_URL", "http://gurimmer.lolipop.jp/app/twido/");

/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/08
 * Time: 13:28
 * To change this template use File | Settings | File Templates.
 */
class LoginController extends AppController {

    public $helpers = array('Form', 'Html', 'Session');
    private $cb = null;

    public function __construct($request, $response) {
        parent::__construct($request, $response);
        Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
        $this->cb = Codebird::getInstance();
    }

    public function index() {
        $this->log("login");
    }

    public function callback() {
        $this->log("callback");

        session_start();

        if (! isset($_SESSION['oauth_token'])) {
            // get the request token
            $reply = $this->cb->oauth_requestToken(array(
                'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
            ));

            // store the token
            $this->cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
            $_SESSION['oauth_token'] = $reply->oauth_token;
            $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
            $_SESSION['oauth_verify'] = true;

            // redirect to auth website
            $auth_url = $this->cb->oauth_authorize();
            header('Location: ' . $auth_url);
            die();

        } elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
            // verify the token
            $this->cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
            unset($_SESSION['oauth_verify']);

            // get the access token
            $reply = $this->cb->oauth_accessToken(array(
                'oauth_verifier' => $_GET['oauth_verifier']
            ));

            // store the token (which is different from the request token!)
            $_SESSION['oauth_token'] = $reply->oauth_token;
            $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

            $this->cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

            $me = $this->cb->account_verifyCredentials();
            var_dump($me);
            var_dump($_SESSION);

            // send to same URL, without oauth GET parameters
//            header('Location: ' . basename(__FILE__));
            die();
        }

        // assign access token on each page load
        $this->cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    }

}