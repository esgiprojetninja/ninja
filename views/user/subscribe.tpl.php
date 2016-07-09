<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary logbox">
      <div class="panel-heading">
        Welcome to the SPORT NATION
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
          <?php
            $this->createForm($formSubscribe, $subErrors);
          ?>
          </div>
          <div class="col-sm-6">
          <?php
            $this->createForm($formLogin, $logErrors);
          ?>
          <a class="btn btn-default" href="#">forgot password ?</a>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <?php echo isset($this->data["mailerMessage"]) ? $this->data["mailerMessage"] : "" ?>
      </div>
    </div>
  </div>
</div>
