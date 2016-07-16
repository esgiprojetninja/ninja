<?php foreach($errors as $error):?>

	<?php echo "<li>".$errors_msg[$error] ."</li>"; ?>

<?php endforeach;?>

<?php
	if(isset($_POST))
		$data = $_POST;
	elseif(isset($_GET)){
		$data = $_GET;
	}
?>

<form
	action="<?php echo $form["options"]["action"] ?>"
	method="<?php echo $form["options"]["method"]?>"
	<?php echo isset($form["options"]["enctype"]) ? "enctype=\"".$form["options"]["enctype"]."\"" : "" ?>
	class="<?php echo isset($form['options']['class']) ? $form['options']['class']: '' ?>"
	<?php
		if (isset($form["options"]["data-attributes"])) {
			foreach ($form["options"]["data-attributes"] as $key => $value) {
				echo "data-" . $key . "='" . $value . "'";
			}
		}
	?>
>

	<h3><?= (!empty($form["title"]) && $form["title"] != "rating" )? $form["title"] : ""; ?></h3>

	<?php foreach ($form["struct"] as $name => $option ) :?>

			<?php if (!empty($option["placeholder"])): ?>
				<label for="<?= $name ?>"><?= $option["placeholder"].":"; ?> </label>
			<?php endif; ?>
			<div class="input-grp<?= ($form["title"] == "rating")? "-inl": ""; ?>">
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
		<?php if (isset($form["deletable"])): ?>
			<a href="<?= WEBROOT ?>event/delete/<?= $form['deletable']?>" class="btn btn-danger">Delete</a>
		<?php elseif(!empty($form["buttonTxt"])): ?>
        	<input type="submit" value="<?php echo $form["buttonTxt"] ?>" name="submit" class="btn btn-primary">
    	<?php endif; ?>
    </div>
</form>