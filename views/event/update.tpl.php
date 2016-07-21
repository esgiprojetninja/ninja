<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Update Event</div>
            <div class="panel-body">
                <?php $this->createForm($form, $form_errors); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">People</div>
            <div class="panel-body">
                <ul class="item-list">
                    <?php foreach ($event->gatherUsers() as $key => $user): ?>
                        <?php if ($user["id"] != $event->getOwner()): ?>
                            <li class="item"><?= $user["username"]; ?> | <a class="btn btn-danger btn-xs" href="<?= WEBROOT ?>event/leave/<?= $event->getId() ?>/<?= $user["id"]?>">X</a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
