<div class="container jumbotron">
    <div class="col-md-4">
        <div class="list-group">
            <a class="list-group-item active" href="#">Profile</a>
            <a class="list-group-item" href="#">Photos</a>
            <a class="list-group-item" href="#">Groups</a>
        </div>
        <div class="well well-sm">
            <p>some info's here</p>
        </div>
    </div>
    <div class="col-md-8">
        <h2>Change password:</h2>
        <div id="regform">
            <form role="form" method="post">
                <div>
                    <label for="inp_oldpassword">Old password:</label>
                    <input id="inp_oldpassword" type="password" name="oldpassword" <?php if($validate_rules['oldpassword']['required']) echo 'required'; ?> />
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
                    <input id="submit" class="btn btn-primary btn-lg" type="submit" value="Change" />
                </div>
            </form>
        </div>
        <?php include BASE_PATH . '/view/_template/message.php'; ?>
    </div>
</div>