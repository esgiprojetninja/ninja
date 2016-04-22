<?php
    $user = $this->data["user"];
?>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-media">
                <img src="/public/img/monkey.jpg">
            </div>
            <div class="panel-heading"><h3><?php echo $user->getUsername(); ?></h3></div>
            <div class="panel-body">
                <ul>
                    <li>
                        <span class="fa fa-at"></span>
                        <?php echo $user->getEmail(); ?>
                    </li>
                    <li>
                        <span class="fa fa-user"></span>
                        <?php echo $user->getFirstName(); ?>
                        <?php echo $user->getLastName(); ?>
                    </li>
                    <li>
                        <span class="fa fa-phone"></span>
                        <?php echo $user->getPhoneNumber(); ?>
                    </li>
                </ul>
                <div class="text-right">
                    <button class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>