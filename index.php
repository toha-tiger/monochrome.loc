<?php
require 'classes/init.php';

//router
$page = lib::get_var('page');
if (empty($page))
{
    $page = 'index';
}
$page_file = "pages/Page_${page}.php";

if (file_exists($page_file))
{
    include $page_file;
    $page_class = "Page_$page";
    $page = new $page_class;
} else {
    die("Page_$page doesn't exists");
}
$action = lib::get_var('action');
if (empty($action))
{
    $action = 'show';
}
$page->$action();
//end router