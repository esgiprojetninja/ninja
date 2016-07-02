<div class="row">
    <div class="col-sm-6">
        <?php foreach ($events as $key => $event): ?>
            <div class="panel panel-success">
                <div class="panel-heading"><?= $event["name"]; ?></div>
                <div class="panel-body">
                    <h3 class="underlined">Owner : <?= $event["owner_name"]; ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="tag-box">
                                <?php foreach ($event["tag_array"] as $key => $tag): ?>
                                    <a href="#"><?= $tag ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <?= $event["description"]; ?>
                        </div>
                    </div>
                    <ul class="item-list">
                        <li>From : <?= $event["from_date"]; ?></li>
                        <li>To : <?= $event["to_date"]; ?></li>
                        <li>Joignable until <?= $event["joignable_until"]; ?></li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success">Join</a>
                    <a class="btn btn-danger">Leave</a>
                    <?php if ($event["owner"] == $_SESSION["user_id"]): ?>
                        <a class="btn btn-primary">Manage</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
