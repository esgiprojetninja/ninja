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
            <!-- IMAGE USER

            <div class="panel-media">
                <img src="<?= WEBROOT; ?>dist/images/monkey.jpg">
            </div>
            -->
            <div class="panel-heading"><h3><?php echo $user->getUsername(); ?></h3></div>
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
                    <li>
                        <span class="fa fa-team"></span>
                        <?php 
                            foreach($teams as $team){ 
                                $Team = Team::findById($team[1]);
                                echo '<a href='.WEBROOT.'team/show/'.$team[1].'>';
                                echo $Team->getTeamName()."<br>";
                                echo '</a>';
                            }
                        ?>
                    </li>
                </ul>
                <div class="text-right">
                    <a href="<?= WEBROOT; ?>user/edit/<?php echo $user->getId(); ?>" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>