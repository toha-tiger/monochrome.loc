<?php

class Users extends Db {

    public $profile = array();
    public $message = array();

    private function validate_new_user() {
        $error = false;
        if (empty($this->profile['email']) || empty($this->profile['login']) ||
            empty($this->profile['password']) || empty($this->profile['confirmation']) ||
            empty($this->profile['fav_color']))
        {
            $error = true;
            $this->message[] = 'Please fill in all of the required fields';
        }
        if ($this->profile['password'] != $this->profile['confirmation'])
        {
            $error = true;
            $this->message[] = 'Password and confirmation isn\'t match';
        }
        if (!filter_var($this->profile['email'], FILTER_VALIDATE_EMAIL))
        {
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

        if ($error)
            return false;
        else
            return true;
    }

    private function is_taken($field, $value)
    {
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
        $error = false;

        if(!$this->validate_new_user()){
            //return false;
        }

        try {
            $insert = $this->db->prepare("INSERT INTO users (email, login, password, color, birthday)
                                    VALUES (:email, :login, :password, :color, :birthday)");
            $insert->bindParam(':email', $this->profile['email']);
            $insert->bindParam(':login', $this->profile['login']);
            $insert->bindParam(':password', $this->profile['password']);
            $insert->bindParam(':color', $this->profile['fav_color']);
            $insert->bindParam(':birthday', $this->profile['birthday']);
            $insert->execute();
            $this->message[] = $this->profile['login'] . ' Thank you for registration';
        } catch (PDOException $e) {
            $error = true;
            $this->message[] = 'Error adding user';
            if(self::DEBUG_MODE) {
                $this->message[] = $e->getMessage();
            }
            error_log ('Users->registration error ' . $e->getMessage());
        }
        //if (!error) {
        //    return true;
        //}
        return !$error;
    }

    function login () {

    }

    function logout() {

    }
} 