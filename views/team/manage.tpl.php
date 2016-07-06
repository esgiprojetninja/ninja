<?php
    $team = $this->data["team"];
    $captain = $this->data["captain"];
    //Se l'utilisateur y accede par URL, mais n'a pas les droit ont le redirige
    if(!$team->getId() == ""){
      if(!Team::imIn($team->getId())){
        header('Location:'.WEBROOT.'user/login');
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
                  <?php if($captain->getCaptain() >=1) : ?>
                   <a href="<?= WEBROOT;?>team/edit/<?= $team->getId();?>"class="btn btn-primary">Edit</a>
                  <?php endif; ?>
                  <?php if($captain->getCaptain() >= 2) : ?>
                    <a href="#" data-message="Your team has been deleted" data-url="team/delete" data-team="<?= $team->getId(); ?>" class="ajax-link btn btn-danger pull-right">Supprimer mon équipe</a>
                  <?php endif; ?>
                </div>
                <br><br>

                <p>Members : </p>
                <?php
                if(!is_array($members)){
                  $user = User::findById($members->getIdUser());
                  $actualUserAdmin = Captain::findBy(["idUser","idTeam"],[$user->getId(),$team->getId()],["int","int"]);
                  echo "<br>".$user->getUsername()." - " . Captain::getTitre($actualUserAdmin->getCaptain());
                  if(!($user->getId() == $_SESSION["user_id"])){ ?>
                    <a href="#" >Send message</a>
                     <?php if($actualUserAdmin->getCaptain() != 2 ): ?>
                   <a href="#"  data-message="Member has been kicked" data-url="team/kick" data-team="<?= $team->getId()?>" data-user="<?= $user->getId()?>" class="ajax-link" >Kick</a>
                   <?php endif; ?>
                  <?php if($captain->getCaptain() >= 2 ): ?>
                   <?php if($actualUserAdmin->getCaptain() != 2 && $actualUserAdmin->getCaptain() >= 0 ): ?>
                   <a href="#" data-message="Member has been promoted" data-url="team/promote" data-team="<?= $team->getId()?>" data-user="<?= $user->getId()?>" class="ajax-link" >Promote</a>
                   <?php endif; ?>
                   <?php if($actualUserAdmin->getCaptain() != 2 && $actualUserAdmin->getCaptain() > 0): ?>
                   <a href="#" data-message="Member has been demoted" data-url="team/demote" data-team="<?= $team->getId()?>" data-user="<?= $user->getId()?>" class="ajax-link">Demote</a>
                   <?php endif; ?>
                  <?php endif; ?>
                  <?php
                  }
                }else{
                    foreach($members as $member){
                      $user = User::findById($member->getIdUser());
                      $actualUserAdmin = Captain::findBy(["idUser","idTeam"],[$user->getId(),$team->getId()],["int","int"]);
                      echo "<br>".$user->getUsername()." - " . Captain::getTitre($actualUserAdmin->getCaptain());
                      if(!($user->getId() == $_SESSION["user_id"])){ ?>
                        <a href="#" >Send message</a>
                         <?php if($actualUserAdmin->getCaptain() != 2 ): ?>
                        <a href="#"  data-message="Member has been kicked" data-url="team/kick" data-team="<?= $team->getId()?>" data-user="<?= $user->getId()?>" class="ajax-link" >Kick</a>
                        <?php endif; ?>
                       <?php if($captain->getCaptain() >= 2 ): ?>
                        <?php if($actualUserAdmin->getCaptain() != 2 && $actualUserAdmin->getCaptain() >= 0 ): ?>
                        <a href="#" data-message="Member has been promoted" data-url="team/promote" data-team="<?= $team->getId()?>" data-user="<?= $user->getId()?>" class="ajax-link" >Promote</a>
                        <?php endif; ?>
                        <?php if($actualUserAdmin->getCaptain() != 2 && $actualUserAdmin->getCaptain() > 0): ?>
                        <a href="#" data-message="Member has been demoted" data-url="team/demote" data-team="<?= $team->getId()?>" data-user="<?= $user->getId()?>" class="ajax-link">Demote</a>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php
                      }
                    }
                }
                ?>
                <hr>
                <?php if(count($invitationsTo) > 0) : ?>
                  <p>Pending invitations : </p>
                  <?php
                    if(!is_array($invitationsTo)){
                      $userInvited = User::FindById($invitationsTo->getIdUserInvited());
                      echo $invitationsTo->getDateInvited()." - " .$userInvited->getUsername() ." - ".$invitationsTo->getMessage().' - <a href="#" data-message="Invitation canceled" data-url="team/cancelInvitation" data-team='.$invitationsTo->getIdTeamInviting().' data-user='.$userInvited->getId().' class="ajax-link">Cancel</a>';
                    }else{
                      foreach($invitationsTo as $invitedOne){
                        $userInvited = User::FindById($invitedOne->getIdUserInvited());
                        echo $invitedOne->getDateInvited()." - " .$userInvited->getUsername() ." - ".$invitedOne->getMessage().' - <a href="#" data-message="Invitation canceled" data-url="team/cancelInvitation" data-team='.$invitedOne->getIdTeamInviting().' data-user='.$userInvited->getId().' class="ajax-link">Cancel</a>';
                        echo '<BR>'; // SWAG TU AIMES BIEN RENAUD ? :(
                      }
                    }
                  ?>
                  <hr>
                <?php endif; ?>

                <?php if(count($invitationsFrom) > 0): ?>
                  <p>Pending asking to come  : </p>
                  <?php
                      if(!is_array($invitationsFrom)){
                        $userInvited = User::FindById($invitationsFrom->getIdUserInvited());
                        echo $invitationsFrom->getDateInvited()." - " .$userInvited->getUsername() ." - ".$invitationsFrom->getMessage().' - <a href="#" data-message="Invitation accepted" data-url="team/join" data-team='.$invitationsFrom->getIdTeamInviting().' data-type='.$invitationsFrom->getType().' data-user='.$userInvited->getId().' class="ajax-link">Accept</a> - <a href="#" class="ajax-link" data-message="Invitation refused" data-url="team/cancelInvitation" data-team='.$invitationsFrom->getIdTeamInviting().' data-user='.$userInvited->getId().' data-type='.$invitationsFrom->getType().' >Decline</a>';
                      }else{
                        foreach($invitationsFrom as $invitedOne){
                          $userInvited = User::FindById($invitationsFrom->getIdUserInvited());
                          echo $invitedOne->getDateInvited()." - " .$userInvited->getUsername() ." - ".$invitedOne->getMessage().' - <a href="#" data-message="Invitation accepted" data-url="team/join" data-team='.$invitedOne->getIdTeamInviting().' data-type='.$invitedOne->getType().' data-user='.$userInvited->getId().' class="ajax-link">Accept</a> - <a href="#" class="ajax-link" data-message="Invitation refused" data-url="team/cancelInvitation" data-team='.$invitedOne->getIdTeamInviting().' data-user='.$userInvited->getId().' data-type='.$invitedOne->getType().'>Decline</a>';
                          echo '<BR>'; // SWAG TU AIMES BIEN RENAUD ? :(
                        }
                      }
                  ?>
                <?php endif; ?>
                <br><br>
                <div class="text-left">
                  <?php if($captain->getCaptain() > 0): ?>
                    <a href="<?= WEBROOT;?>team/invite/<?= $team->getId();?>"class="btn btn-primary">Invite</a>
                  <?php endif; ?>
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
