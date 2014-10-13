<?php

class Session {

    public static function check($name) {
        return isset($_SESSION[$name]);
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public static function delete($name) {
        unset($_SESSION[$name]);
    }
} 