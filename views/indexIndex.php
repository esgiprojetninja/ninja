<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary2">
            <div class="panel-heading">10 last subscribers</div>
            <div class="panel-body">
                <?php
                    if($users == null){
                        echo '<h1> No User yet</h1>';
                    }else{
                        foreach($users as $user){
                          $link = WEBROOT."user/show/".$user->getId();
                          echo '<a href="'.$link.'">'.$user->getUsername().'</a><br>';
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
                    if($teams == null){
                        echo '<h1> No team yet</h1>';
                    }else{
                        foreach($teams as $team){
                          $link = WEBROOT."team/show/".$team->getId();
                          echo '<a href="'.$link.'">'.$team->getTeamName().'</a><br>';
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
              <?php
                  if($events == null){
                      echo '<h1> No events yet</h1>';
                  }else{
                      foreach($events as $event){
                        $link = WEBROOT."event/list";
                        echo '<a href="'.$link.'">'.$event->getName().'</a><br>';
                      }
                  }
              ?>
            </div>
        </div>
    </div>


    <?php
    // Pour créer une notif test
    //Notification::createNotification("blah blah notification de l'user ".$_SESSION['user_id']);
    ?>

</div>
