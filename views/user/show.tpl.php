<?php
    $user = $this->data["user"];
?>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <?php if(!$user->getUsername()):?>
            <div class="panel-body">
                <h3>User not found</h3>
            </div>
            <?php else : ?>
            
            
            <div class="panel-heading"><h3 class="upper center"><?php echo $user->getUsername(); ?></h3></div>
            
            <div class="panel-media">
                <?php if($user->getAvatar() != ""): ?>
                    <img class="avatar" src="<?= "../../".$user->getAvatar(); ?>" style="width:100px;height:100px">
                <?php endif;?>
            </div>

            <div class="panel-body">
                <ul>
                    <li>
                        <span class="fa fa-at"></span>
                        <?php echo $user->getEmail(); ?>
                    </li>
                    <li>
                        <span class="fa fa-user"></span>
                        <?php echo $user->getFirstName(); ?>
                        <?php echo $user->getLastName(); ?>
                    </li>
                    <li>
                        <span class="fa fa-phone"></span>
                        <?php echo $user->getPhoneNumber(); ?>
                    </li>
                    <?php if(!empty($teams)){ ?><li>
                        <span class="fa fa-team"></span>
                        <?php 
                            foreach($teams as $team){
                                $Team = Team::findById($team->getIdTeam());
                                echo '<a href='.WEBROOT.'team/show/'.$team->getIdTeam().'>';
                                echo $Team->getTeamName()."<br>";
                                echo '</a>';
                            }
                        ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php if(User::itsMy($idUser)): ?>
                    <div class="text-right">
                        <a href="<?= WEBROOT; ?>user/edit/<?php echo $user->getId(); ?>" class="btn btn-primary">Edit</a>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>