<div class="row" xmlns="http://www.w3.org/1999/html">

    <script type="text/javascript"> var page = "user";</script>

    <div align="center">
        <h3 class="center header-li ">Trouver un article :</h3>
        <input type="text" id="search-content">
        <select id="select-criteria">
            <option value="1" selected>By name</option>
            <option value="2">By Country</option>
            <option value="3">By City</option>
        </select>
    </div>
    <div id="search-content-results""></div>

<div class="col-sm-12" id="all-content">

    <?php
    $articles = $this->data["articles"];
    if(!empty($articles)) {
        foreach ($articles as $article) {
            $authorId = $article->getIdAuthor();
            $author = User::findById($authorId);
            $authorName = $author->getUsername();
            echo '
                <div class="col-sm-6">
                    <div class="panel panel-primary2">
                        <div class="panel-heading"><h3 class="center header-li "><a href="'.WEBROOT.'article/show/'.$article->getId().'">'.$article->getTitle().'</a> par <a href="'.WEBROOT.'user/show/'.$authorId.'">'.$authorName.'</a></h3></div>
                        <div class="panel-body">
                            <ul class="header-ul">
                                <li class="li-list">
                                    <span class="form-info">Email : </span>
                                    <span class="form-content">'.$article->getTitle().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Country : </span>
                                    <span class="form-content">'.$article->getTitle().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">City : </span>
                                    <span class="form-content">'.$article->getTitle().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Birthday : </span>
                                    <span class="form-content">'.$article->getTitle().'</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    ?>
</div>

</div>


