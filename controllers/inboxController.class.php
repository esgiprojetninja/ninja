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

    /**
     * Create a new discussion and store.
     * @param array $args
     * @echo json
     */
    public function createDiscussionAction($args) {
        $response = [];
        if (User::isConnected()) {
            $errors = [];
            if(isset($_POST["form-type"]) && $_POST["form-type"] == "createDiscussion") {
                $form = Discussion::getForm("createDiscussion");
                $validator = new Validator();
                $errors = $validator->check($form["struct"], $_POST);
                if (count($errors) == 0) {
                    $currentUser = User::findById(intval($_SESSION["user_id"]));
                    $userTarget = User::findBy("username", $_POST["username"], "string");
                    $discussions = $currentUser->getDiscussions();
                    $discussion_exists = false;
                    foreach ($discussions as $discussion) {
                        $user_ids = split(",", $discussion["people"]);
                        if(in_array($userTarget[0]->getId(), $user_ids)) {
                            $discussion_exists = true;
                            break;
                        }
                    }
                    if ($discussion_exists) {
                        http_response_code(400);
                        $response["status"] = "error";
                        $response["errorText"] = "A discussion with this
                        user already exists";
                    } else {
                        $discussion = new Discussion();
                        $discussion->save();
                        $discussion->addUser(intval($userTarget[0]->getId()));
                        $discussion->addUser(intval($_SESSION["user_id"]));
                        $discussion->savePeople();
                        $discussion->save();
                        http_response_code(200);
                        $response["status"] = "success";
                        $response["message"] = "Discussion created !";
                    }
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
            http_response_code(403);
            $response["status"] = "error";
            $response["errorText"] = "You must be connected.";
        }
        header('Content-type: application/json');
        echo json_encode($response);
    }

    /**
     * Return all discussion ids for current user.
     * @echo json
     */
    public function getDiscussionsAction() {
        $response = [];
        $response["current_user_id"] = $_SESSION["user_id"];
        if (User::isConnected()) {
            $user = User::findById($_SESSION["user_id"]);
            $response["message"] = $user->getDiscussions();
            for ($i = 0; $i < count($response["message"]); $i++) {
                foreach ((explode(",", $response["message"][$i]["people"])) as $user_id) {
                    if ($user_id != $_SESSION["user_id"] && !empty($user_id)) {
                        $penPal = User::findById($user_id);
                        $response["message"][$i]["pen_pal"] = $penPal->getUsername();
                    }
                }
            }
            $response["status"] = "success";
        } else {
            http_response_code(403);
            $response["status"] = "error";
            $response["errorText"] = "You must be connected.";
        }
        header('Content-type: application/json');
        echo json_encode($response);
    }

    /**
     * Get messages from given discussion id.
     * @echo array
     */
    public function getMessagesAction() {
        if (User::isConnected()) {
            $messages = Message::findBy(
                "discussion_id",
                intval($_POST["discussion_id"]),
                "int",
                false
            );
            $response = [];
            foreach ($messages as $message) {
                $response[] = [
                    "content" => $message->getContent(),
                    "sender_id" =>$message->getSenderId()
                ];
            }
        } else {
            http_response_code(403);
            $response["status"] = "error";
            $response["errorText"] = "You must be connected.";
        }
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function sendMessageAction() {
        if (User::isConnected()) {
            if (isset($_POST["discussion_id"])) {
                $message = new Message();
                $message->setSenderId($_SESSION["user_id"]);
                $message->setContent(htmlspecialchars($_POST["message"]));
                $message->setDate(new Datetime());
                $message->setDiscussionId(intval($_POST["discussion_id"]));
                $message->save();
                $response["messageContent"] = $message->getContent();
                $response["callback"] = $_POST["callback"];
                $response["current_user_id"] = $_SESSION["user_id"];
                $response["discussion_id"] = $message->getDiscussionId();
                $response["status"] = "success";
                $response["message"] = "Message sent !";
                header('Content-type: application/json');
                echo json_encode($response);
            }
        } else {
            header("location:" . WEBROOT . "user/subscribe");
        }
    }
}
