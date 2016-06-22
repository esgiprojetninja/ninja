

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-primary2">
            <div class="panel-heading">My Inbox</div>
            <div class="panel-body">
                <div class="my-inbox">
                    <!-- DISCUSSION LIST -->
                    <div class="discussion-list">
                        <div class="new-discussion">
                            <?php $this->createForm($form, $formErrors) ?>
                        </div>
                        <div class="js-discussion-list">
                            <ul></ul>
                        </div>
                    </div>
                    <!-- CHAT BODY -->
                    <div class="chat-body">
                        <div class="message-list js-message-list"></div>
                        <form class="js-inbox-message-form ajax-form" method="POST" action=<?= WEBROOT . "inbox/sendMessage" ?>>
                            <div class="input-grp-btn">
                                <input type="text" class="form-control" name="message" placeholder="Type a message">
                                <input type="hidden" name="discussion_id">
                                <button class="btn btn-primary2" type="submit">ok</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
