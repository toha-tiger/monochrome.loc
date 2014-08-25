<?php

class Page_registration implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome registration',
        'title' => 'Registration',
    );

    function show() {
        if (!empty($_POST)) {
            $validate = new Validate();
            $validate->check($_POST, array(
                'email' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 4,
                    'max' => 50,
                ),
                'confirmation' => array(
                    'required' => true,
                    'match' => 'password'
                ),
                'color' => array(
                    'required' => true,
                    'set_in' => array('white', 'black'),
                )
            ));
            if (!$validate)
            {
                var_dump($validate->errors);
            }
            $user = new Users();
            $user_info = array(
                'email' => lib::get_post_var('email'),
                'login' => lib::get_post_var('login'),
                'password' => lib::get_post_var('password'),
                'confirmation' => lib::get_post_var('confirmation'),
                'birthday' => lib::get_post_var('birthday'),
                'color' => lib::get_post_var('color')
            );
            if ($user->registration($user_info)){
                $message_class = 'alert-success';
            } else {
                $message_class = 'alert-danger';
            }
            $message = $user->message;
        }
        include "template/registration.php";
    }
}