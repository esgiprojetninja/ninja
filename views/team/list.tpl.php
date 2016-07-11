<?php
    $teams = $this->data["teams"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-sm-6">
                    <ul class="header-ul">
                        <li class="li-list fa fa-users"> Group</li>
                        <li class="li-list">
                            <span class="form-info">Name : </span>
                            <span class="form-content"><?php //echo $team->getid(); ?></span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Date Of Creation : </span>
                            <span class="form-content"><?php //echo $user->getFirstName(); ?></span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Sport : </span>
                            <span class="form-content"><?php //echo $user->getLastName(); ?></span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Description : </span>
                            <span class="form-content"><?php //echo $user->getFavoriteSports(); ?></span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Number of numbers : </span>
                            <span class="form-content"><?php //echo $user->getFavoriteSports(); ?></span>
                        </li>
                    </ul>
                </div>

                <?php
                if(!empty($teams)) {
                    foreach ($teams as $team) {
                        echo '<ul class="header-ul">
                        <li class="li-list fa fa-users"> Group</li>
                        <li class="li-list">
                            <span class="form-info">Name : </span>
                            <span class="form-content">'.$team->getId().'</span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Date Of Creation : </span>
                            <span class="form-content">'.$team->getId().'/span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Sport : </span>
                            <span class="form-content">'.$team->getId().'</span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Description : </span>
                            <span class="form-content">'.$team->getId().'</span>
                        </li>
                        <li class="li-list">
                            <span class="form-info">Number of numbers : </span>
                            <span class="form-content">'.$team->getId().'</span>
                        </li>
                    </ul>';
/*
                        echo '<li class="li-list">
                            <span class="form-info">Name : </span>
                            <span class="form-content">'.$team->getid().'</span>
                            </li>';
                  */  }

                }
                ?>

                <table style="border: 2px solid black">
                    <tr>
                        <td>Group Name</td>
                        <td>Date of creation</td>
                        <td>Sports</td>
                        <td>Description</td>
                        <td>Number of members</td>
                    </tr>
                    <?php
                    foreach($teams as $team){
                        $members = TeamHasUser::findBy("idTeam",$team->getId(),"int",false);
                        echo '<tr><td>';
                        echo '<a href='.WEBROOT.'team/show/'.$team->getId().'>'.$team->getTeamName();
                        echo '</td><td>';
                        echo $team->getDateCreated();
                        echo '</td><td>';
                        echo $team->getSports();
                        echo '</td><td>';
                        echo $team->getDescription();
                        echo '</td><td>';
                        echo count($members);
                        echo '</td></tr>';
                    }
                    echo '<p align="center">Page : ';
                    for($i=1; $i<=$nombreDePages; $i++){
                         if($i==$pageActuelle){
                             echo ' [ '.$i.' ] ';
                         }else{
                              echo ' <a href='.WEBROOT.'team/list?page='.$i.'>'.$i.'</a> ';
                         }
                    }
                    echo '</p>';
                    ?>
                </table>
                <br>
                <a href="<?= WEBROOT;?>team/create"class="btn btn-primary">Create your now!</a>
            </div>
        </div>
    </div>
</div>