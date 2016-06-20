<?php

class inboxController
{
    /**
     * Main inbox action
     * @param $args
     */
    public function myInboxAction($args) {
        if (User::isConnected()) {
            $view = new View();
            $view->setView("inbox/inbox.tpl");
            print_r("inbox Controller");
        } else {
            header("location:" . WEBROOT);
        }
    }

    public function createDiscussion($people) {
        if (User::isConnected()) {
            $discussion = new discussion();
            foreach ($people as $key => $p) {
                if (is_numeric($p)) {
                    $discussion->addUser($p);
                }
            }
        }
    }
}
