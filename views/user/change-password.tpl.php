<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary">
      <div class="panel-heading">
        For which account do you want to reset the password ?
      </div>
      <div class="panel-body">
        <?php  
          $this->createForm($form, $formErrors);
        ?>
        <p>
          <?php echo isset($this->data["error_msg"])?$this->data["error_msg"]:"" ?>
        </p>
      </div>
    </div>
  </div>
</div>