<?php

class eventController {

    public function listAction($args) {
        if (User::isConnected()) {
            $view = new View();
            $events = Event::findAll();

            $user = 2; //Ton id d'user à rechercher
            $eventsFromUser = Event::findBy("owner",$user,"int",false); //La requête
            $view->assign("eventsFromUser",$eventsFromUser);

            $city = "Fairfax"; //A l'image d'un petit $city = "Bordeaux" t'as vu.
            $eventsFromCity = Event::findBy("city",$city,"string",false);
            $view->assign("eventsFromCity",$eventsFromCity);

            $zipcode = 22181;
            $eventsFromZipcode = Event::findBy("zipcode",$zipcode,"int",false);
            $view->assign("eventsFromZipcode",$eventsFromZipcode);

            $sport = "amour"; //Renvoie les events dont le tag contient cette chaine
            $sport = "#".$sport; //Renverra uniquement les chaines commencant par le mot recherché
            $eventsFromSport = Event::findByLike("tags",$sport);
            $view->assign("eventsFromSport",$eventsFromSport);

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
                    $event->setFromDate($from_date);
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

    public function updateAction($args) {
        if ($event = Event::findById(intval($args[0]))) {
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
            $view->setView("event/update.tpl");
        } else {
            http_response_code(404);
            Echo "Event not found.";
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
}
