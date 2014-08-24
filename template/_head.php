<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset='utf-8'>
    <title><?php echo $this->metas['meta_title']; ?></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" media="screen" />
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <ul class="nav nav-pills pull-right">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="<?php lib::link('registration'); ?>">Registration</a></li>
            <li><a href="<?php lib::link('login'); ?>">Login</a></li>
        </ul>
        <div>
            <h1><?php echo $this->metas['title']; ?></h1>
        </div>
    </header>