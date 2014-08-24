<?php include "_head.php"; ?>
<div class="jumbotron">
    <p>Just fill a few fields to become a part of us</p>
    <img class="logo" src="/img/form-icon.png" align="top" alt="logo"/>
    <div id="regform">
        <form role="form" method="post">
            <div>
                <label for="inp_email">E-mail:</label>
                <input id="inp_email" type="email" name="email" value="<?php echo $user_info['email']; ?>" required />
            </div>
            <div>
                <label for="inp_login">Login:</label>
                <input id="inp_login" type="text" name="login" value="<?php echo $user_info['login']; ?>" required />
            </div>
            <div>
                <label for="inp_password">Password:</label>
                <input id="inp_password" type="password" name="password" required />
            </div>
            <div>
                <label for="inp_confirmation">Confirmation:</label>
                <input id="inp_confirmation" type="password" name="confirmation" required />
            </div>
            <div>
                <label for="inp_date">Your birthday date:</label>
                <input id="inp_date" type="date" name="birthday" value="<?php echo $user_info['birthday']; ?>"/>
            </div>
            <div>
                <label>Your favorite color:</label>
                <input id="rad_color_white" type="radio" name="color" value="white" <?php echo ($user_info['color']=='white')?'checked':''; ?> required />
                <label for="rad_color_white" class="colorselect">white</label>
                <input id="rad_color_black" type="radio" name="color" value="black" <?php echo ($user_info['color']=='black')?'checked':''; ?> />
                <label for="rad_color_black" class="colorselect">black</label>
            </div>
            <div>
                <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Join" />
            </div>
        </form>
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