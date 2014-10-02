<?php include "view/_template/head.php"; ?>
<div class="jumbotron">
    <p>Just fill a few fields to become a part of us</p>
    <img class="logo" src="/img/form-icon.png" align="top" alt="logo"/>
    <div id="regform">
        <form role="form" method="post">
            <div>
                <label for="inp_email">E-mail:</label>
                <input id="inp_email" type="email" name="email" value="<?php echo $this->data['email']; ?>" <?php if($validate_rules['email']['required']) echo 'required'; ?> />
            </div>
            <div>
                <label for="inp_login">Login:</label>
                <input id="inp_login" type="text" name="login" value="<?php echo $this->data['login']; ?>"  <?php if($validate_rules['login']['required']) echo 'required'; ?> />
            </div>
            <div>
                <label for="inp_password">Password:</label>
                <input id="inp_password" type="password" name="password" <?php if($validate_rules['password']['required']) echo 'required'; ?> />
            </div>
            <div>
                <label for="inp_confirmation">Confirmation:</label>
                <input id="inp_confirmation" type="password" name="confirmation" <?php if($validate_rules['confirmation']['required']) echo 'required'; ?> />
            </div>
            <div>
                <label for="inp_date">Your birthday date:</label>
                <input id="inp_date" type="date" name="birthday" title="YYYY-MM-DD" placeholder="YYYY-MM-DD" pattern="<?php echo $validate_rules['birthday']['preg'];?>" value="<?php echo $this->data['birthday']; ?>" <?php if($validate_rules['birthday']['required']) echo 'required'; ?>/>
            </div>
            <div>
                <label>Your favorite color:</label>
                <input id="rad_color_white" type="radio" name="color" value="white" <?php echo ($this->data['color']=='white')?'checked':''; ?> <?php if($validate_rules['color']['required']) echo 'required'; ?> />
                <label for="rad_color_white" class="colorselect">white</label>
                <input id="rad_color_black" type="radio" name="color" value="black" <?php echo ($this->data['color']=='black')?'checked':''; ?> />
                <label for="rad_color_black" class="colorselect">black</label>
            </div>
            <div>
                <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Join" />
            </div>
        </form>
    </div>
    <?php include "view/_template/message.php"; ?>
</div>
<?php include "view/_template/footer.php"; ?>