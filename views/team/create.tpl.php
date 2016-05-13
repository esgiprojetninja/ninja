Create a new team

<form action="<?= WEBROOT; ?>team/create" method="post">
	<input type="text" placeholder="Team name" name="teamName" class="form-control" value="">
    <input type="text" placeholder="Team description" name="description" class="form-control" value="">
    <!-- Rajouter un sport à l'équipe
    <select>
    	<option>Football</option>
    	<option>Basketball</option>
    </select>
	-->
    <input type="hidden" name="team_creation_form" value="true">
    <input type="submit" value="Create" name="submit" class="btn btn-primary">
</form>

<ul>
    <?php
      if (isset($this->data["errors"])) {
        foreach ($this->data["errors"] as $value) {
          echo "<li>".$value."</li>";
        }
      }
    ?>
</ul>
<?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>
