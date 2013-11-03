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

class TwitterLoginController extends LoginController {

    public function login() {
        $this->log("twitter login", "debug");

        Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
        $cb = Codebird::getInstance();

        if (! isset($_SESSION['oauth_token'])) {

            $this->autoRender = false;
            $this->autoLayout = false;

            // get the request token
            $reply = $cb->oauth_requestToken(array(
                'oauth_callback' => 'http://ec2-54-249-212-16.ap-northeast-1.compute.amazonaws.com/TWTodo/login/callback'
            ));
            // var_dump($reply);
            $this->log(get_object_vars($reply), "debug");
            // store the token
            $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
            $_SESSION['oauth_token'] = $reply->oauth_token;
            $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
            $_SESSION['oauth_verify'] = true;

            // redirect to auth website
            $auth_url = $cb->oauth_authorize();
            header('Location: ' . $auth_url);
            die();
            
        } elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {

            Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
            $cb = Codebird::getInstance();

            // verify the token
            $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
            unset($_SESSION['oauth_verify']);

            // get the access token
            $reply = $cb->oauth_accessToken(array(
                'oauth_verifier' => $_GET['oauth_verifier']
            ));

            // store the token (which is different from the request token!)
            $_SESSION['oauth_token'] = $reply->oauth_token;
            $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

            $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);

            $me = $cb->account_verifyCredentials();
            $this->log(get_object_vars($me), "debug");
            //var_dump($me);

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
                    $this->Session->write("Users.me", $twUser);
                }
            } else {
                // セッションハイジャック対策
//                session_regenerate_id(true);
                $this->Session->write("Users.me", $twUser);

            }
            return $this->redirect(array("controller"=>"todos", "action"=>"index"));
        }

        $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    }

    public function callback() {
        $this->log("twitter callback", "debug");
        $this->autoRender = false;
        $this->autoLayout = false;

        if (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {

            Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
            $cb = Codebird::getInstance();

            // verify the token
            $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
            unset($_SESSION['oauth_verify']);

            // get the access token
            $reply = $cb->oauth_accessToken(array(
                'oauth_verifier' => $_GET['oauth_verifier']
            ));

            // store the token (which is different from the request token!)
            $_SESSION['oauth_token'] = $reply->oauth_token;
            $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

            $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);

            $me = $cb->account_verifyCredentials();
            $this->log(get_object_vars($me), "debug");
            //var_dump($me);

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
                    $this->Session->write("Users.me", $twUser);
                }
            } else {
                // セッションハイジャック対策
//                session_regenerate_id(true);
                $this->Session->write("Users.me", $twUser);

            }
            return $this->redirect(array("controller"=>"todos", "action"=>"index"));
        }

        die();
        // $twUser = "てすとてすと";
        // $this->Session->write("User.me", $twUser);
        // return $this->redirect(array("controller"=>"Todos", "action"=>"index"));
    }



}