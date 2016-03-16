<!-- formulaire d'inscription -->
<div id="wrap">
	<form method="POST">
			
			<input type="text" placeholder="Votre Prénom" name="first_name" value=""> <input type="text" placeholder="Nom de famille" name="last_name" value="">
		<br>
			<input type="email" placeholder="monputaindemail@jedi.ga" name="email" class="ilarge" value="">
		<br>
			<input type="email" placeholder=" monputaindemail@jedi.ga" name="confemail" class="ilarge" value="">
		<br>
			<input type="text" placeholder=" Paris" name="ville">
		<br>
			<select type="text" name="sports">
					<option value="" disabled selected>Votre sport favori</option>
			</select>
		<br>
			<input type="password" name="password" placeholder=" *************">
		<br>
		<br>
			<button type="submit" class="accept" formaction="index.php?subscribe_2"> S'INSCRIRE </button>
	</form>
	<div id="pannelError">
	</div>
</div>