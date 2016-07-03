<?php

class eventController {

    public function listAction($args) {
        if (User::isConnected()) {
            $view = new view();
            $events = Event::findAll();
            // if(count($events) > 0) {
            //     for ($i = 0; $i < count($events); $i++) {
            //         $owner = $this->getOwnerDetail(intval($events[$i]->getOwner()));
            //         $events[$i]["owner_name"] = $owner->getUserName();
            //         $events[$i]["tag_array"] = split(",", $events[$i]->getTags());
            //     }
            // }
            $view->assign("events", $events);
            $view->setView("event/list.tpl");
        } else {
            header("location:" . WEBROOT);
        }
    }

    /**
     * Return user object from owner id
     * @param  [int] $id
     * @return [User]
     */
    public function getOwnerDetail($id) {
        $owner = User::findById($id);
        return $owner;
    }

}
