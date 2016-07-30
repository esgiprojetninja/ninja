<div class="row">
  <div class="col-sm-4 col-sm-offset-2 vertical-center">
    <div class="panel panel-primary">
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">
            <?php
              $this->createForm($formLogin, $logErrors);
            ?>
            <a href="<?php echo WEBROOT . 'user/resetPassword' ?>">Mot de passe oublié ?</a>
          </div>

        </div>
      </div>
      <div class="panel-footer">
        <?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>
      </div>
    </div>
  </div>
  <div class="col-sm-4 col-sm-offet-2 vertical-center">
    <div class="panel panel-primary">
      <div clas="panel-body">
        <div class="row">
          <div class="col-sm-12">
          <h1>Toujours pas inscris ?</h1>
          <h3>Si vous ne possédez toujours pas de compte, <a href="<?= WEBROOT; ?>user/subscribe">inscrivez vous ici</a>.</h3>
</div>
</div>
        </div>
    </div>

  </div>
</div>
