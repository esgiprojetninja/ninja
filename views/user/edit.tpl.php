<?php
    //$user = $this->data["user"];
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
                    $this->createForm($formEdit, $editErrors);
                ?>
            </div>
        </div>
    </div>
</div>

<?php echo isset($this->data["success"]) ? $this->data["success"] : "" ?>
<?php echo isset($this->data["movingFile"]) ? $this->data["movingFile"] : "" ?>
