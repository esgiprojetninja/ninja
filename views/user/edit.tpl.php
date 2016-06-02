<?php
    //$user = $this->data["user"];
?>
<div class="row">
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-body">
                <?php
                    $this->createForm($formEdit, $editErrors);
                ?>
                <?php if($user->getAvatar() != ""): ?>
                    <img src="<?= "../../".$user->getAvatar(); ?>" style="width:80px;height:80px">
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php echo isset($this->data["success"]) ? $this->data["success"] : "" ?>
<?php echo isset($this->data["movingFile"]) ? $this->data["movingFile"] : "" ?>
