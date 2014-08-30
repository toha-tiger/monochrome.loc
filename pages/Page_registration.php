<?php

class Page_registration implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome registration',
        'title' => 'Registration',
    );
    public $message;
    public $data;

    function show() {
        $user = new Users();
        if ($user->is_logged()) {
            Redirect::to('index');
        }
        $validate_rules = array(
            'email' => array(
                'required' => true,
                'email' => true,
                'unique' => 'users'
            ),
            'login' => array(
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
            ),
            'birthday' => array(
                'required' => true,
                'date' => true,
                'preg' => '|\d{4}-\d{2}-\d{2}|'
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
                if ($user->registration($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "Thank you for registration, {$this->data['login']}";
                    $this->message['text'][] = lib::js_redirect('login');
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $user->errors;
                }
            }
        }
        include "template/registration.php";
    }
}