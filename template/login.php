<?php include "_head.php"; ?>
<div class="jumbotron">
    <div id="loginform" class="container">
        <img class="logo" src="/img/core-of-sphere.jpg" align="top" alt="logo"/>
        <div class="container">
            <form role="form" method="post">
                <div>
                    <label for="inp_login">Login:</label>
                    <input id="inp_login" type="text" name="login" value="<?php echo $user_info['login']; ?>" required/>
                </div>
                <div>
                    <label for="inp_password">Password:</label>
                    <input id="inp_password" type="password" name="password" required />
                </div>
                <div>
                    <label for="inp_rememberme">Remember me</label>
                    <input id="inp_rememberme" type="checkbox" name="rememberme" <?php if($user_info['rememberme']=='on') echo "checked"; ?>/>
                </div>
                <div>
                    <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Login" />
                </div>

            </form>
        </div>
    </div>
    <?php
		if (!empty($message) && isset($message_class)) {
			echo "<div class=\"alert ${message_class}\">";
            echo '<p>' . implode ($message, '<br />') . '</p>';
            echo '</div>';
        }
    ?>
</div>
<?php include "_footer.php"; ?>