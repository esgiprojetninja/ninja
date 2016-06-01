<?php
    $team = $this->data["team"];
    //Se l'utilisateur y accede par URL, mais n'a pas les droit ont le redirige
    if(!($admin[0]['captain'] > 0)){
      header('Location:'.WEBROOT.'user/login');
    }
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
                  <?php if($admin[0]['captain'] >=1) : ?>
                   <a href="<?= WEBROOT;?>team/edit/<?= $team->getId();?>"class="btn btn-primary">Edit</a>
                  <?php endif; ?>
                  <?php if($admin[0]['captain'] >= 2) : ?>
                    <button type="button" class="btn btn-danger pull-right">Supprimer mon équipe</button>
                  <?php endif; ?>
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
                       <?php if($admin[0]['captain'] >= 2): ?>
                        <a href="#" >Promote</a>
                        <a href="#" >Demote</a>
                      <?php endif; ?>
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
