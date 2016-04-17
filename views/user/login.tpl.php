<h3>Please log in</h3>
<form action="/user/logIn" method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="hidden" name="login_form" value="true">
    <input type="submit" value="ok">
</form>
<?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>