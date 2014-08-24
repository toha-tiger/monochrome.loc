<?php

class lib {
    static function get_post_var($var)
    {
        if (isset($_POST[$var]))
        {
            return $_POST[$var];
        }
        return '';
    }

} 