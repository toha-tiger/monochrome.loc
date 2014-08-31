<?php

class Page_userprofile implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome userprofile',
        'title' => 'Profile',
    );

    function show() {
        $user = new Users();
        if (!$user->is_logged()) {
            Redirect::to('login');
        }
        $this->metas['title'] = $user->profile->login . ' profile';

        $validate_rules = array(
            'email' => array(
                'required' => true,
                'email' => true,
                'one_unique' => array('users', $user->profile->email)
            ),
            'login' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
                'one_unique' => array('users', $user->profile->login)
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
                if ($user->update($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "{$user->profile->login}, your profile is updated";
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $user->errors;
                }
            }
        }

        include 'template/userprofile.php';
    }
}
