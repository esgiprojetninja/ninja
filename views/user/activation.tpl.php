<div class="row vertical-center">
  <div class="col-sm-12">
    <div class="col-sm-4 col-sm-offset-2">
      <div class="panel panel-primary">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <?php
                  $this->createForm($formActivation, $activateErrors);
              ?>
              </div>
          </div>
        </div>
        <div class="panel-footer">
          <?php if(isset($this->data['activate_msg'])){echo $this->data["activate_msg"];} ?>
        </div>
      </div>
    </div>
    <div class="col-sm-3 ">
      <div class="panel panel-primary">
        <div clas="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <h1>Comment ça se passe ?</h1>
              <h3>Votre mot de passe doit faire en 8 et 12 caractères, au moins une minuscule et majuscule et un chiffre.</a>.</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
