<?php
    $team = $this->data["team"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary ">
            <?php if(!$team->getTeamName()):?>
            <div class="panel-body">
                <h3>Team not found</h3>
            </div>
            <?php else : ?>


                <div class="panel-media">
                <?php if($team->getAvatar() != ""): ?>
                    <img src="<?= "../../".$team->getAvatar(); ?>" style="width:80px;height:80px">
                <?php endif;?>
            </div>
            <div class="panel-heading" ><h3 class="center header-li">Group <?php echo $team->getTeamName(); ?></h3></div>
            <div class="panel-body">
                <ul>
                    <li> Quick description :
                        <?php echo $team->getDescription(); ?>
                    </li>
                    <li>Created the :
                        <?php echo $team->getDateCreated(); ?>
                    </li>
                    <li>
                        <span class="fa fa-user">List of members : </span><br>
                        <?php
                            foreach($members as $member){ 
                                $user = User::findById($member[2]);
                                echo $user->getUsername()."<br>";
                            }
                        var_dump($team);
                        ?>
                    </li>
                    <!--
                        AFFICHER DERNIER EVENT ?
                        EVENT RECURRENT ?
                    -->
                </ul>
                <?php if($admin[0]['captain'] > 0): ?>
                    <div class="text-right">
                        <a href="<?= WEBROOT; ?>team/manage/<?php echo $team->getId(); ?>" class="btn btn-primary">Manage</a>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>