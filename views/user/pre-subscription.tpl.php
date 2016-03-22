<!-- formulaire d'inscription -->
<div id="wrap">
  <form method="POST" action="/user/preSub">
    <input type="email" placeholder="Email" name="email" class="ilarge" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
    <input type="text" placeholder="username" name="username" class="ilarge" value="<?php echo isset($_POST['username']) ? $_POST['username']:''; ?>">
    <input type="hidden" name="preSubForm" value="true">
    <input type="submit" value="S'inscrire" name="submit" class="accept">
  </form>
  <div id="pannelError">
    <ul>
        <?php
          foreach ($this->data["errors"] as $value) {
            echo "<li>".$value."</li>";
          }
        ?>
    </ul>
    <h3>
      <?php
        echo $this->data["mailerMessage"] ? $this->data["mailerMessage"]:"";
       ?>
    </h3>
  </div>
</div>
