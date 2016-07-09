<?php

class eventController {

    public function listAction($args) {
        if (User::isConnected()) {
            $view = new View();
            $events = Event::findAll();
            $view->assign("events", $events);
            $view->setView("event/list.tpl");
        } else {
            header("location:" . WEBROOT);
        }
    }

    public function createAction($arg) {
        if (User::isConnected()) {
            $form = Event::getForm("createEvent");
            $view = new View();
            $formErrors = [];
            if (!empty($_POST)) {
                $validator = new Validator();
                $formErrors = $validator->check($form["struct"], $_POST);
                if (count($formErrors) == 0) {
                    $event = new Event();
                    $currentUser = User::findById($_SESSION["user_id"]);
                    $event->setOwner($currentUser->getId());
                    $event->setOwnerName($currentUser->getUsername());
                    $event->setName(htmlspecialchars($_POST["name"]));
                    $event->setFromDate($_POST["from_date"] . " " . $_POST["from_time"]);
                    $event->setToDate($_POST["to_date"] . " " . $_POST["to_time"]);
                    $event->setJoignableUntil($_POST["joignable_until"] . " " . $_POST["joignable_until_time"]);
                    $event->setLocation(htmlspecialchars($_POST["location"]));
                    $event->setDescription(htmlspecialchars($_POST["description"]));
                    $event->setTags(htmlspecialchars($_POST["tags"]));
                    $event->setNbPeopleMax($_POST["nb_people_max"]);
                    $event->save();
                    $event->addUser($currentUser->getId());
                }
            }
            $view->assign("form", $form);
            $view->assign("form_errors", $formErrors);
            $view->setView("event/create.tpl");
        } else {
            header("location:" . WEBROOT);
        }
    }
}
