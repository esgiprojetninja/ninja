<?php
    $team = $this->data["team"];
?>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <?php if(!$team->getTeamName()):?>
            <div class="panel-body">
                <h3>Team not found</h3>
            </div>
            <?php else : ?>
            <!-- IMAGE EQUIPE

            <div class="panel-media">
                <img src="<?= WEBROOT; ?>dist/images/monkey.jpg">
            </div>
            -->
            <div class="panel-heading"><h3>Manage my team</h3></div>
            <div class="panel-body">
               	<p>Team name : <?= $team->getTeamName(); ?></p>
               	<p>Date of Creation : <?= $team->getDateCreated(); ?></p>
               	<p>Description : <?= $team->getDescription(); ?></p>
               	<br><br>
               	<div class="text-left">
               		<a href="<?= WEBROOT;?>team/show/<?= $team->getId();?>"class="btn btn-primary">Show</a>
               		<a href="<?= WEBROOT;?>team/edit/<?= $team->getId();?>"class="btn btn-primary">Edit</a>
                  <button type="button" class="btn btn-danger pull-right">Supprimer mon équipe</button>
               	</div>
               	<br><br>

               	<p>Members : </p>
                <?php 
                    foreach($members as $member){ 
                    	$user = User::findById($member[2]);
                      echo "<br>".$user->getUsername();
                      if(!($user->getId() == $_SESSION["user_id"])){ ?>
                        <a href="#" >Send message</a>
                        <a href="#" >Kick</a>
                      <?php
                      }
                    }
                ?>
                <br><br>
                <div class="text-left">
               		<a href="<?= WEBROOT;?>team/invite/<?= $team->getId();?>"class="btn btn-primary">Invite</a>
               	</div>
                <!--
                    AFFICHER DERNIER EVENT ?
                    EVENT RECURRENT ?
                -->
        
               
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
