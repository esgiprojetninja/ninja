<div class="row" xmlns="http://www.w3.org/1999/html">
    <?php
    echo '<p align="center" id="pages">Page : ';
    for($i=1; $i<=$nombreDePages; $i++){
        if($i==$pageActuelle){
            echo ' [ '.$i.' ] ';
        }else{
            echo ' <a href='.WEBROOT.'team/list?page='.$i.'>'.$i.'</a> ';
        }
    }
    ?></p>
    <p align="center"><a href="<?= WEBROOT;?>team/create"class="btn btn-primary">Create your own now!</a></p>
    <div align="center">
        <h3 class="center header-li ">Or find one :</h3>
        <input type="text" id="search-team">
        <select id="select-criteria">
            <option value="id">By all criteria</option>
            <option value="teamName" selected>By name</option>
            <option value="sport">By sport</option>
            <option value="creator">By creator</option>
        </select>
    </div>
    <div id="search-team-results""></div>
        
    <div class="col-sm-12" id="all-teams">
    <?php
    $teams = $this->data["teams"];
    if(!empty($teams)) {
        foreach ($teams as $team) {
            $members = TeamHasUser::findBy("idTeam",$team->getId(),"int",false);
            echo '
                <div class="col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="center header-li "><a href="'.WEBROOT.'team/show/'.$team->getId().'"> Group '.$team->getTeamName().'</a></h3></div>
                        <div class="panel-body">
                            <ul class="header-ul">
                                <li class="li-list">
                                    <span class="form-info">Name : </span>
                                    <span class="form-content">'.$team->getTeamName().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Date Of Creation : </span>
                                    <span class="form-content">'.$team->getDateCreated().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Sports : </span>
                                    <span class="form-content">'.$team->getSports().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Description : </span>
                                    <span class="form-content">'.$team->getDescription().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Number of numbers : </span>
                                    <span class="form-content">'.count($members).'</span>
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


