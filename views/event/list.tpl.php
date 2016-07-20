<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Manage events</div>
            <div class="panel-body">
                <a class="btn btn-success" href="<?= WEBROOT ?>event/create">Create Event</a>
            </div>
        </div>

        <?php echo "User :"; var_dump($eventsFromUser) ; echo '<br>'; ?>

        <?php echo "City :"; var_dump($eventsFromCity) ; echo '<br>'; ?>

        <?php echo "Zipcode :"; var_dump($eventsFromZipcode) ; echo '<br>'; ?>

        <?php echo "Sport :"; var_dump($eventsFromSport) ; echo '<br>'; ?>

        <?php foreach ($events as $key => $event): ?>
            <div class="panel panel-success">
                <div class="panel-heading"><?= $event->getName(); ?></div>
                <div class="panel-body">
                    <p class="underlined">Owner : <?= $event->getOwnerName(); ?></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="tag-box">
                                <?php foreach (explode(",", $event->getTags()) as $key => $tag): ?>
                                    <a href="#"><?= $tag ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <?= $event->getDescription(); ?>
                        </div>
                    </div>
                    <ul class="item-list">
                        <li>From : <?= $event->getFromDate(); ?></li>
                        <li>To : <?= $event->getToDate(); ?></li>
                        <li>Joignable until <?= $event->getJoignableUntil(); ?></li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success">Join</a>
                    <a class="btn btn-danger">Leave</a>
                    <?php if ($event->getOwner() == $_SESSION["user_id"]): ?>
                        <a href="<?= WEBROOT ?>event/update/<?= $event->getId() ?>" class="btn btn-primary">Manage</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
