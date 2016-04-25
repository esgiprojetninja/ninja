<!DOCTYPE html>
<html>
<head>
    <title>SPORT NATION | WORLD WIDE</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT; ?>dist/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
<header>
    <img src="<?= WEBROOT; ?>dist/images/logo_SNWW_light.png" alt="Play Now" class="app-logo" height="80px">

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
            <a href="<?= isset($_SESSION['user_id']) ? '/user/show/' . $_SESSION['user_id'] : 'user/show/' ?>"
               class="item">
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
    </div>
    <!-- END GRID CONTAINER -->
</div>
</div>

</body>
<script type="text/javascript" src="<?= WEBROOT; ?>dist/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<?= WEBROOT; ?>dist/js/app.js"></script>

</html>