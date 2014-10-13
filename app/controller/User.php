<?php

class User extends Controller {
    public $data = array();

    public function show() {
        if (!$this->user->is_logged()) {
            Redirect::to('login');
        }
        $this->metas['title'] = $this->user->profile->login . ' profile';

        $validate_rules = array(
            'email' => array(
                'required' => true,
                'email' => true,
                'one_unique' => array('users', $this->user->profile->email)
            ),
            'login' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
                'one_unique' => array('users', $this->user->profile->login)
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
                if ($this->user->update($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "{$this->user->profile->login}, your profile is updated";
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $this->user->errors;
                }
            }
        }
        $this->render_view('User/userprofile');
    }

    public function registration()
    {
        $this->metas = array(
        'meta_title' => 'Monochrome registration',
        'title' => 'Registration',
        );

        if ($this->user->is_logged()) {
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
                if ($this->user->registration($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "Thank you for registration, {$this->data['login']}";
                    $this->message['text'][] = lib::js_redirect('user', 'login');
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $this->user->errors;
                }
            }
        }
        $this->render_view('User/registration');
    }

    public function login() {
        $this->metas = array(
            'meta_title' => 'Monochrome login',
            'title' => 'Login',
        );
        if ($this->user->is_logged()) {
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
                if ($this->user->login($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "Welcome, {$this->user->profile->login}";
                    $this->message['text'][] = lib::js_redirect('user');
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $this->user->errors;
                }
            }
        }
        $this->render_view('User/login');
    }

    public function logout() {
        if ($this->user->is_logged()) {
            $this->user->logout();
        }
        Redirect::to('index');
    }

    public function changepassword() {
        $this->metas = array(
            'meta_title' => 'Monochrome userprofile',
            'title' => 'Profile',
        );

        if (!$this->user->is_logged()) {
            Redirect::to('login');
        }
        $this->metas['title'] = $this->user->profile->login . ' change password';

        $validate_rules = array(
            'oldpassword' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
                'min' => 4,
                'max' => 50,
            ),
            'confirmation' => array(
                'required' => true,
                'match' => 'password',
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
                if ($this->user->changepassword($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "{$this->user->profile->login}, your password has been changed";
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $this->user->errors;
                }
            }
        }
        $this->render_view('User/changepassword');
    }
}