<!DOCTYPE html>
<html>
<head>
    <title>SPORT NATION | WORLD WIDE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/grid.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/panel.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/button.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'> -->

    <!-- scripts -->
    <script type="text/javascript"> var webrootJs = "<?= WEBROOT; ?>";</script>
    <script type="text/javascript" src="<?= WEBROOT;?>public/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?= WEBROOT;?>public/js/all.js"></script>
</head>

<body>
    <header>
        <a href="<?= WEBROOT; ?>"><img src="<?= WEBROOT;?>public/img/logo_SNWW_light.png" alt="Play Now" class="app-logo" height="80px"></a>
        <div class="dropdown header-burger icon">
            <span class="icon-menu fa fa-bars"></span>
            <ul class="dropdown-menu right">
                <li><a href="#">Settings</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="<?= WEBROOT; ?>user/logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="app-content">
        <div class="sidebar">
            <div class="items-up items">
                <a href="<?= WEBROOT; ?>user/show/<?php if(isset($_SESSION["user_id"])){ echo $_SESSION["user_id"]; } ?>" class="item">
                    <span class="fa fa-user"></span>
                </a>
                <a href="<?= WEBROOT; ?>team/list" class="item">
                    <span class="fa fa-users"></span>
                </a>
                <a href="<?= WEBROOT; ?>event/list" class="item">
                    <span class="fa fa-calendar-check-o"></span>
                </a>
                <div class="item dropdown header-burger ico row" id="popin-notifications">
                    <span class="icon-menu fa fa-flag-o" id="notification-icon"></span>
                </div>
                <a href="<?= WEBROOT; ?>inbox/myInbox" class="item">
                    <span class="fa fa-envelope-o"></span>
                </a>
            </div>
            <div class="items-down items">

            </div>
        </div>
        <div class="grid-container">
            <div class="msg-box">
                <p class="text">
                    <span class="text-content"></span>
                    <span class="fa fa-times js-close-msg-box"></span>
                </p>
            </div>
            <div class="grid-content">
                <?php include $this->view; ?>
            </div>
        </div> <!-- END GRID CONTAINER -->
    </div>


</body>


</html>
