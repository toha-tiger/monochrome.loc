<?php

class App {
    public static function start() {
        $page = ucfirst(lib::get_var('page'));
        if (empty($page)) {
            $page = 'Index';
        }

        $controller = BASE_PATH . "/controller/${page}.php";

        if (file_exists($controller))
        {
            include $controller;
            $page_class = "$page";
            $page = new $page_class;
        } else {
            echo 'no controller';
            Redirect::page404();
        }
        $action = lib::get_var('action');
        if (empty($action)) {
            $action = 'show';
        }
        if (!method_exists($page, $action)) {
            echo 'no action';
            Redirect::page404();
        }
        $page->$action();
    }
}