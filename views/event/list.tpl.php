<div class="row">
    <div class="col-sm-6">
        <?php foreach ($events as $key => $event) { ?>
            <div class="panel panel-success">
                <div class="panel-heading"><?= $event["name"]; ?></div>
                <div class="panel-body">
                    <h4>Owner : <?= $event["owner_name"]; ?></h4>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
