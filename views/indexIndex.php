<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary2">
            <div class="panel-heading">10 last subscribers</div>
            <div class="panel-body">
                <?php
                    foreach($users as $user){
                        echo $user['username'].'<br>';
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
                    foreach($teams as $team){
                        echo $team['teamName'].'<br>';
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
                        foreach ($invitations as $invitation) {
                            $idTeamInviting = $invitation['idTeamInviting'];
                            //echo $idTeamInviting;
                            $teamInviting = Team::FindById($idTeamInviting);
                            echo "The team <b>" . $teamInviting->getTeamName()."</b> has invited you the " . $invitation['dateInvited']." : ".$invitation['message'];
                            echo ' - <a href="#" data-team="'.$idTeamInviting.'" data-user="'.$_SESSION['user_id'].'" class="joinTeam">Join</a>';
                            echo ' - <a href="#" data-team="'.$idTeamInviting.'" data-user="'.$_SESSION['user_id'].'" class="refuseInvit">Don\'t join</a>';
                        
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>