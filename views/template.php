<!DOCTYPE html>
<html>
<head>
	<title>SPORT NATION | WORLD WIDE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/public/css/grid.css">
    <link rel="stylesheet" type="text/css" href="/public/css/global.css">
    <link rel="stylesheet" type="text/css" href="/public/css/panel.css">
    <link rel="stylesheet" type="text/css" href="/public/css/button.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'> -->

	<!-- scripts -->
</head>

<body>
    <header>
        <div class="grid-container">
            <div class="row">
                <div class="col-sm-2 center">
                    <img src="/public/img/logo_SNWW_light.png" alt="Play Now" class="app-logo" height="80px">
                </div>
                <div class="col-sm-9">
                    <a href="#" class="icon">
                        <span class="icon-location"></span>
                        <span class="text">My location</span>
                    </a>
                    <a class="icon" href="#">
                        <span class="icon-search"></span>
                        <span class="text">Find a sport</span>
                    </a>
                    <a class="icon" href="#">
                        <span class="icon-user"></span>
                        <span class="text">My account</span>
                    </a>
                </div>
                <div class="col-sm-1">
                    <div class="dropdown icon">
                        <span class="icon-menu dropdown-icon"></span>
                        <span class="text">$</span>
                        <ul class="dropdown-menu right">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="/user/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="grid-container">
        <div class="app-content">
            
            <?php include $this->view; ?>
        </div>
    </div> <!-- END GRID CONTAINER -->
</div>

</body>
<script type="text/javascript" src="/public/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/all.js"></script>

</html>