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
                    ?>
                </table>
                <br>
                <a href="<?= WEBROOT;?>team/create"class="btn btn-primary">Create your now!</a>
            </div>
        </div>
    </div>
</div>