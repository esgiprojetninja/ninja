
<div class="row">
  <div class="col-sm-4 col-sm-offset-2">
    <div class="panel panel-primary">
      <div class="panel-body">
        <div class="row">

          <div class="col-sm-12">
            <?php
              $this->createForm($formSubscribe, $subErrors);
            ?>
            <a href="<?php echo WEBROOT . 'user/resetPassword' ?>">forgot password ?</a>
          </div>

        </div>
      </div>
      <div class="panel-footer">
        <?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>
      </div>
    </div>
  </div>
  <div class="col-sm-4 col-sm-offet-2 ">
    <div class="panel panel-primary">
          <h1>Déjà inscris ?</h1>
          <h3>Si vous possédez déjà un compte, <a href="<?= WEBROOT; ?>user/login">connectez vous ici</a>.</h3>
    </div>

  </div>
</div>
