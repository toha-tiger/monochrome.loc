<?php

class User extends Controller {
    public $data = array();

    public function show() {
        $user = new User_model();
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
        include '_template/userprofile.php';
    }

    public function registration()
    {
        $this->metas = array(
        'meta_title' => 'Monochrome registration',
        'title' => 'Registration',
        );
        $user = new User_model();
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
        $this->get_view('registration', array('user' => $user));
    }

    public function login() {
        $this->metas = array(
            'meta_title' => 'Monochrome login',
            'title' => 'Login',
        );
        $user = new User_model();
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
        $this->get_view('login', array('user' => $user));
    }

    public function logout() {
        $user = new User_model();
        if ($user->is_logged()) {
            $user->logout();
        }
        Redirect::to('index');
    }

    public function changepassword() {
        $this->metas = array(
            'meta_title' => 'Monochrome userprofile',
            'title' => 'Profile',
        );

        $user = new User_model();
        if (!$user->is_logged()) {
            Redirect::to('login');
        }
        $this->metas['title'] = $user->profile->login . ' change password';

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
                if ($user->changepassword($_POST)) {
                    $this->message['class'] = 'alert-success';
                    $this->message['text'][] = "{$user->profile->login}, your password has been changed";
                } else {
                    $this->message['class'] = 'alert-danger';
                    $this->message['text'] = $user->errors;
                }
            }
        }
        include '_template/changepassword.php';

    }


} 