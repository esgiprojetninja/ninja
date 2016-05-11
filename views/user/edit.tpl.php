<?php
    $user = $this->data["user"];
?>

<div id="wrap">
    <ul>
        <li> UserName = <?= $user->getUsername(); ?> </li>
        <li> Email = <?= $user->getEmail(); ?></li>
    </ul>
</div>