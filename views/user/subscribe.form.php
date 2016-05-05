

<?php
	if(isset($_POST))
		$data = $_POST;
	elseif(isset($_GET)){
		$data = $_GET;
	}
?>

<form action="<?php echo $form["options"]["action"]?>" method="<?php echo $form["options"]["method"]?>">

	<?php foreach ($form["struct"] as $name => $option) :?>

		<?php if($option["type"] == "text" || $option["type"]=="email"):?>
			<input name="<?php echo $name ?>" type="<?php echo $option["type"] ;?>" id="<?php echo $option["class"] ;?>" placeholder="<?php echo $option["placeholder"] ;?>" <?php echo ($option["required"])?"required='required'":""?> value= "<?php echo (isset($data[$name]))?$data[$name]:""?>" >
		<?php endif;?>

		<br>

	<?php endforeach;?>

<div class="input-grp">              
 	<input type="hidden" name="subscribe_form" value="true">           
	<input type="submit" value="<?php echo $form["options"]["submit"]?>" name="submit"class="btn btn-primary"> 
</div>

</form>
<?php foreach($errors as $error):?>

	<?php echo "<li>".$errors_msg[$error];?>

<?php endforeach;?>