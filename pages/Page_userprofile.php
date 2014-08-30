<?php

class Page_userprofile implements Pages {
    public $metas = array(
        'meta_title' => 'Monochrome userprofile',
        'title' => 'Profile',
    );

    function show() {
        $user = new Users();
        if (!$user->is_logged()) {
            Redirect::to('login');
        }
        $this->metas['title'] = $user->profile->login . ' profile';
        include 'template/userprofile.php';
    }
}
