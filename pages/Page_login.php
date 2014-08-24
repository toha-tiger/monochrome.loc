<?php

class Page_login implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome login',
        'title' => 'Login',
    );

    function show() {
        if (!empty($_POST)) {
            $user = new Users();
            $user_info = array(
                'login' => lib::get_post_var('login'),
                'password' => lib::get_post_var('password'),
                'rememberme' => lib::get_post_var('rememberme')
            );
            if ($user->login($user_info)){
                $message_class = 'alert-success';
            } else {
                $message_class = 'alert-danger';
            }
            $message = $user->message;
        }
        include "template/login.php";
    }
}