<?php 
  $this->createForm($formCreateTeam,$creaErrors);
?>

<?php echo isset($this->data["success"]) ? $this->data["success"] : "" ?>