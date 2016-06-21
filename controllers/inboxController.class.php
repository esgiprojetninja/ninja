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
            $formErrors = [];
            $form = Discussion::getForm("createDiscussion");
            $view->assign("form", $form);
            $view->assign("formErrors", $formErrors);
            if (isset($_POST["username"])) {
                $validator = new Validator();
                $formErrors = $validator->check($form["struct"], $_POST);

            }
        } else {
            header("location:" . WEBROOT);
        }
    }

    public function createDiscussionAction($args) {
        $response = [];
        if (User::isConnected()) {
            // $discussion = new discussion();
            // foreach ($people as $key => $p) {
            //     if (is_numeric($p)) {
            //         $discussion->addUser($p);
            //     }
            // }
            $errors = [];
            if(isset($_POST["form-type"]) && $_POST["form-type"] == "createDiscussion") {
                $form = Discussion::getForm("createDiscussion");
                $validator = new Validator();
                $errors = $validator->check($form["struct"], $_POST);
                if (count($errors) == 0) {
                    $userTarget = User::findBy("username", $_POST["username"], "string");
                    $discussion = new Discussion();
                    $discussion->save();
                    $discussion->addUser(intval($userTarget->getId()));
                    $discussion->addUser(intval($_SESSION["user_id"]));
                    http_response_code(200);
                    $response["status"] = "success";
                    $response["message"] = "Discussion created !";
                } else {
                    http_response_code(404);
                    global $errors_msg; // Il faut vraiment trouver mieux que ça.
                    $response["status"] = "error";
                    $errorTexts = [];
                    foreach ($errors as $errorCode) {
                        $errorTexts[] = $errors_msg[$errorCode];
                    }
                    $response["errorText"] = join(", ", $errorTexts);
                }
            }

        } else {
            $response["status"] = "error";
            $response["errorText"] = "You must be connected.";
        }

        header('Content-type: application/json');
        echo json_encode($response);
    }
}
