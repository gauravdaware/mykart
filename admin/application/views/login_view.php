<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Login</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>normalize.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>bootstrap-select.less"> -->
    <link rel="stylesheet" href="<?php echo base_url().SCSS_PATH.'/';?>style.css">

    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?php echo base_url().IMG_PATH.'/';?>logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <p style="color:red"><?php echo $msg;?></p>
                    <form action="<?php echo base_url();?>Admin_controller/login" method="post">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="<?php /*echo set_value('email');*/if(isset($_COOKIE['admin_email'])){echo get_cookie('admin_email');} ?>">
                            <?php echo form_error('email'); ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE['admin_password'])){echo get_cookie('admin_password');} ?>">
                            <?php echo form_error('password'); ?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#"></a>
                            </label>

                        </div>
                        <button type="submit" name="login" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                       <!--  <div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                            </div>
                        </div> -->
                       
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo base_url().JS_PATH.'/';?>vendor/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>popper.min.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>plugins.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>main.js"></script>


</body>
</html>
