<html>
    <head>
        <title> CodeIgniter 3 practice </title>
<!--        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@3.4.0/cosmo/bootstrap.css">
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">CodeIgniter practice</a>
            </div>
            <div id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url() ?>">Home</a></li>
                    <li><a href="<?php echo base_url() ?>about">About</a></li>
                    <li><a href="<?php echo base_url() ?>posts">Blog</a></li>
                    <li><a href="<?php echo base_url() ?>categories">Categories</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url() ?>/posts/create">Create Post</a></li>
                    <li><a href="<?php echo base_url() ?>/categories/create">Create Category</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">