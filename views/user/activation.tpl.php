<h3>
    Welcome back !
</h3>
<h4>
    <?php echo $this->data["msg"]; ?>
</h4>
<?php if(!isset($this->data["account_activated"])) { ?>
<form action="/user/activate" method="post">
    <h3>Choose a password</h3>
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="pwd_verif" placeholder="Coonfirm password">
    <input type="hidden" name="pwd_form" value="true">
    <input type="hidden" name="user_token" value="<?php echo $this->data['user_token'] ? $this->data['user_token']:''?>">
    <input type="submit" value="Ok">
</form>
<?php } else { ?>
<a href="/user/subscribe">Back home</a>
<?php } ?>
