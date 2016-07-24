<?php
    $event = $this->data["event"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <?php if(!$event->getId()):?>
            <div class="panel-body">
                <h3>Event not found</h3>
            </div>
            <?php else : ?>


            <div class="panel-heading"><h3 class="center header-li"> <?php echo $event->getName(); ?> event</h3></div>

            <div class="panel-body">
                <div class="col-sm-12">
                  <?php if(count($comments) == 0): ?>
                    <h2> There's no comments yet! </h2>
                  <?php elseif(count($comments) == 1):?>
                      <?php $user = User::findBy("id",$comments->getIdAuthor(),"int");?>
                      <h2><?= $user->getUsername(); ?></h2> said <?= $comments->getIdComment(); ?> at <?= $comments->getDateCreated();?>
                  <?php else: ?>
                    <?php
                    foreach($comments as $comment){
                        $user = User::findBy("id",$comment->getIdAuthor(),"int");
                      ?>
                      <h3> <a href="<?= WEBROOT ?>/user/show/<?= $user->getId(); ?>"><?= $user->getUsername(); ?></a>  said at <?= $comment->getDateCreated();?> : </>
                        <h2><?= $comment->getIdComment(); ?></h2>

                      <?php
                    }
                    ?>
                  <?php endif; ?>
                </div>
            </div>

            <?php $this->createForm($commentForm, $commentErrors); ?>

        </div>
      <?php endif; ?>
    </div>
</div>
