<?php
    $teams = $this->data["teams"];
?>

<div class="row">
    <div class="col-sm-12">
        <?php
        echo '<p align="center">Page : ';
        for($i=1; $i<=$nombreDePages; $i++){
            if($i==$pageActuelle){
                echo ' [ '.$i.' ] ';
            }else{
                echo ' <a href='.WEBROOT.'team/list?page='.$i.'>'.$i.'</a> ';
            }
        }
        ?>
        <a href="<?= WEBROOT;?>team/create"class="btn btn-primary">Create your own now!</a>
        <?php
            echo '</p>';
            echo '
               <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading"><h3 class="center header-li "> Find a group right now ! </h3></div>
                        <div class="panel-body">
                            <form class="ajax-form" action="' .  WEBROOT .'team/list/" method="POST" >
                                <div class="input-grp">
                                     <input class="form-control" type="text" name="text-ajax" placeholder="Type something :)">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>'
            ;


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
                        </div>'
                    ;
                }
            }
        ?>
        </div>
    </div>
</div>