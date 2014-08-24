<?php

	
	function is_taken($db, $field, $value)
	{
		//$field = $db->quote($field);
		$value = $db->quote($value);
		$result = $db->query("SELECT ${field} FROM users WHERE ${field} = ${value};");
		
		if ($result->rowCount() > 0)
		{
			$result->closeCursor();
			return true;
		}
		$result->closeCursor();
		return false;
	}
	
	if (!empty($_POST))
	{
		$message = array();

		$email = get_post_var('email');
		$login = get_post_var('login');
		$password = get_post_var('password');
		$confirmation = get_post_var('confirmation');
		$birthday = get_post_var('birthday');
		$fav_color = get_post_var('fav_color');

		//validate input
		if (empty($email) || empty($login) || empty($password) || empty($confirmation) || empty($fav_color))
		{
			$message_class = 'alert-danger';
			$message[] = 'Please fill in all of the required fields';
		}
		if ($password != $confirmation)
		{
			$message_class = 'alert-danger';
			$message[] = 'Password and confirmation isn\'t match';
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$message_class = 'alert-danger';
			$message[] = 'Incorrect email';
		}

		if ($message_class != 'alert-danger')
		{	
			$db = new PDO('mysql:host=localhost;dbname=monochrome;charset=utf8', 'monochrome', 'R8V8YIVuQoWA');
			if (is_taken($db, 'email', $email))
			{
				$message_class = 'alert-danger';
				$message[] = 'This email is already registered, please choose another one';
			}
			if (is_taken($db, 'login', $login))
			{
				$message_class = 'alert-danger';
				$message[] = 'This login already taken, please choose another one';
			}
		}
		
		if ($message_class != 'alert-danger')
		{	
			$stmt = $db->prepare("INSERT INTO users (email, login, password, color, birthday) VALUES (?, ?, ?, ?, ?)");
			$stmt->bindParam(1, $email);
			$stmt->bindParam(2, $login);
			$stmt->bindParam(3, $password);
			$stmt->bindParam(4, $fav_color);
			$stmt->bindParam(5, $birthday);
			if ($stmt->execute())
			{
				$message_class = 'alert-success';
				$message[] = 'Thank you for registration';
			} else {

				$message_class = 'alert-danger';
				$message[] = 'Error adding user';
				$message = array_merge($message, $stmt->errorInfo());
				
			}
			$stmt->closeCursor();
		}
	}
include "template/registration.html";