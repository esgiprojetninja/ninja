<?php
    $teams = $this->data["teams"];
?>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-body">
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
                        $members = TeamHasUser::findBy("idTeam",$team['id'],"int",false);
                        echo '<tr><td>';
                        echo '<a href='.WEBROOT.'team/show/'.$team['id'].'>'.$team['teamName'];
                        echo '</td><td>';
                        echo $team['dateCreated'];
                        echo '</td><td>';
                        echo $team['sports'];
                        echo '</td><td>';
                        echo $team['description'];
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