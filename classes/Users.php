<?php

class Users extends Db {

    public $profile = array();
    public $errors = array();

    function registration($user){
        $this->profile = $user;

        $query = "INSERT INTO users (email, login, password, color, birthday)
                  VALUES (:email, :login, :password, :color, :birthday)";
        $res = $this->query($query, array(
            ':email' => $this->profile['email'],
            ':login' => $this->profile['login'],
            ':password' => $this->profile['password'],
            ':color' => $this->profile['color'],
            ':birthday' => $this->profile['birthday'],
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

    function login ($user) {
        $this->profile = $user;
        $query = "SELECT email, login, birthday, color FROM users WHERE login=:login AND password=:password";
        $res = $this->query($query, array(
            ':login' => $this->profile['login'],
            ':password' => $this->profile['password']
        ));
        if ($res) {
            if ($this->db_get_count()) {
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

    function logout() {

    }
} 