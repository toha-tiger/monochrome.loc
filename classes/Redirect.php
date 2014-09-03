<?php

class Redirect {
    public static function to($page) {
        header("Location: " . lib::make_link($page));
    }

    public static function page404(){
        header("HTTP/1.0 404 Not Found");
        die('404. This is not the page you\'re looking for');
    }

} 