<?php
    $user = $this->data["user"];
?>
<!--
<div id="wrap">
	<ul>
		<li> UserName =  </li>
		<li> Email = </li>
	</ul>
</div>
-->

<div id="wrap">
	<form method="POST" action="<?= WEBROOT; ?>user/edit/<?= $user->getId(); ?>">
		<h3>Edit your datas</h3>
		<div class="input-grp">
			<input type="email" placeholder="Email" name="email" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="Username" name="username" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="First name" name="first_name" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="Last name" name="last_name" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="Phone number" name="phone_number" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="Old password" name="old_password" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="New password" name="new_password" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="text" placeholder="Confirm new password" name="confirm_new_password" class="form-control" value="">
		</div>
		<div class="input-grp">
			<input type="hidden" name="edit_form" value="true">
			<input type="submit" value="Edit" name="submit" class="btn btn-primary">
		</div>
	</form>
</div>
<div class="panel-footer">
	<ul>
		<?php
		if (isset($this->data["errors"])) {
			foreach ($this->data["errors"] as $value) {
				echo "<li>".$value."</li>";
			}
		}
		?>
	</ul>
</div>