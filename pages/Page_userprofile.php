<?php

class Page_userprofile implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome userprofile',
        'title' => 'Profile',
    );

    function show(){
        include 'template/userprofile.php';
    }
}
