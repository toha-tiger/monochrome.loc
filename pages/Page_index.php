<?php

class Page_index implements Pages {
    public $metas = array(
        'meta_title' => 'Welcome to Monochrome',
        'title' => 'Welcome to Monochrome',
    );

    function show() {
        include "template/index.php";
    }
} 