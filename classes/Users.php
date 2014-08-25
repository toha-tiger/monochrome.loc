<?php

class Users extends Db {

    public $profile = array();
    public $errors = array();

    function registration($user){
        $this->profile = $user;

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
            $this->errors[] = 'Error adding user';
            if(self::DEBUG_MODE) {
                $this->errors[] = $e->getMessage();
            }
            error_log ('Users->registration error ' . $e->getMessage());
            return false;
        }
        return true;
    }

    function login ($user) {
        $this->profile = $user;

        try {
            $query = "SELECT email, login, birthday, color FROM users WHERE login=:login AND password=:password";
            $select = $this->db->prepare($query);
            $select->bindParam(':login', $this->profile['login']);
            $select->bindParam(':password', $this->profile['password']);
            $select->execute();
            if ($select->rowCount() == 1) {
                $this->profile = $select->fetch();
                return true;
            } else {
                $this->errors[] = "Wrong login or password";
                return false;
            }

        } catch (PDOException $e) {
            $this->errors[] = 'Error ';
            if(self::DEBUG_MODE) {
                $this->errors[] = $e->getMessage();
            }
            error_log ('Users->login error ' . $e->getMessage());
            return false;
        }
    }

    function logout() {

    }
} 