<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-primary2">
            <div class="panel-heading">10 last subscribers</div>
            <div class="panel-body">
                <?php
                    foreach($users as $user){
                        echo $user['username'].'<br>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">10 last teams</div>
            <div class="panel-body">
                <?php
                    foreach($teams as $team){
                        echo $team['teamName'].'<br>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-warning">
            <div class="panel-heading">10 last events</div>
            <div class="panel-body">
                <h1>COMING SOON</h1>
            </div>
        </div>
    </div>
</div>