<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary2">
            <div class="panel-heading">10 last subscribers</div>
            <div class="panel-body">
                <?php
                    if(count($users) == 0){
                        echo '<h1> No User yet</h1>';
                    }else{
                      if(count($users) == 1){
                        $link = WEBROOT."user/show/".$users->getId();
                        echo '<a href="'.$link.'">'.$users->getUsername().'</a><br>';
                      }else{
                        foreach($users as $user){
                          $link = WEBROOT."user/show/".$user->getId();
                          echo '<a href="'.$link.'">'.$user->getUsername().'</a><br>';
                        }
                      }
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">10 last teams</div>
            <div class="panel-body">
                <?php
                    if(count($teams) == 0){
                        echo '<h1> No team yet</h1>';
                    }else{
                      if(count($teams) == 1){
                        $link = WEBROOT."team/show/".$teams->getId();
                        echo '<a href="'.$link.'">'.$teams->getTeamName().'</a><br>';
                      }else{
                        foreach($teams as $team){
                          $link = WEBROOT."team/show/".$team->getId();
                          echo '<a href="'.$link.'">'.$team->getTeamName().'</a><br>';
                        }
                      }
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-warning">
            <div class="panel-heading">10 last events</div>
            <div class="panel-body">
                <h1>COMING SOON</h1>
            </div>
        </div>
    </div>

    <!--
        Désolé Renaud de polluer cette belle page mais en attendant les notifications je fout ça la <3
    -->
    <?php if($invitations): ?>
        <div class="col-sm-6">
            <div class="panel panel-danger">
                <div class="panel-heading">Your invitations</div>
                <div class="panel-body">
                    <?php
                      if(!is_array($invitations)){
                        $idTeamInviting = $invitations->getIdTeamInviting();
                        $teamInviting = Team::FindById($idTeamInviting);
                        echo "The team <b>" . $teamInviting->getTeamName()."</b> has invited you the " . $invitations->getDateInvited()." : ".$invitations->getMessage();
                        echo ' - <a href="#" data-url="team/join" class="ajax-link" data-team="'.$idTeamInviting.'" data-type="0">Join</a>';
                        echo ' - <a href="#" data-url="team/cancelInvitation" class="ajax-link" data-team="'.$idTeamInviting.'" data-user="'.$_SESSION['user_id'].'" >Don\'t join</a>';
                      }else{
                        foreach ($invitations as $invitation) {
                          $idTeamInviting = $invitation->getIdTeamInviting();
                          $teamInviting = Team::FindById($idTeamInviting);
                          echo "The team <b>" . $teamInviting->getTeamName()."</b> has invited you the " . $invitation->getDateInvited()." : ".$invitation->getMessage();
                          echo ' - <a href="#" data-url="team/join" class="ajax-link" data-team="'.$idTeamInviting.'" data-type="0">Join</a>';
                          echo ' - <a href="#" data-url="team/cancelInvitation" class="ajax-link" data-team="'.$idTeamInviting.'" data-user="'.$_SESSION['user_id'].'" >Don\'t join</a>';
                        }
                      }
                    ?>
                </div>
            </div>
        </div>
    <?php endif;?>

    <?php
    // Pour créer une notif test
    //Notification::createNotification("blah blah notification de l'user ".$_SESSION['user_id']);
    ?>

</div>