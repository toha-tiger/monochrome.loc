<?php
	function get_post_var($var)
	{
		if (isset($_POST[$var]))
		{
			return $_POST[$var];
		} 
		return '';
	}

    function login($db, $login, $password)
    {
        $stmt = $db->prepare("SELECT login FROM users WHERE login=? AND password=?");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                $stmt->closeCursor();
                return true;
            }
            $stmt->closeCursor();
        }
        return false;
    }
	
	if (!empty($_POST))
	{
		$message = array();

		$login = get_post_var('login');
		$password = get_post_var('password');

		//validate input
		if (empty($login) || empty($password))
		{
			$message_class = 'alert-danger';
			$message[] = 'Please fill in login and password';
		}

		if ($message_class != 'alert-danger')
		{	
			$db = new PDO('mysql:host=localhost;dbname=monochrome;charset=utf8', 'monochrome', 'R8V8YIVuQoWA');
			if (login($db, $login, $password))
			{
                $message_class = 'alert-success';
                $message[] = "Welcome, {$login}";
			} else {
                $message_class = 'alert-danger';
                $message[] = 'Wrong login or password';
            }
		}
	}
include "template/login.html";