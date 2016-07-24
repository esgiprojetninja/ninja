<?php
    $event = $this->data["event"];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary2">
            <?php if(!$event->getId()):?>
            <div class="panel-body">
                <h3>Event not found</h3>
            </div>
            <?php else : ?>
            <div class="panel-heading"><h3 class="center header-li"> <?php echo $event->getName(); ?> event comments</h3></div>
        </div>
        
                  <?php if(count($comments) == 0): ?>
                    <h2> There's no comments yet! </h2>
                  <?php elseif(count($comments) == 1):?>
                      <?php $user = User::findBy("id",$comments->getIdAuthor(),"int");?>
                      <div class="panel panel-success">
                          <div class="panel-heading">
                              <a href="<?= WEBROOT ?>/user/show/<?= $user->getId(); ?>"><?= $user->getUsername(); ?></a>  said at <?= $comments->getDateCreated();?> :
                          </div>
                          <div class="panel-body">
                              <p><?= $comments->getIdComment(); ?></p>
                          </div>
                      </div>
                  <?php else: ?>
                      
                    <?php
                    foreach($comments as $comment){
                        $user = User::findBy("id",$comment->getIdAuthor(),"int");
                    ?>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <a href="<?= WEBROOT ?>/user/show/<?= $user->getId(); ?>"><?= $user->getUsername(); ?></a>  said at <?= $comment->getDateCreated();?> :
                            </div>
                            <div class="panel-body">
                                <p><?= $comment->getIdComment(); ?></p>
                            </div>
                        </div>



                    <?php
                    }
                    ?>
                  <?php endif; ?>

            <?php $this->createForm($commentForm, $commentErrors); ?>
      <?php endif; ?>
    </div>
</div>
