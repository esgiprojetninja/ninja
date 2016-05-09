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
<?php if( !empty($indice) ): ?>
	<?php switch($indice): 
			  case "sub": ?>		
			  	<h3> Want to join the nation ?</h3>
		<?php break; 
			  case "act": ?>
    			<h3>Already a sport citizen ?</h3>
    	<?php break; ?>
    	<?php endswitch; ?>
<?php endif; ?>

	<?php foreach ($form["struct"][$indice] as $name => $option ) :?>

		<?php if($option["type"] == "text"):?>
		
			<div class="input-grp">
				<input name="<?php echo $name ?>" 
						type="<?php echo $option["type"] ;?>"
						class="<?php echo $option["class"] ;?>"
						placeholder="<?php echo $option["placeholder"] ;?>"
						<?php echo ($option["required"])?"required='required'":""?>
						value= "<?php echo (isset($data[$name]) && $option["type"]!="password")?$data[$name]:""?>" > 
			</div>
		
		<?php endif;?>
		
	<?php endforeach;?>
	
	<div class="input-grp">
        <input type="hidden" name="subscribe_form" value="true">
        <input type="submit" value="Sign In" name="submit" class="btn btn-primary">
    </div>
</form>