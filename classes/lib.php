<?php

class lib {
    static function get_post_var($var) {
        if (isset($_POST[$var]))
        {
            return $_POST[$var];
        }
        return '';
    }

    static function get_var($var) {
        if (isset($_GET[$var]))
        {
            return $_GET[$var];
        }
        return '';
    }

    static function link($page) {
        echo self::make_link($page);
    }

    static function make_link($page) {
        return "/index.php?page={$page}";
    }

} 