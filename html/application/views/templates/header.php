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
                    <?php if(!$this->session->userdata('logged_in')) : ?>
                        <li><a href="<?php echo base_url() ?>/users/login">Login</a></li>
                        <li><a href="<?php echo base_url() ?>/users/register">Register</a></li>
                    <?php endif; ?>
                    <?php if($this->session->userdata('logged_in')) : ?>
                        <li><a href="<?php echo base_url() ?>/posts/create">Create Post</a></li>
                        <li><a href="<?php echo base_url() ?>/categories/create">Create Category</a></li>
                        <li><a href="<?php echo base_url() ?>/users/logout">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Flash messages  -->
        <?php $flash_list = array(
                'user_registered',
                'post_created',
                'post_updated',
                'post_deleted',
                'category_created',
                'category_deleted',
                'user_loggedin',
                'user_loggedout',
        ); ?>
        <?php foreach ($flash_list as $item): ?>
            <?php if ($this->session->flashdata($item)): ?>
                <?php echo '<p class="alert alert-success">'.$this->session->flashdata($item).'</p>'; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($this->session->flashdata('login_failed')): ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
        <?php endif; ?>
