<!-- formulaire d'inscription -->
<div id="wrap">
	<form method="POST">
		
		<label for="ages"> Votre Ville </label>
			<input type="text" placeholder=" Paris" name="city">
		<br>
		<br>
		<label> Pratiquez vous un autres sports ? </label>
			<select type="text" name="sports2">
					<option value="" disabled selected>Votre sport favori</option>
					<option value="K"> Karate </option>
					<option value="J"> Judo </option>
					<option value="B"> Box </option>
			</select>
			<select name="level">
				<option value="" disabled selected> Votre niveau </option>
				<option value="+"> + </option>
				<option value="++"> ++ </option>
				<option value="+++"> +++ </option>
				<option value="++++"> ++++ </option>
			</select>
		<br>
		<br>
		<label > Vous le pratiquer depuis ? </label>
			<select name="since">
				<option value="" disabled selected> Selectionner une période </option>
				<option value="1m"> > 1 mois </option>
				<option value="3m"> > 3 mois </option>
				<option value="6m"> > 6 mois </option>
				<option value="1a"> > 1 ans  </option>
			</select>
		<br>
		<br>
		<label for="like"> Votre intérêt pour ce sport </label>
			<select name="like" id="like">
				<option value="" disabled selected> Selectionner votre intérêt </option>
				<option value="*"> * </option>
				<option value="**"> ** </option>
				<option value="***"> *** </option>
				<option value="****"> **** </option>
			</select>
		<br>
	<!--	<br>
			<img id="captcha" src="private/include/captcha.php" alt="CAPTCHA">
		<br> 
			<input type="text" name="captcha" placeholder="Code captcha">
		<br>
			<span class="condition">En cliquant ci-dessous :</span> <br>
			<input type="checkbox" name="CGU" value="1" id="CGU">
		<br>
			<span class="condition"> <em> Vous acceptez nos Conditions Générales d'Utilisation (CGU). </em> </span> 
		<br> -->
			<input type="submit" value="Valider" class="accept">
	</form>
	<div id="pannelError">
	</div>
</div>
