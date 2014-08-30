<?php include "_head.php"; ?>
<div class="jumbotron">
    <?php if ($user->is_logged()): ?>
        <p>Welcome back, <a href="<?php lib::link('userprofile'); ?>" title="Go to the user profile"><?php echo $user->profile->login; ?></a></p>
    <?php else: ?>
        <p>Welcome, random visitor, please <a href="<?php lib::link('login'); ?>">login</a></p>
    <?php endif; ?>
    <img class="logo" src="/img/core-of-sphere.jpg" />
    <?php if (!$user->is_logged()): ?>
        <p>What is Monochrome? <a href="<?php lib::link('registration'); ?>">Join us</a>, to find out</p>
    <?php endif; ?>
</div>
<?php include "_footer.php"; ?>