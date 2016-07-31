<?php
$team = $this->data["team"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <?php if($team->getId() == null):?>
            <div class="panel-body">
                <h3>Équipe introuvable</h3>
            </div>
            <?php else : ?>

            <div class="panel-heading"><h3 class="center header-li"> <?php echo $team->getTeamName(); ?> </h3></div>

            <div class="panel-media" style="background-image: url('<?= WEBROOT ?><?= $team->getAvatar() ?>')">
            </div>

            <div class="panel-body">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <ul class="header-ul">
                            <li class="li-list fa fa-info"> Informations </li>
                            <li class="li-list">
                                <span class="form-info">Description : </span>
                                <span class="form-content"><?php echo $team->getDescription(); ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Date de création : </span>
                                <?php
                                  $dateCreation = $team->getDateCreated();
                                  $mois = ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
                                  $date = date("d ",strtotime($dateCreation)). $mois[(date("n ",strtotime($dateCreation))- 1)]. date(" Y à H:i",strtotime($dateCreation));
                                ?>
                                <span class="form-content"><?php echo $date; ?></span>
                            </li>
                            <li class="li-list">
                                <span class="form-info">Sports : </span>
                                <span class="form-content"><?php echo $team->getSports(); ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="header-ul">
                            <li class="li-list"><li class="li-list fa fa-user"> </span> Membres</li>
                            <?php
                            foreach($members as $member){
                                    $user = User::findById($member->getIdUser());
                                    echo '
                                        <li class="li-list">
                                            <span class="form-content"><a href="'.WEBROOT.'user/show/'.$user->getId().'">'.$user->getUsername().'</span>
                                        </li>
                                    ';
                                }

                            ?>
                        </ul>
                    </div>
                </div>
                <?php if(Team::imIn($team->getId())): ?>
                    <div class="text-right">
                        <a href="<?= WEBROOT; ?>team/manage/<?php echo $team->getId(); ?>" class="btn btn-primary">Gérer</a>
                    </div>
                <?php endif; ?>
                <?php if(!Team::imIn($idTeam)): ?>
                  <?php if($invitationsFromTeam): ?>
                    <div class="text-right">
                        <a href="#" class="btn btn-success ajax-link" data-team="<?= $idTeam; ?>" data-url="team/join">Accepter invitation</a>
                          <a href="#" class="btn btn-danger ajax-link" data-team="<?= $idTeam; ?>" data-url="team/cancelInvitation">Rejeter invitation</a>
                    </div>
                  <?php else: ?>
                   <?php if($invitation): ?>
                       <div class="text-right">
                           <a href="#" class="btn btn-success ajax-link" data-team="<?= $idTeam; ?>" data-url="team/cancelInvitation">Annuler demande</a>
                       </div>
                   <?php else: ?>
                       <div class="text-right">
                          <a href="#" id="askToJoin" class="btn btn-primary poplight" rel="askToJoinHidden">Demander à rejoindre</a>
                       </div>
                   <?php endif; ?>
                 <?php endif; ?>
               <?php endif; ?>
            </div>
                <?php endif;?>
        </div>
    </div>
</div>
<div class="row" id="askToJoinHidden" class="popup_block">
    <div class="col-sm-12">
        <div class="panel panel-primary">
             <div class="panel-body">
                <?php
                  $this->createForm($formAskToJoin,[]);
                  /*<a href="#" class="btn btn-primary ajax-link prompt" data-team="<?= $idTeam; ?>" data-url="team/askToJoin"*/
                ?>
             </div>
        </div>
    </div>
</div>
