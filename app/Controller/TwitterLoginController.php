<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/22
 * Time: 20:19
 * To change this template use File | Settings | File Templates.
 */

require_once ('codebird.php');
use Codebird\Codebird;

App::import('Controller', 'Login');
App::uses('User', 'Model');

class TwitterLoginController extends LoginController {

    private $cb = null;

    // コンポーネント
    public $components = array('Session', 'DebugKit.Toolbar');

    // コンストラクター
    public function __construct($request, $response) {
        parent::__construct($request, $response);
        Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
        $this->cb = Codebird::getInstance();
    }

    public function login() {
        $this->log("twitter login", "debug");

        if (! isset($_SESSION['oauth_token'])) {
            $this->log("twitter login: not oauth_token", "debug");
            $this->autoRender = false;
            $this->autoLayout = false;

            // get the request token
            $reply = $this->cb->oauth_requestToken(array(
                'oauth_callback' => 'http://ec2-54-249-212-16.ap-northeast-1.compute.amazonaws.com/TWTodo/login/callback'
            ));
            // var_dump($reply);
            $this->log(get_object_vars($reply), "debug");
            // store the token
            $this->cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
            $this->Session->write('oauth_token', $reply->oauth_token);
            $this->Session->write('oauth_token_secret', $reply->oauth_token_secret);
            $this->Session->write('oauth_verify', true);

            // $_SESSION['oauth_token'] = $reply->oauth_token;
            // $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
            // $_SESSION['oauth_verify'] = true;

            // redirect to auth website
            $auth_url = $this->cb->oauth_authorize();
            header('Location: ' . $auth_url);
            die();
            
        }

        // Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
        // $cb = Codebird::getInstance();
        $this->cb->setToken($this->Session->read('oauth_token'), $this->Session->read('oauth_token_secret'));
    }

    public function callback() {
        $this->log("twitter callback", "debug");
        $this->autoRender = false;
        $this->autoLayout = false;

        if (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
            $this->log("twitter callback: find oauth_verify", "debug");


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

            $this->cb->setToken($reply->oauth_token, $reply->oauth_token_secret);

            $me = $this->cb->account_verifyCredentials();
            $this->log(get_object_vars($me), "debug");

            $this->loadModel("User");
            $twUser = $this->User->find("all", array("conditions" => array("User.tw_user_id"=>$me->id_str)));
            if (!$twUser) {
                $twUser = new User();
                $twUser->tw_user_id = $me->id_str;
                $twUser->tw_screen_name = $me->screen_name;
                $twUser->tw_access_token = $reply->oauth_token;
                $twUser->tw_access_token_secret = $reply->oauth_token_secret;
                if ($this->User->save($twUser)) {
                    // セッションハイジャック対策
//                    session_regenerate_id(true);
                    $twUser = $this->User->findById($this->User->id);
                    $this->Session->write("User.me", $twUser);
                }
            } else {
                // セッションハイジャック対策
//                session_regenerate_id(true);
                $this->Session->write("User.me", $twUser);

            }
            return $this->redirect(array("controller"=>"todos", "action"=>"index"));
        } else {
            $this->log("twitter callback: no oauth_verify", "debug");
        }

        $this->cb->setToken($this->Session->read('oauth_token'), $this->Session->read('oauth_token_secret'));
        // $twUser = "てすとてすと";
        // $this->Session->write("User.me", $twUser);
        // return $this->redirect(array("controller"=>"Todos", "action"=>"index"));
    }



}