<?php

class Users extends Db {

    public $profile = array();
    public $message = array();

    private function validate_new_user() {
        $error = false;
        if (empty($this->profile['email']) || empty($this->profile['login']) ||
            empty($this->profile['password']) || empty($this->profile['confirmation']) ||
            empty($this->profile['color'])) {
            $error = true;
            $this->message[] = 'Please fill in all of the required fields';
        }
        if ($this->profile['password'] != $this->profile['confirmation']) {
            $error = true;
            $this->message[] = 'Password and confirmation isn\'t match';
        }
        if (!filter_var($this->profile['email'], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $this->message[] = 'Incorrect email';
        }
        if ($this->is_taken('email', $this->profile['email'])) {
            $error = true;
            $this->message[] = 'This email is already registered, please choose another one';
        }
        if ($this->is_taken('login', $this->profile['login'])) {
            $error = true;
            $this->message[] = 'This login already taken, please choose another one';
        }
        return !$error;
    }

    private function validate_login_user() {
        if (empty($this->profile['login']) || empty($this->profile['password'])) {
            $this->message[] = 'Please fill in login and password';
            return false;
        }
        return true;
    }

    private function is_taken($field, $value) {
        try {
            $select = $this->db->prepare("SELECT ${field} FROM users WHERE ${field} = :value;");
            $select->bindParam(':value', $value);
            if ($select->execute()) {
                if ($select->rowCount() > 0) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            $this->message[] = 'Can not check user or email';
            if(self::DEBUG_MODE) {
                $this->message[] = $e->getMessage();
            }
            error_log('Users->is_taken error ' . $e->getMessage());
            return true;
        }
    return false;
    }

    function registration($user){
        $this->profile = $user;
        if(!$this->validate_new_user()){
            return false;
        }

        try {
            $query = "INSERT INTO users (email, login, password, color, birthday)
                      VALUES (:email, :login, :password, :color, :birthday)";
            $insert = $this->db->prepare($query);
            $insert->bindParam(':email', $this->profile['email']);
            $insert->bindParam(':login', $this->profile['login']);
            $insert->bindParam(':password', $this->profile['password']);
            $insert->bindParam(':color', $this->profile['color']);
            $insert->bindParam(':birthday', $this->profile['birthday']);
            $insert->execute();
            $this->message[] = $this->profile['login'] . ' Thank you for registration';
        } catch (PDOException $e) {
            $this->message[] = 'Error adding user';
            if(self::DEBUG_MODE) {
                $this->message[] = $e->getMessage();
            }
            error_log ('Users->registration error ' . $e->getMessage());
            return false;
        }
        return true;
    }

    function login ($user) {
        $this->profile = $user;
        if (!$this->validate_login_user()) {
            return false;
        }

        try {
            $query = "SELECT email, login, birthday, color FROM users WHERE login=:login AND password=:password";
            $select = $this->db->prepare($query);
            $select->bindParam(':login', $this->profile['login']);
            $select->bindParam(':password', $this->profile['password']);
            $select->execute();
            if ($select->rowCount() == 1) {
                $this->profile = $select->fetch();
                $this->message[] = "Welcome " . $this->profile['login'];
                return true;
            } else {
                $this->message[] = "Wrong login or password";
                return false;
            }

        } catch (PDOException $e) {
            $this->message[] = 'Error ';
            if(self::DEBUG_MODE) {
                $this->message[] = $e->getMessage();
            }
            error_log ('Users->login error ' . $e->getMessage());
            return false;
        }
    }

    function logout() {

    }
} 