<?php
    $team = $this->data["team"];
    //Se l'utilisateur y accede par URL, mais n'a pas les droit ont le redirige
    if(!User::isAdmin()){
      if(!($captain[0]['captain'] > 0)){
        header('Location:'.WEBROOT);
      }
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
                  <?php if($captain[0]['captain'] >=1) : ?>
                   <a href="<?= WEBROOT;?>team/edit/<?= $team->getId();?>"class="btn btn-primary">Edit</a>
                  <?php endif; ?>
                  <?php if($captain[0]['captain'] >= 2) : ?>
                    <a href="#" data-team="<?php echo $team->getId(); ?>" class="btn btn-danger pull-right deleteTeam">Supprimer mon équipe</a>
                  <?php endif; ?>
                </div>
                <br><br>

                <p>Members : </p>
                <?php 
                    foreach($members as $member){ 
                      $user = User::findById($member[2]);
                      $actualUserAdmin = Captain::findBy(["idUser","idTeam"],[$user->getId(),$team->getId()],["int","int"]);
                      echo "<br>".$user->getUsername()." - " . Captain::getTitre($actualUserAdmin->getCaptain());
                      if(!($user->getId() == $_SESSION["user_id"])){ ?>
                        <a href="#" >Send message</a>
                         <?php if($actualUserAdmin->getCaptain() != 2 ): ?>
                        <a href="#" data-team="<?php echo $team->getId(); ?>" data-user="<?php echo $user->getId(); ?>" class="kickUser" >Kick</a>
                        <?php endif; ?>
                       <?php if($captain[0]['captain'] >= 2 ): ?>
                        <?php if($actualUserAdmin->getCaptain() != 2 && $actualUserAdmin->getCaptain() >= 0 ): ?>
                        <a href="#" data-team="<?php echo $team->getId(); ?>" data-user="<?php echo $user->getId(); ?>" class="promoteUser" >Promote</a>
                        <?php endif; ?>
                        <?php if($actualUserAdmin->getCaptain() != 2 && $actualUserAdmin->getCaptain() > 0): ?>
                        <a href="#" data-team="<?php echo $team->getId(); ?>" data-user="<?php echo $user->getId(); ?>" class="demoteUser">Demote</a>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php
                      }
                    }
                ?>
                <br><br>
                <div class="text-left">
                  <a href="<?= WEBROOT;?>team/invite/<?= $team->getId();?>"class="btn btn-primary">Invite</a>
                  <a href="#" data-team="<?php echo $team->getId(); ?>" class="btn btn-primary pull-right leaveTeam">Leave</a>
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
