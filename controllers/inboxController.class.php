<?php
/**
 * Created by IntelliJ IDEA.
 * User: roland
 * Date: 19/06/16
 * Time: 20:21
 */

namespace Controllers;

use Core\View;

class inboxController
{
    /**
     * Main inbox action
     * @param $args
     */
    public function myInboxAction($args) {
        $view = new View();
        print_r("inbox Controller");
    }
}