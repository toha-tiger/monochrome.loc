    <div class="container jumbotron">
        <div class="col-md-4">
            <div class="list-group">
                <a class="list-group-item active" href="#">Profile</a>
                <a class="list-group-item" href="#">Photos</a>
                <a class="list-group-item" href="#">Groups</a>
                <a class="list-group-item" href="<?php lib::link('user', 'changepassword')?>">Change password</a>
            </div>
            <div class="well well-sm">
                <p>some info's here</p>
            </div>
        </div>
        <div class="col-md-8">
            <h2>Your user details:</h2>
            <div id="regform">
                <form role="form" method="post">
                <div>
                    <label>ID:</label>
                    <input type="text" value="<?php echo $user->profile->id; ?>" disabled />
                </div>

                <div>
                    <label for="inp_email">E-mail:</label>
                    <input id="inp_email" type="email" name="email" value="<?php echo $user->profile->email; ?>" />
                </div>
                <div>
                    <label for="inp_login">Login:</label>
                    <input id="inp_login" type="text" name="login" value="<?php echo $user->profile->login; ?>"  />
                </div>
                <div>
                    <label for="inp_date">Your birthday date:</label>
                    <input id="inp_date" type="date" name="birthday" title="YYYY-MM-DD" placeholder="YYYY-MM-DD" pattern="<?php echo $validate_rules['birthday']['preg'];?>" value="<?php echo $user->profile->birthday; ?>" />
                </div>
                <div>
                    <label>Your favorite color:</label>
                    <input id="rad_color_white" type="radio" name="color" value="white" <?php echo ($user->profile->color == 'white')?'checked':''; ?> <?php if($validate_rules['color']['required']) echo 'required'; ?> />
                    <label for="rad_color_white" class="colorselect">white</label>
                    <input id="rad_color_black" type="radio" name="color" value="black" <?php echo ($user->profile->color == 'black')?'checked':''; ?> />
                    <label for="rad_color_black" class="colorselect">black</label>
                </div>
                <div>
                    <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Update details" />
                </div>
                </form>
                <?php include BASE_PATH . '/view/_template/message.php'; ?>
            </div>
        </div>
    </div>
