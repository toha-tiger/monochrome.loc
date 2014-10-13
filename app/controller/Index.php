<?php

class Index extends Controller {

    function show() {
        $this->metas = array(
            'meta_title' => 'Welcome to Monochrome',
            'title' => 'Welcome to Monochrome',
        );

        $this->render_view('Index/index');
    }
} 