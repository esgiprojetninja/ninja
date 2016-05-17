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

<form action="<?php echo $form["options"]["action"] ?>" method="<?php echo $form["options"]["method"]?>">

	<h3><?= $form["title"]; ?></h3>

	<?php foreach ($form["struct"] as $name => $option ) :?>

		<?php if($option["type"] == "text" or $option["type"] == "email" or $option["type"] == "password"):?>
			
			<div class="input-grp">
				<input name="<?php echo $name; ?>" 
						type="<?php echo $option["type"]; ?>"
						class="<?php echo $option["class"]; ?>"
						placeholder="<?php echo $option["placeholder"]; ?>"
						<?php echo ($option["required"])?"required='required'":""?>
						value= "<?php if((isset($data[$name]) && $option["type"]!="password" && $option["type"]!="hidden"))
										{
											echo $data[$name];
										}else if(isset($option["value"])){
											echo $option["value"];
										} ?>" > 
			</div>

		<?php elseif($option["type"] == "hidden"):?>

			<div class="input-grp">
        		<input type="<?php echo $option["type"]; ?>" name="<?php echo $name; ?>" value="<?php echo $option["value"]; ?>">
        	</div>

		<?php elseif($option["type"] == "submit"):?>

			<div class="input-grp">
        		<input type="<?php echo $option["type"]; ?>" value="<?php echo $option["value"]; ?>" name="<?php echo $name; ?>" class="<?php echo $option["class"]; ?>">
    		</div>

    	<?php endif; ?>
	
	<?php endforeach;?>
	
</form>