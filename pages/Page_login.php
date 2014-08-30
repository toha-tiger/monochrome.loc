<?php

class Page_login implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome login',
        'title' => 'Login',
    );

    public $message;
    public $data;

    function show() {

        $user = new Users();
        if ($user->is_logged()) {
            Redirect::to('index');
            exit;
        }
        $validate_rules = array(
            'login' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            )
        );
        if (!empty($_POST)) {
            $this->data = $_POST;
            $validate = new Validate();
            $validate->check($_POST, $validate_rules);
            if (count($validate->errors)) {
                $this->message['class'] = 'alert-danger';
                $this->message['text'] = $validate->errors;
            } else {
//                $user = new Users();
                if ($user->login($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "Welcome, {$user->profile->login}";
                    $this->message['text'][] = lib::js_redirect('userprofile');
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $user->errors;
                }
            }
        }
        include "template/login.php";
    }
}