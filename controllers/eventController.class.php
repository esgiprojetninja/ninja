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
                    $unformatedDate = date_parse_from_format("d/mY", $_POST["from_date"]);
                    $from_date = new Datetime(
                        $unformatedDate["year"] . "-" .
                        $unformatedDate["month"] . "-" .
                        $unformatedDate["day"] . " " .
                        $_POST["from_time"]
                    );
                    $event->setFromDate($from_date->format("Y-m-d H:i"));
                    $unformatedDate = date_parse_from_format("d/m/Y", $_POST["to_date"]);
                    $to_date = new Datetime(
                        $unformatedDate["year"] . "-" .
                        $unformatedDate["month"] . "-" .
                        $unformatedDate["day"] . " " .
                        $_POST["to_time"]
                    );
                    $event->setToDate($to_date->format("Y-m-d H:i"));
                    $unformatedDate = date_parse_from_format("d/m/Y", $_POST["joignable_until"]);
                    $joignable_until = new Datetime(
                        $unformatedDate["year"] . "-" .
                        $unformatedDate["month"] . "-" .
                        $unformatedDate["day"] . " " .
                        $_POST["joignable_until_time"]
                    );
                    $event->setJoignableUntil($joignable_until->format("Y-m-d H:i"));
                    $event->setLocation(htmlspecialchars($_POST["location"]));
                    $event->setDescription(htmlspecialchars($_POST["description"]));
                    $event->setTags(htmlspecialchars($_POST["tags"]));
                    $event->setNbPeopleMax($_POST["nb_people_max"]);
                    $event->save();
                    $event->addUser($currentUser->getId());
                    header("location:" . WEBROOT . "event/list");
                }
            }
            $view->assign("form", $form);
            $view->assign("form_errors", $formErrors);
            $view->setView("event/create.tpl");
        } else {
            header("location:" . WEBROOT);
        }
    }

    public function updateAction($args) {
        if (User::isConnected()) {
            if ($event = Event::findById(intval($args[0]))) {
                if ($event->getOwner() == $_SESSION["user_id"]) {
                    $view = new View();
                    $form = $event->getForm("updateEvent");
                    $formErrors = [];
                    if (!empty($_POST)) {
                        $validator = new Validator();
                        $formErrors = $validator->check($form["struct"], $_POST);
                        if (count($formErrors) == 0) {
                            $currentUser = User::findById($_SESSION["user_id"]);
                            $event->setOwner($currentUser->getId());
                            $event->setOwnerName($currentUser->getUsername());
                            $event->setName(htmlspecialchars($_POST["name"]));
                            $unformatedDate = date_parse_from_format("d/m/Y", $_POST["from_date"]);
                            $from_date = new Datetime(
                            $unformatedDate["year"] . "-" .
                            $unformatedDate["month"] . "-" .
                            $unformatedDate["day"] . " " .
                            $_POST["from_time"]
                            );
                            $event->setFromDate($from_date->format("Y-m-d H:i"));
                            $unformatedDate = date_parse_from_format("d/m/Y", $_POST["to_date"]);
                            $to_date = new Datetime(
                            $unformatedDate["year"] . "-" .
                            $unformatedDate["month"] . "-" .
                            $unformatedDate["day"] . " " .
                            $_POST["to_time"]
                            );
                            $event->setToDate($to_date->format("Y-m-d H:i"));
                            $unformatedDate = date_parse_from_format("d/m/Y", $_POST["joignable_until"]);
                            $joignable_until = new Datetime(
                            $unformatedDate["year"] . "-" .
                            $unformatedDate["month"] . "-" .
                            $unformatedDate["day"] . " " .
                            $_POST["joignable_until_time"]
                            );
                            $event->setJoignableUntil($joignable_until->format("Y-m-d H:i"));
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
                    $view->assign("event", $event);
                    $view->setView("event/update.tpl");
                } else {
                    http_response_code(404);
                    Echo "Event not found.";
                }
            } else {
                throw new Exception("You must be owner of the event.", 403);
            }
        } else {
            header("location:" . WEBROOT);
        }
    }

    public function deleteAction($args) {
        if ($event = Event::findById(intval($args[0]))) {
            $event->delete();
            header("location:" . WEBROOT . "event/list");
        } else {
            http_response_code(404);
            Echo "Event not found.";
        }
    }

    public function joinAction($args) {
        if (isset($args[0])) {
            $event = Event::findById(intval($args[0]));
            $event->addUser(intval($_SESSION["user_id"]));
            header("location:" . WEBROOT . "event/list");
        } else {
            http_response_code(404);
            echo "Event not found";
        }
    }

    public function leaveAction($args) {
        if (isset($args[0]) && isset($args[1])) {
            $event = Event::findById(intval($args[0]));
            $event->removeUser(intval($args[1]));
            if ($event->getOwner() == $_SESSION["user_id"]) {
                header("location:" . WEBROOT . "event/update/" . $event->getId());
            } else {
                header("location:" . WEBROOT . "event/list");
            }
        } else {
            http_response_code(404);
            echo "User or event not found";
        }
    }
}
