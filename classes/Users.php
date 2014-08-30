<?php

class Users extends Db {

    public $profile = array();
    public $errors = array();

    private $user_logged = false;

    public function __construct($id = null) {
        parent::__construct();
        if(Session::check('User_id')){
            $this->user_get(Session::get('User_id'));
        }
    }

    private function user_get($id){
        $query = "SELECT id, email, login, birthday, color FROM users WHERE id=:id";
        $res = $this->query($query, array(
            ':id' => $id
        ));
        if ($res) {
            if ($this->db_get_count()) {
                $this->profile = $this->db_get_result()[0];
                Session::set('User_id', $this->profile->id);
                $this->user_logged = true;
                return true;
            } else {
                $this->errors[] = "User not found!";
            }
        } else {
            $this->errors[] = 'Error ';
            if(self::DEBUG_MODE) {
                $this->errors = array_merge($this->errors, $this->db_get_errors());
            }
            error_log ('Users->get error ' . serialize($this->db_get_errors()));
        }
        return false;
    }

    public function registration($user_data){
        $query = "INSERT INTO users (email, login, password, color, birthday)
                  VALUES (:email, :login, :password, :color, :birthday)";
        $res = $this->query($query, array(
            ':email' => $user_data['email'],
            ':login' => $user_data['login'],
            ':password' => $user_data['password'],
            ':color' => $user_data['color'],
            ':birthday' => $user_data['birthday'],
        ));

        if ($res) {
            $this->message[] = $this->profile['login'] . ' Thank you for registration';
            return true;
        } else {
            $this->errors[] = 'Error adding user';
            $this->errors = array_merge($this->errors, $this->db_get_errors());
            return false;
        }
    }

    public function login ($user) {
        $query = "SELECT id, email, login, birthday, color FROM users WHERE login=:login AND password=:password";
        $res = $this->query($query, array(
            ':login' => $user['login'],
            ':password' => $user['password']
        ));
        if ($res) {
            if ($this->db_get_count()) {
                $this->profile = $this->db_get_result()[0];
                Session::set('User_id', $this->profile->id);
                $this->user_logged = true;
                return true;
            } else {
                $this->errors[] = "Wrong login or password";
            }
        } else {
            $this->errors[] = 'Error ';
            if(self::DEBUG_MODE) {
                $this->errors = array_merge($this->errors, $this->db_get_errors());
            }
            error_log ('Users->login error ' . serialize($this->db_get_errors()));
        }
        return false;
    }

    public function logout() {
        Session::delete('User_id');
        $this->user_logged = false;
    }

    public function is_logged() {
        return $this->user_logged;
    }


} 