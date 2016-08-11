
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= $event->getName(); ?></div>
            <div class="panel-body">
                <ul class="item-list">
                    <li>
                        <h3><?= $event->getDescription(); ?></h3>
                    </li>
                    <li>From : <?= $event->getFromDate(); ?></li>
                    <li>To : <?= $event->getToDate(); ?></li>
                    <li>Joignable until <?= $event->getJoignableUntil(); ?></li>
                </ul>
                <div class="">
                    <h3>People :</h3>
                    <ul>
                        <?php foreach ($users as $user): ?>
                            <?= $user["username"]; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="text-right">
                    <a href="<?= WEBROOT ?>event/list" class="btn btn-primary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
