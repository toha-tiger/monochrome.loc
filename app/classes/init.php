<?php

define('BASE_PATH', __DIR__ . '/..'); // app/classes/..

function __autoload($class_name) {

    if (file_exists(BASE_PATH . "/classes/${class_name}.php")) {
        include BASE_PATH . "/classes/${class_name}.php";
    } elseif (file_exists(BASE_PATH . "/controller/${class_name}.php")) {
        include BASE_PATH . "/controller/${class_name}.php";
    } elseif  (file_exists(BASE_PATH . "/model/${class_name}.php")) {
        include BASE_PATH . "/model/${class_name}.php";
    } else {
        die ('no class ' . $class_name);
    }
}

session_start();

