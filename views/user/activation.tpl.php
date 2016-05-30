<h4>
    <?php if(isset($this->data['msg'])){echo $this->data["msg"];} ?>
</h4>
<?php if(!isset($this->data["account_activated"]) && isset($formActivation) && isset($actErrors)) { 
    $this->createForm($formActivation, $actErrors);
} else { ?>
<a href="<?= WEBROOT; ?>user/subscribe">Back home</a>
<?php } ?>