<?php
    $user = $this->data["user"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary2">
            <?php if(!$user->getUsername()):?>
            <div class="panel-body">
                <h3>User not found</h3>
            </div>
            <?php else : ?>


            <div class="panel-heading"><h3 class="center header-li"> Informations <?php echo $user->getUsername(); ?>'s profile</h3></div>

            <div class="panel-media">
                <?php if($user->getAvatar() != ""): ?>
                    <img class="avatar" src="<?= "../../".$user->getAvatar(); ?>" style="width:100px;height:100px">
                <?php endif;?>
            </div>

            <div class="panel-body">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <ul class="header-ul">
                            <li class="li-list fa fa-user"> Personnal</li>
                            <li class="li-list">
                                <span class="form-info">Firstname : </span>
                                <span class="form-content"><?php echo $user->getFirstName(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Lastname : </span>
                                <span class="form-content"><?php echo $user->getLastName(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Favorites sports : </span>
                                <span class="form-content"><?php echo $user->getFavoriteSports(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Birthday : </span>
                                <span class="form-content"><?php echo $user->getBirthday(); ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="header-ul">
                            <li class="li-list"><span class=" fa fa-phone"></span> <span class=" fa fa-at"></span> Contact</li>
                            <li class="li-list">
                               <span class="form-info">Email address : </span>
                                <span class="form-content"><?php echo $user->getEmail(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Phone number : </span>
                                <span class="form-content"><?php echo $user->getPhoneNumber(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Country : </span>
                                <span class="form-content"><?php echo $user->getCountry(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">City : </span>
                                <span class="form-content"><?php echo $user->getCity(); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endif;?>
                <?php if(User::itsMy($idUser)): ?>
                    <div class="text-right">
                        <a href="<?= WEBROOT; ?>user/edit/<?php echo $user->getId(); ?>" class="btn btn-primary">Edit</a>
                    </div>
                <?php else: ?>
                    <a>&nbsp;</a>
                <?php endif; ?>
            </div>

        </div>
        <div class="panel panel-primary2">
            <div class="panel-heading"><h3 class="center header-li">Others</h3></div>
            <div class="panel-body">
                <ul class="header-ul">
                    <?php if(!empty($teams)){ ?>
                        <li>
                        <span class="fa fa-users"> Groups</span>
                        <?php
                            foreach($teams as $team){
                                $Team = Team::findById($team->getIdTeam());
                                echo '
                                        <li class="li-list">
                                            <span class="form-content"><a href="'.WEBROOT.'team/show/'.$Team->getId().'">'.$Team->getTeamName().'</span>
                                        </li>
                                    ';
                            }
                        ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
