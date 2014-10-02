<?php

class Index extends Controller {

    function show() {
        $this->metas = array(
            'meta_title' => 'Welcome to Monochrome',
            'title' => 'Welcome to Monochrome',
        );

        $user = new User_model();

        include "_template/index.php";
    }
} 