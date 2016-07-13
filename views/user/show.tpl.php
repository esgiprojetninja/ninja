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
                            <span class="form-info">Username : </span>
                            <span class="form-content"><?php echo $user->getUsername(); ?></span>
                        </li>
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
                            <span class="form-info">Location : </span>
                            <span class="form-content"><?php echo $user->getCity(); ?></span>
                        </li>
                    </ul>
                </div>
                </div>
                <?php endif;?>
                <div class="text-right">
                    <a href="<?= WEBROOT; ?>user/edit/<?php echo $user->getId(); ?>" class="btn btn-primary edit-button">Edit your profile</a>
                </div>
            </div>

        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="center header-li">Groups</h3></div>
            <div class="panel-body">
                <ul class="header-ul">
                    <?php
                    if(!empty($teams)) {
                        foreach ($teams as $team) {
                            $Team = Team::findById($team[1]);
                            echo '<li class="li-list"><span class="form-info">Group : </span>';
                            echo "<a href=' . WEBROOT . 'team/show/' . $team[1] . '>" . $Team->getTeamName() . "</a>";
                            echo "<span class=\"form-info\"> Description : </span>" . $Team->getDescription(). "<br></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>