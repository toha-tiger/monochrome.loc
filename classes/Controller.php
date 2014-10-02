<?php

abstract class Controller {
    protected $model = null;
    protected $metas = array();
    protected $data = null;

    abstract public function show();

    public function __construct() {
        // include model, view
        $model = 'model/' . get_class($this) . '_model.php';

        if (file_exists($model)) {
            include $model;
        }
    }

    protected function get_view($view, $data = array()) {
        if (count($data)) {
            foreach($data as $name => $value) {
                $$name = $value;
            }
        }
        include 'view/' . get_class($this) . '/' . $view . '.php';
    }
} 