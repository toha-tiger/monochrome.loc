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

    static function js_redirect($page) {
//        $js_code = 'window.location.replace("' . self::make_link($page) . '");';
//        echo "{$js_code}";
        return '<script type="text/javascript">window.setTimeout( function(){window.location = "' . self::make_link($page) . '" }, 5000 );</script>';
    }

} 