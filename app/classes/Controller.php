<?php

abstract class Controller {
    protected $model = null;
    protected $metas = array();
    protected $data = null;
    protected $user = null;
    protected $layout = 'mono';

    abstract public function show();

    public function __construct() {
        $this->user = new User_model();
    }

    protected function render_view($view, $data = array()) {
//        if (count($data)) {
//            foreach($data as $name => $value) {
//                $$name = $value;
//            }
//        }
        $user = $this->user;
        $metas = $this->metas;

        include BASE_PATH . "/view/_template/{$this->layout}.php";
    }
} 