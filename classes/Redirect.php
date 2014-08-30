<?php

class Redirect {
    public static function to($page) {
        header("Location: " . lib::make_link($page));
    }


} 