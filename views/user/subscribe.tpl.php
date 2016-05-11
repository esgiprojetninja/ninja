<!-- TODO use ajax to merge this with login.tpl -->

<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary logbox">
      <div class="panel-heading">
        Welcome to the SPORT NATION
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <form method="POST" action="<?= WEBROOT; ?>user/subscribe">
              <h3>Want to join the nation ?</h3>
              <div class="input-grp">
                <input type="email" placeholder="Email" name="email" class="form-control" value="">
              </div>
              <div class="input-grp">
                <input type="text" placeholder="Username" name="username" class="form-control" value="">
              </div>
              <div class="input-grp">
                <input type="hidden" name="subscribe_form" value="true">
                <input type="submit" value="Sign In" name="submit" class="btn btn-primary">
              </div>
            </form>
          </div>
          <div class="col-sm-6">
            <form action="<?= WEBROOT; ?>user/login" method="POST">
              <h3>Already a sport citizen ?</h3>
              <div class="input-grp">
                <input type="text" name="email" placeholder="Email" class="form-control">
              </div>
              <div class="input-grp">
                <input type="password" name="password" placeholder="Password" class="form-control">
              </div>
              <div class="input-grp">
                <input type="hidden" name="login_form" value="true">
                <input type="submit" value="Log In" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <ul>
            <?php
              if (isset($this->data["errors"])) {
                foreach ($this->data["errors"] as $value) {
                  echo "<li>".$value."</li>";
                }
              }
            ?>
        </ul>
        <?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>
      </div>
    </div>
  </div>
</div>