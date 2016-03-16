<!DOCTYPE html>
<html>
<head>
	<title> Test </title>


	 <title>PLAY NOW</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/public/css/grid.css">
    <link rel="stylesheet" type="text/css" href="/public/css/global.css">
    <link rel="stylesheet" type="text/css" href="/public/css/panel.css">
    <link rel="stylesheet" type="text/css" href="/public/css/button.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- scripts -->
</head>

<body>
    <header>
        <div class="grid-container">
            <div class="row">
                <div class="col-xs-2 center">
                    <img src="/public/img/logo_SNWW.png" alt="Play Now" class="app-logo" height="80px">
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
    <div class="grid-container">
    <div class="row">
        <nav class="col-sm-2 hidden-sm">
            <div class="panel">
                <div class="panel-heading">
                    <p class="panel-title">Events around you</p>
                </div>
                <div class="panel-body">
                    <div class="index-map" id="index-map"></div>
                </div>
                <div class="panel-footer">
                    <a href="">Not your neighbourghood ?</a>
                </div>
            </div>
        </nav>
        <section class="timeline col-sm-8">
            <?php include $this->view; ?>
        </section>
        <aside class="col-sm-2 hidden-sm">
            <div class="panel panel-primary2">
                <div class="panel-heading">
                    <h3 class="panel-title">Latest news</h3>
                </div>
                <div class="panel-body">
                    <div class="news-box">
                        <h4 class="box-title">Today <span class="title">BasketBall</span></h4>
                        <div class="content">
                            Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
                        </div>
                        <div class="box-divider"></div>
                    </div>
                    <div class="news-box">
                        <h4 class="box-title">Today <span class="title">Soccer</span></h4>
                        <div class="content">
                            Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
                        </div>
                        <div class="box-divider"></div>
                    </div>
                </div>
            </div>
        </aside>
    </div> <!-- END GRID CONTAINER -->
</div>
</body>

</html>