<?php

class Page_registration implements Pages {
    function show() {
        if (!empty($_POST)) {
            $user = new Users();
            $user_info = array('email' => lib::get_post_var('email'),
                'login' => lib::get_post_var('login'),
                'password' => lib::get_post_var('password'),
                'confirmation' => lib::get_post_var('confirmation'),
                'birthday' => lib::get_post_var('birthday'),
                'fav_color' => lib::get_post_var('fav_color'));
            if ($user->registration($user_info)){
                $message_class = 'alert-success';
            } else {
                $message_class = 'alert-danger';
            }
            $message = $user->message;
        }
        include "template/registration.html";
    }
}