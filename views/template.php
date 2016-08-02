<!DOCTYPE html>
<html>
<head>
    <title>La guitare à gauche</title>
    <meta charset="UTF-8">
    <?php if(isset($feed)): ?>
    <link rel='alternate' href="<?= WEBROOT; ?>rss/feeds/" title="My RSS" type="application/rss+xml">
    <?php endif; ?>
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/grid.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/global.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/panel.css">
    <link rel="stylesheet" type="text/css" href="<?= WEBROOT;?>public/css/button.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'> -->

    <!-- scripts -->
    <script type="text/javascript"> var webrootJs = "<?= WEBROOT; ?>"; var gblCurrentUserId = "<?= $_SESSION['user_id']; ?>";</script>
    <script type="text/javascript" src="<?= WEBROOT;?>public/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?= WEBROOT;?>public/js/all.js"></script>
</head>

<body>
    <header>
        <a href="<?= WEBROOT; ?>"><img src="<?= WEBROOT;?>public/img/tete-startocaster.png" alt="Play Now" class="app-logo" height="80px"></a>
        <div class="item icon title-name name-site">
            <span>La guitare à gauche</span>
        </div>
        <div class="dropdown header-burger icon">
            <span class="icon-menu fa fa-bars"></span>
            <ul class="dropdown-menu right">
                <?php if(User::isAdmin()):  ?>
                    <li><a href="<?= WEBROOT;?>admin/global">Admin</a></li>
                <?php endif; ?>
                <li><a href="#<?= WEBROOT;?>landing/legals">Legals</a></li>
                <li><a href="<?= WEBROOT; ?>landing/plan">Site plan</a></li>
                <li><a href="<?= WEBROOT; ?>user/logout">Logout</a></li>
            </ul>
        </div>
        <div class="item dropdown header-burger icon" id="popin-notifications">
            <span class="icon-menu fa fa-bell-o" id="notification-icon"></span>
        </div>
        <div class="item dropdown header-burger icon" id="popin-messages">
            <span class="fa fa-envelope-o" id="notification-icon"></span>
        </div>
        <?php if(User::isConnected()):?>
            <div class="item dropdown header-burger icon">
                <a href="<?= WEBROOT; ?>user/show/<?php if(isset($_SESSION["user_id"])){ echo $_SESSION["user_id"]; } ?>" class="item">
                    <span class="fa fa-user"></span>
                </a>
            </div>
        <?php endif; ?>
        <div class="item dropdown header-burger icon">
            <?php if (User::isConnected()): ?>
                <span>Bonjour <?= $_SESSION["username"] ?></span>
            <?php endif; ?>
        </div>
    </header>
    <div class="app-content">
        <?php if (User::isConnected()): ?>
            <div class="sidebar">
                <div class="items-up items">
                    <a href="<?= WEBROOT; ?>article/list" class="item">
                        <span class="fa fa-file-text-o"></span>
                    </a>
                    <a href="<?= WEBROOT; ?>user/list/" class="item">
                        <span class="fa fa-book"></span>
                    </a>
                    <a href="<?= WEBROOT; ?>team/list" class="item">
                        <span class="fa fa-users"></span>
                    </a>
                    <a href="<?= WEBROOT; ?>team/list" class="item">
                        <span class="fa fa-map-marker"></span>
                    </a>
                    <a href="<?= WEBROOT; ?>event/list" class="item">
                        <span class="fa fa-calendar-check-o"></span>
                    </a>
                    <a href="<?= WEBROOT; ?>inbox/myInbox" class="item">
                        <span class="fa fa-envelope-o"></span>
                    </a>
                    <a href="<?= WEBROOT; ?>rss/list" class="item">
                        <span class="fa fa-rss-square"></span>
                    </a>
                </div>
            <div class="items-down items">

            </div>
          </div>
        <?php endif; ?>
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
