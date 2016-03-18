<?php
  if(isset($errors)){
    echo $errors;
  }else if(isset($validate)){
    echo $validate;
  }
?>
<!-- formulaire d'inscription -->
<div id="wrap">
  <form method="POST" action="add">
      <input type="text" placeholder="First name" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>">
      <input type="text" placeholder="Last name" name="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>">
    <br>
      <input type="email" placeholder="Email" name="email" class="ilarge" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
    <br>
      <input type="email" placeholder="Validate email" name="conf_email" class="ilarge" value="">
    <br>
      <input type="text" placeholder="City" name="city" value="<?php if(isset($_POST['city'])){echo $_POST['city'];} ?>">
    <br>
      <select type="text" name="sports">
          <option value="" disabled selected>Your favorite sport</option>
      </select>
    <br>
      <input type="password" name="password" placeholder="Password">
    <br>
      <input type="password" name="conf_password" placeholder="Validate password">
    <br>
    <input type="submit" value="S'inscrire" name="submit" class="accept">
  </form>
  <div id="pannelError">
  </div>
</div>
