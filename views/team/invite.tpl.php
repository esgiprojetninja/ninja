 <?php
 //Se l'utilisateur y accede par URL, mais n'a pas les droit on le redirige
    if(!User::isAdmin()){
	    if(!($captain[0]['captain'] > 0)){
	      header('Location:'.WEBROOT);
	    }
	}

    $this->createForm($formInviteTeam,$inviteErrors);
?>

<?php echo isset($this->data["error"]) ? $this->data["error"] : "" ?>

<?php echo isset($this->data["success"]) ? $this->data["success"] : "" ?>