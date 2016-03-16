<!-- formulaire d'inscription -->
<div id="wrap">
	<form method="POST">
			
			<input type="text" placeholder="Votre Prénom" name="first_name" value=""> <input type="text" placeholder="Nom de famille" name="last_name" value="">
		<br>
			<select type="text" name="sports1" class="ilarge">
					<option value="" disabled selected>Votre sport favori</option>
					<option value=""> Karate </option>
					<option value=""> Judo </option>
					<option value=""> Box </option>
			</select>
		<br>
			<input type="email" placeholder="monputaindemail@jedi.ga" name="email" class="ilarge" value="">
		<br>
			<input type="email" placeholder=" monputaindemail@jedi.ga" name="confemail" class="ilarge" value="">
		<br>
		<br>
		<label for="jours"> Votre date d'anniversaire </label>
			<select name="jours"  class="imin" id="jours">
				<option value="" disabled selected>JJ</option>
				<?php
				$i = 1;
				while($i <= 31){
					echo "<option value='".$i."'>".$i."</option>";
					$i++;
				}
				?>
			</select>
			<select name="mois" class="imin">
				<option value="" disabled selected>MM</option>
				<?php
				$i = 1;
				while($i <= 12){
					echo "<option value='".$i."'>".$i."</option>";
					$i++;
				}
				?>
			</select>
			<select name="annee" class="imin">
				<option value="" disabled selected>AAAA</option>
				<?php
				$i = 1960;
				while($i <= 2016){
					echo "<option value='".$i."'>".$i."</option>";
					$i++;
				}
				?>
			</select>
		<br>
		<br>
		<label for="password"> Votre mot de passe </label>
			<input type="password" name="password" placeholder="*************" id="password">
		<label for="confpassword"> Confirmation mot de votre mot de passe </label>
			<input type="password" name="conf_password" placeholder="*************" id="confpassword">
		<br>
		<br>
			<button type="submit" class="accept" formaction="index.php?subscribe_2"> S'INSCRIRE </button>
	</form>
	<div id="pannelError">
	</div>
</div>