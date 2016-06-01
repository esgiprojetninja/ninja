
<?php /*<h4>
    <?php if(isset($this->data['msg'])){echo $this->data["msg"];} ?>
</h4>
<?php if(!isset($this->data["account_activated"]) && isset($formActivation) && isset($actErrors)) { 
    $this->createForm($formActivation, $actErrors);
} else { ?>
<a href="<?= WEBROOT; ?>user/subscribe">Back home</a>
<?php } */?>

<?php
    //$user = $this->data["user"];
	if(isset($this->data['msg'])){echo $this->data["msg"];}
?>
<div class="row">
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-body">
                <?php
                    $this->createForm($formActivation, $actErrors);
                ?>
            </div>
        </div>
    </div>
</div>