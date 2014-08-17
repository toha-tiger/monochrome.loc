<?php
	function get_post_var($var)
	{
		if (isset($_POST[$var]))
		{
			return $_POST[$var];
		} 
		return '';
	}
	
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
			$message_class = 'msg_error';
			$message[] = 'Please fill in all of the required fields';
		}
		if ($password != $confirmation)
		{
			$message_class = 'msg_error';
			$message[] = 'Password and confirmation isn\'t match';
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$message_class = 'msg_error';
			$message[] = 'Incorrect email';
		}

		if ($message_class != 'msg_error')
		{	
			$db = new PDO('mysql:host=localhost;dbname=monochrome;charset=utf8', 'monochrome', 'R8V8YIVuQoWA');
			if (is_taken($db, 'email', $email))
			{
				$message_class = 'msg_error';
				$message[] = 'This email is already registered, please choose another one';
			}
			if (is_taken($db, 'login', $login))
			{
				$message_class = 'msg_error';
				$message[] = 'This login already taken, please choose another one';
			}
		}
		
		if ($message_class != 'msg_error')
		{	
			$stmt = $db->prepare("INSERT INTO users (email, login, password, color, birthday) VALUES (?, ?, ?, ?, ?)");
			$stmt->bindParam(1, $email);
			$stmt->bindParam(2, $login);
			$stmt->bindParam(3, $password);
			$stmt->bindParam(4, $fav_color);
			$stmt->bindParam(5, $birthday);
			if ($stmt->execute())
			{
				$message_class = 'msg_ok';
				$message[] = 'Thank you for registration';
			} else {

				$message_class = 'msg_error';
				$message[] = 'Error adding user';
				$message = array_merge($message, $stmt->errorInfo());
				
			}
			$stmt->closeCursor();
		}
	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Monochrome registration
		</title>
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" media="screen" />
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/bootstrap.min.js"></script>
		
		<meta charset='utf-8'>
	</head>
	<body>
		<header>
		<ul class="nav nav-pills pull-right">
			<li><a href="index.php">Home</a></li>
			<li class="active"><a href="registration.php">Registration</a></li>
		</ul>
		<div>
			<p>Just fill a few fields to become a part of us</p>
			<h1>Monochrome registration</h1>
		</div>
		</header>
		<div class="jumbotron">
		<img class="logo" src="img/core-of-sphere-locked.jpg" align="top" alt="logo"/>
		<div id="regform">
			<form method="post">
				<div>
					<label>E-mail:</label>
					<input type="email" name="email" value="<?php echo $email; ?>" required />
				</div>
				<div>
					<label>Login:</label>
					<input type="text" name="login" value="<?php echo $login; ?>" required/>
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" required /> 
				</div>
				<div>
					<label>Password confirmation:</label>
					<input type="password" name="confirmation" required />
				</div>
				<div>
					<label>Your birthday date:</label>
					<input type="date" name="birthday" value="<?php echo $birthday; ?>"/>
				</div>
				<div>
					<label>Your favorite color:</label>
					<label class="colorselect"><input type="radio" name="fav_color" value="white" <?php echo ($fav_color=='white')?'checked':''; ?> required />white</label>
					<label class="colorselect"><input type="radio" name="fav_color" value="black" <?php echo ($fav_color=='black')?'checked':''; ?> />black</label>
				</div>
				<div>
					<input id="submit" class="btn btn-primary btn-lg" type="submit" value="Join" />
				</div>
			</form>
		</div>
		<?php
		if (!empty($message) && isset($message_class))
		{
			echo "<div class=\"message ${message_class}\">";
			echo '<p>' . implode ($message, '<br>') . '</p>';
			echo '</div>';
		}
		?>
		</div>
		<hr />
		<footer>
			<p><a href="index.php">Monochrome!</a></p>
		</footer>
	</body>
</html>