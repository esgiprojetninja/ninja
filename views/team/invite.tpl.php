 <?php
 //Se l'utilisateur y accede par URL, mais n'a pas les droit ont le redirige
    if(!($admin[0]['captain'] > 0)){
      header('Location:'.WEBROOT.'user/login');
    }
?>

Invite a new user

<form action="<?= WEBROOT; ?>team/invite/<?= $id ?>" method="post">
	<input type="text" placeholder="Username or Email" name="usernameOrEmail" class="form-control" value="">
    <!-- Rajouter un sport à l'équipe
    <select>
    	<option>Football</option>
    	<option>Basketball</option>
    </select>
	-->
    <input type="hidden" name="team_invite_form" value="true">
    <input type="submit" value="Invite" name="submit" class="btn btn-primary">
</form>

<ul>
    <?php
      if (isset($this->data["errors"])) {
        foreach ($this->data["errors"] as $value) {
          //echo "<li>".$value."</li>";
            var_dump($value);
        }
      }
    ?>
</ul>
<?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>
