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

<form action="<?php echo $form["options"]["action"] ?>" method="<?php echo $form["options"]["method"]?>" <?php echo isset($form["options"]["enctype"]) ? "enctype=\"".$form["options"]["enctype"]."\"" : "" ?>>

	<h3><?= $form["title"]; ?></h3>

	<?php foreach ($form["struct"] as $name => $option ) :?>

		
			<div class="input-grp">
				<input name="<?php echo $name ?>" 
						type="<?php echo $option["type"] ;?>"
						class="<?php echo $option["class"] ;?>"
						placeholder="<?php echo $option["placeholder"] ;?>"
						<?php echo ($option["required"])?"required='required'":""?>
						value= "<?php if((isset($data[$name]) && $option["type"]!="password" && $option["type"]!="hidden")){echo $data[$name];}else if(isset($option["value"])){echo $option["value"];}?>" 
						<?php if(isset($option["id"])){echo "id=\"".$option["id"]."\"";}?>
						<?php if(isset($option["autocomplete"])){echo "autocomplete=\"".$option["autocomplete"]."\"";}?>> 

			</div>
		

	<?php endforeach;?>
	
	<div class="input-grp text-right">
        <input type="hidden" name="subscribe_form" value="true">
        <input type="submit" value="<?php echo $form["buttonTxt"] ?>" name="submit" class="btn btn-primary">
    </div>
</form>