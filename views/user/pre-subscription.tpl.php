<!-- formulaire d'inscription -->
<div id="wrap">
  <form method="POST" action="/user/preSub">
    <input type="email" placeholder="Email" name="email" class="ilarge" value="">
    <input type="text" placeholder="Username" name="username" class="ilarge" value="">
    <input type="hidden" name="preSubForm" value="true">
    <input type="submit" value="S'inscrire" name="submit" class="accept">
  </form>
  <div id="pannelError">
    <ul>
        <?php
          if (isset($this->data["errors"])) {
            foreach ($this->data["errors"] as $value) {
              echo "<li>".$value."</li>";
            }
          }
        ?>
    </ul>
    <h3>
      <?php
        echo isset($this->data["mailerMessage"]) ? $this->data["mailerMessage"]:"";
       ?>
    </h3>
  </div>
</div>
