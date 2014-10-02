<?php include "head.php"; ?>
<div class="jumbotron">
    <div id="loginform" class="container">
        <img class="logo" src="/img/core-of-sphere.jpg" align="top" alt="logo"/>
        <div class="container">
            <form role="form" method="post">

                <div>
                    <label for="inp_login">Login:</label>
                    <input id="inp_login" type="text" name="login" value="<?php echo $this->data['login']; ?>" <?php if($validate_rules['login']['required']) echo 'required'; ?> />
                </div>
                <div>
                    <label for="inp_password">Password:</label>
                    <input id="inp_password" type="password" name="password" <?php if($validate_rules['password']['required']) echo 'required'; ?> />
                </div>
                <div>
                    <label for="inp_rememberme">Remember me</label>
                    <input id="inp_rememberme" type="checkbox" name="rememberme" <?php if($this->data['rememberme']=='on') echo "checked"; ?>/>
                </div>
                <div>
                    <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Login" />
                </div>

            </form>
        </div>
    </div>
    <?php include "message.php"; ?>
</div>
<?php include "footer.php"; ?>