<?php

class Page_logout implements Pages{
    public function show() {
        $user = new Users();
        if ($user->is_logged()) {
            $user->logout();
        }
        Redirect::to('index');
    }
}