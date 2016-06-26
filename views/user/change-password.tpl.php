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
          <?php echo isset($this->data["mail_new_pwd"])?$this->data["mail_new_pwd"]:"" ?>
        </p>
      </div>
    </div>
  </div>
</div>