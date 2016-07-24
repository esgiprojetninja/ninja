<?php
    $teams = $this->data["teams"];
?>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-body">
             <div class="panel-heading">
                <h3 class="upper center">All teams</h3>
            </div>
                <?php if(count($teams) ==0 ):?>
                    <h2>Be the first one to create a team ! </h2>
                <?php else: ?>
                    <table style="border: 2px solid black">
                        <tr>
                            <td>Nom d'équipe</td>
                            <td>Date de création</td>
                            <td>Sports</td>
                            <td>Description</td>
                            <td>Nombre de membres</td>
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
                <?php endif; ?>
                <br>
                <a href="<?= WEBROOT;?>team/create"class="btn btn-primary">Create your now!</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="panel-heading">
                    <h3 class="upper center">
                        <?php
                            $hasTeam = User::HowMuchTeamIHave($_SESSION['user_id']);
                            if($hasTeam == 1){
                                echo 'My team :';
                            }else{
                                echo 'My teams :';
                            }
                        ?>
                    </h3>
                </div>
                <?php
                    if($hasTeam == 0){
                        echo '<h1> Join a team now !</h1>';
                    }else{
                        echo '<table>';
                        $teams = TeamHasUser::findBy("idUser",$_SESSION['user_id'],"int");
                            if(!is_array($teams)){
                              $team = Team::findById($teams->getIdTeam());
                              echo '<tr><td>';
                              echo '<a href='.WEBROOT.'team/show/'.$team->getId().'>'.$team->getTeamName();
                              echo '</td></tr>';
                            }else{
                              foreach($teams as $team){
                                $team = Team::findById($team->getIdTeam());
                                echo '<tr><td>';
                                echo '<a href='.WEBROOT.'team/show/'.$team->getId().'>'.$team->getTeamName();
                                echo '</td></tr>';
                              }
                            }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
