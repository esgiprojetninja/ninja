<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Pick a new password
      </div>
      <div class="panel-body">
        <p>It has to contains between 8 and 12 characters, be alpha-numeric and contains upper and lowercase</p>
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