<?php foreach($errors as $error):?>

	<?php echo "<li>".$errors_msg[$error];?>

<?php endforeach;?>

<?php
	if(isset($_POST))
		$data = $_POST;
	elseif(isset($_GET)){
		$data = $_GET;
	}
?>

<form action="<?php echo $form["options"]["action"]?>" method="<?php echo $form["options"]["method"]?>">

	<?php foreach ($form["struct"] as $name => $option) :?>

		<?php if($option["type"] == "text"):?>
			<div class="input-grp">
			<input name="<?php echo $name ?>" 
					type="<?php echo $option["type"] ;?>"
					id="<?php echo $option["id"] ;?>"
					placeholder="<?php echo $option["placeholder"] ;?>"
					<?php echo ($option["required"])?"required='required'":""?>
					value= "<?php echo (isset($data[$name]) && $option["type"]!="password")?$data[$name]:""?>"
					> </div>
		<?php endif;?>

		<br>

	<?php endforeach;?>


	<input type="submit" value="<?php echo $form["options"]["submit"]?>">

</form>