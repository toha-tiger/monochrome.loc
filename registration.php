<?php
	function get_post_var($var)
	{
		if (isset($_POST[$var]))
		{
			return $_POST[$var];
		} 
		return '';
	}
	function msg_empty()
	{
		$msg = '';
		$args = func_get_args();
		var_dump($args);
die;
		if (func_num_args() > 0)
		{
			foreach($args as $name => $arg)
			{
				if (empty($arg))
				{
					$msg .= " ${name} is empty";
				}
			}
		}
		return $msg;
	}	
	if (!empty($_POST))
	{
		$message = 'There is some POST DATA<br />';
		$message .= var_export($_POST, true);
		$message_class = "msg_ok";

		$email = get_post_var('email');
		$login = get_post_var('login');
		$password = get_post_var('password');
		$confirmation = get_post_var('confirmation');
		$birthday = get_post_var('birthday');
		$color = get_post_var('color');
		//validate input
		var_dump(array($email, $login, $password, $confirmation, $color));
		if (empty($email) || empty($login) || empty($password) || empty($confirmation) || empty($color))
		{
			$message_class = "msg_error";
			$message = "Please fill all required fields.<br />" . empty($email)?'Email is empty ':'' . empty($login)?'Login is empty ':'' ;
		}
	//	$db = new PDO('mysql:host=localhost;dbname=monochrome;charset=utf8', 'monochrome', 'R8V8YIVuQoWA');
	//	$db->query('insert into users (email, login, pass) values ("' . $_POST['email'] . '", "' . $_POST['login'] . '", "' . $_POST['pass'] . '")');
	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Monochrome registration
		</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css" media="screen" />
	</head>
	<body>
		<header>
		<div>
			<p>Just fill a few fields to become a part of us</p>
			<h1>Monochrome registration</h1>
		</div>
		</header>
		<img class="logo" src="img/core-of-sphere-locked.jpg" align="top" alt="logo"/>
		<div id="regform">
			<form method="post">
				<div>
					<label>E-mail:</label>
					<input type="email" name="email" /> <!-- required -->
				</div>
				<div>
					<label>Login:</label>
					<input type="text" name="login" /> <!-- required -->
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" /> <!-- required -->
				</div>
				<div>
					<label>Password confirmation:</label>
					<input type="password" name="confirmation" /> <!-- required -->
				</div>
				<div>
					<label>Your birthday date:</label>
					<input type="date" name="birthday" />
				</div>
				<div>
					<label>Your favorite color:</label>
					<label class="colorselect"><input type="radio" name="color" value="white"/>white</label> <!-- required -->
					<label class="colorselect"><input type="radio" name="color" value="black"/>black</label>
				</div>
				<div>
					<input id="submit" type="submit" value="Join" />
				</div>
			</form>
		</div>
		<?php
		if (isset($message) && isset($message_class))
		{
			echo "<div class=\"message ${message_class}\">";
			echo "<p>${message}</p>";
			echo '</div>';
		}
		?>
		<footer>
		<p><a href="index.php">Monochrome!</a></p>
		</footer>
	</body>
</html>