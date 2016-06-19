<?php
/**
 * Created by IntelliJ IDEA.
 * User: roland
 * Date: 19/06/16
 * Time: 20:21
 */

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
}