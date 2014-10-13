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

    static function link($page, $action = null) {
        echo self::make_link($page, $action);
    }

    static function make_link($page, $action = null) {
        if (!empty($action)){
            return "/index.php?page={$page}&action={$action}";
        } else {
            return "/index.php?page={$page}";
        }
    }

    static function js_redirect($page, $action = null)
    {
        $id = 'a' . uniqid();
        $js_code = '
            <div id="' . $id . '"></div>
            <script type = "text/javascript" >
                document.getElementById("' .$id . '").innerHTML =
                    "<div>Redirecting to ' . $page . ' page in 5 sec</div>" ;
                window . setTimeout(function () {
                    window . location = "' . self::make_link($page, $action) . '";
                     }, 5000);
        </script>
        ';
        return $js_code;
    }

} 