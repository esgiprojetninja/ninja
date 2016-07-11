<?php
    $teams = $this->data["teams"];
?>

<div class="row">
    <div class="col-sm-12">
                <?php
                if(!empty($teams)) {
                    foreach ($teams as $team) {
                        $members = TeamHasUser::findBy("idTeam",$team->getId(),"int",false);
                        echo '
                            <div class="col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><h3 class="center header-li "> Group '.$team->getTeamName().' </h3></div>
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
                            </div>';
                    }
                }
                ?>

                <br>
                <a href="<?= WEBROOT;?>team/create"class="btn btn-primary">Create your now!</a>

        </div>
    </div>
</div>