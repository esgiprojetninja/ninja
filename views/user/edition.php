<!-- formulaire d'inscription -->
<div id="wrap">
	<form method="POST">
		<label for="ages"> Votre date d'anniversaire </label>
			<select name="jours"  class="imin">
				<?php
				$i = 1;
				while($i <= 31){
					echo "<option value='".$i."'>".$i."</option>";
					$i++;
				}
				?>
			</select>
			<select name="mois" class="imin">
				<?php
				$i = 1;
				while($i <= 12){
					echo "<option value='".$i."'>".$i."</option>";
					$i++;
				}
				?>
			</select>
			<select name="annee" class="imin">
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
		<label> Pratiquez vous d'autres sports ? </label>
			<select type="text" name="sports2">
					<option value="" disabled selected> Selectionner un sport </option>
			</select>
		<br>
			<select name="level">
				<option value="" disabled selected> Votre niveau </option>
				<option value=""> + </option>
				<option value=""> ++ </option>
				<option value=""> +++ </option>
				<option value=""> ++++ </option>
			</select>
		<br>
		<br>
		<label > Vous pratiquez depuis ? </label>
			<select name="since">
				<option value="" disabled selected> Selectionner une période </option>
				<option value=""> > 1 mois </option>
				<option value=""> > 3 mois </option>
				<option value=""> > 6 mois </option>
				<option value=""> > 1 ans  </option>
			</select>
		<br>
		<br>
		<label for="like"> Votre intérêt pour le sport </label>
			<select name="like" id="like">
				<option value="" disabled selected> Selectionner votre intérêt </option>
				<option value=""> * </option>
				<option value=""> ** </option>
				<option value=""> *** </option>
				<option value=""> **** </option>
			</select>
		<br>
		<br>
			<img id="captcha" src="private/include/captcha.php" alt="CAPTCHA">
		<br> 
			<input type="text" name="captcha" placeholder="Code captcha">
		<br>
			<span class="condition">En cliquant ci-dessous :</span> <br>
			<input type="checkbox" name="CGU" value="1" id="CGU">
		<br>
			<span class="condition"> <em> Vous acceptez nos Conditions Générales d'Utilisation (CGU). </em> </span> 
		<br>
		<br>
			<input type="submit" value="Valider" class="accept">
	</form>
	<div id="pannelError">
	<p>
	Champs à mettre en place : <br>
		- L'intérêt pour le sport <br>
		- Ami qui pratique ( O/N ) <br>
	</p>
	</div>
</div>
