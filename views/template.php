<!DOCTYPE html>
<html>
<head>
	<title> Test </title>


	 <title>PLAY NOW</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- scripts -->
</head>

<body>
    <header>
        <div class="grid-container">
            <div class="row">
                <div class="col-xs-2 center">
                    <img src="./img/logo-pa.png" alt="Play Now" class="app-logo" height="100px" width="92px">
                </div>
                <div class="col-xs-9">
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
                <div class="col-xs-1">
                    <div class="dropdown icon">
                        <span class="icon-menu dropdown-icon"></span>
                        <ul class="dropdown-menu right">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
	<?php include $this->view; ?>
</body>

</html>