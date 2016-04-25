<!DOCTYPE html>
<html>
<head>
	<title>SPORT NATION | WORLD WIDE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT; ?>public/css/grid.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT; ?>public/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT; ?>public/css/panel.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT; ?>public/css/button.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'> -->

	<!-- scripts -->
</head>

<body>
    <header>
        <img src="<?= WEBROOT; ?>public/img/logo_SNWW_light.png" alt="Play Now" class="app-logo" height="80px">
        <div class="dropdown header-burger icon">
            <span class="icon-menu fa fa-bars"></span>
            <ul class="dropdown-menu right">
                <li><a href="#">Settings</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="/user/logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="app-content">
        <div class="sidebar">
            <div class="items-up items">
                <a href="<?php echo isset($_SESSION['user_id']) ? WEBROOT.'user/show/'.$_SESSION['user_id']: 'user/show/' ?>" class="item">
                    <span class="fa fa-user"></span>
                </a>
                <a href="#" class="item">
                    <span class="fa fa-map-marker"></span>
                </a>
                <a href="#" class="item">
                    <span class="fa fa-futbol-o"></span>
                </a>
            </div>
            <div class="items-down items">
                
            </div>
        </div>
        <div class="grid-container">
            <div class="grid-content">
                <?php include $this->view; ?>
            </div>
        </div> <!-- END GRID CONTAINER -->
    </div>
</div>

</body>
<script type="text/javascript" src="/public/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/all.js"></script>

</html>