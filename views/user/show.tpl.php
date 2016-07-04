<?php
    $user = $this->data["user"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <?php if(!$user->getUsername()):?>
            <div class="panel-body">
                <h3>User not found</h3>
            </div>
            <?php else : ?>
            
            
            <div class="panel-heading"><h3 class="upper center">Your profile</h3></div>
            
            <div class="panel-media">
                <?php if($user->getAvatar() != ""): ?>
                    <img class="avatar" src="<?= "../../".$user->getAvatar(); ?>" style="width:100px;height:100px">
                <?php endif;?>
            </div>

            <div class="panel-body">
                <ul class="header-ul">
                    <li class="header-li">Your informations :</li>
                    <li class="li-list fa fa-user"></li>
                    <li class="li-list">
                        <span class="form-info">Your username :</span>
                        <span class="form-content"><?php echo $user->getUsername(); ?></span>
                    </li>
                    <li class="li-list">
                        <span class="form-info">Your lastname :</span>
                        <span class="form-content"><?php echo $user->getLastName(); ?></span>
                    </li>
                    <li class="li-list">
                        <span class="form-info">Your firstname :</span>
                        <span class="form-content"><?php echo $user->getFirstName(); ?></span>
                    </li>
                </ul>
                <ul class="header-ul">
                    <li class="li-list"><span class=" fa fa-phone"></span> <span class=" fa fa-at"></span></li>
                    <li class="li-list">
                        <span class="form-info">Email address :</span>
                        <span class="form-content"><?php echo $user->getEmail(); ?></span>
                    </li>
                    <li class="li-list">
                        <span class="form-info">Phone number :</span>
                        <span class="form-content"><?php echo $user->getPhoneNumber(); ?></span>
                    </li>
                </ul>
                <ul class="header-ul">
                    <span class="fa fa-team header-li">Your groups :</span>
                    <?php if(!empty($teams)){ ?>
                        <?php
                            foreach($teams as $team){ 
                                $Team = Team::findById($team[1]);
                                echo '<li class="li-list"><a href='.WEBROOT.'team/show/'.$team[1].'>';
                                echo $Team->getTeamName()."<br>";
                                echo '</li></a>';
                            }
                        ?>
                    <?php } ?>
                </ul>
                <div class="text-right">
                    <a href="<?= WEBROOT; ?>user/edit/<?php echo $user->getId(); ?>" class="btn btn-primary">Edit your profile</a>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>