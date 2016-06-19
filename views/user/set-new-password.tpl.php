<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Pick a new password
      </div>
      <div class="panel-body">
        <?php  
          $this->createForm($form, $formErrors);
        ?>
        <p>
          <?php echo isset($this->data["success"])?$this->data["success"]:"" ?>
        </p>
      </div>
    </div>
  </div>
</div>