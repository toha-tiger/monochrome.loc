<!DOCTYPE html>
<html>
	<head>
		<title>
			Monochrome registration
		</title>
		<style>
			body {
				background: lightgray;
				text-align: center;
			}
			.logo {
				margin-bottom: 2em;
			}
			#regform {
				display: inline-block;
				margin-left: 2em;
			}
			#regform div:first-child {
				margin-top: inherit;
			}
			#regform div {
				margin-top: 1em;
				width: 20em;
				text-align: left;
			}
			#regform div:last-child {
				text-align: center;
			}
			label {
				display: inline-block;
				width: 10em;
			}
			label.colorselect {
				display: inline;
				width: inherit;
			}

		</style>
	</head>
	<body>
		<div>
			<p>Just fill a few fields to become a part of us</p>
			<h1>Monochrome registration</h1>
		</div>
		<img class="logo" src="img/core-of-sphere-locked.jpg" align="top" alt="logo"/>
		<div id="regform">
			<form method="post" action="index.php">
				<div>
					<label>E-mail:</label>
					<input type="email" name="email" required />
				</div>
				<div>
					<label>Login:</label>
					<input type="text" name="login" required />
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" required />
				</div>
				<div>
					<label>Password confirmation:</label>
					<input type="password" name="password_confirm" required />
				</div>
				<div>
					<label>Your favorite color:</label>
					<label class="colorselect"><input type="radio" name="color" value="white" required/>white</label>
					<label class="colorselect"><input type="radio" name="color" value="black"/>black</label>
				</div>
				<div>
					<input id="submit" type="submit" value="Join" />
				</div>
			</form>
		</div>
		<p><a href="index.php">Monochrome!</a></p>
	</body>
</html>