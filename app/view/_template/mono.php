<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset='utf-8'>
    <title><?php echo $metas['meta_title']; ?></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" media="screen" />
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <ul class="nav nav-pills pull-right">
        <!--            class="active"-->
        <li><a href="/">Home</a></li>
        <?php if ($user->is_logged()): ?>
            <li><a href="<?php lib::link('user'); ?>">Profile</a></li>
            <li><a href="<?php lib::link('user', 'logout'); ?>">Logout</a></li>
        <?php else: ?>
            <li><a href="<?php lib::link('user', 'registration'); ?>">Registration</a></li>
            <li><a href="<?php lib::link('user', 'login'); ?>">Login</a></li>
        <?php endif; ?>
    </ul>
    <div>
        <h1><?php echo $metas['title']; ?></h1>
    </div>
</header>
<?php include BASE_PATH . "/view/${view}.php"; ?>
<footer>
    <p><a href="/">Monochrome!</a> &copy; <?php echo date('Y'); ?></p>
</footer>
</body>
</html>