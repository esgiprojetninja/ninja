 <?php
 //Se l'utilisateur y accede par URL, mais n'a pas les droit on le redirige
    if(!($admin[0]['captain'] > 0)){
      header('Location:'.WEBROOT.'user/login');
    }

    $this->createForm($formInviteTeam,$inviteErrors);
?>

<?php echo isset($this->data["error"]) ? $this->data["error"] : "" ?>

<?php echo isset($this->data["success"]) ? $this->data["success"] : "" ?>