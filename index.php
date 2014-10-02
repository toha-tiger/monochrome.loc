<?php
require 'classes/init.php';

//router
$page = lib::get_var('page');
if (empty($page)) {
    $page = 'index';
}
$page_file = "controller/${page}.php";

if (file_exists($page_file))
{
    include $page_file;
    $page_class = "$page";
    $page = new $page_class;
} else {
    Redirect::page404();
}
$action = lib::get_var('action');
if (empty($action)) {
    $action = 'show';
}
if (!method_exists($page, $action)) {
    Redirect::page404();
}
$page->$action();
//end router