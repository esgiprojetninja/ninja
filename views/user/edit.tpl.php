<?php
    //$user = $this->data["user"];
    if(!User::itsMy($idUser)){
        header("location: ".WEBROOT."index");
    }
?>
<div class="row">
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-heading"><h3 class="upper center">Edit your profil</h3></div>
            <div class="panel-body">

            <?php if($user->getAvatar() != ""): ?>
               <img class="avatar" src="<?= "../../".$user->getAvatar(); ?>" style="width:100px;height:100px">
            <?php endif;?>

                <?php
                    if($formEdit["struct"]["hidden-avatar"]["value"] == "avatar-hidden-true"){
                      echo '<a href="#" class="ajax-link" data-url="user/deleteAvatar">Delete my avatar</a>';
                    }else{
                      //VERIFIER SI LE PROFIL EST COMPLET, SI OUI ON PEUX RAJOUTER UN AVATAR,
                      // SINON ON MET UN TEXte : 3VEUILLEZ REMPLIR VOTRE PROFIL
                      echo "nicolas petit zizi";
                    }

                    $this->createForm($formEdit, $editErrors);

                ?>
            </div>
        </div>
    </div>
</div>

<?php echo isset($this->data["success"]) ? $this->data["success"] : "" ?>
<?php echo isset($this->data["movingFile"]) ? $this->data["movingFile"] : "" ?>
