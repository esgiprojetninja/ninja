<?php

class rateController {

    public function getRateAction($args) {
        $user_id = htmlspecialchars(intval($args[0]));
        header('Content-type: application/json');
        if(!empty($user_id) && User::isConnected()) {
            $rates = Rate::findBy("user_id", $user_id, "int");
            if (count($rates) > 0) {
                $up = 0;
                foreach ($rates as $rate) {
                    if ($rate->getRate() == 1) {
                        $up ++;
                    }
                }
                $response["rate"] = round(($up / count($rates)) * 100);
                echo json_encode($response);
            } else {
                $response["rate"] = 100;
                echo json_encode($response);
            }
        } else {
            $response["message"] = "Wrong user id";
            $response["status"] = "danger";
            echo json_encode($response);
        }
    }

    public function rateUserAction($args) {
        if (User::isConnected()) {
            header('Content-type: application/json');
            $user_id = htmlspecialchars(intVal($args[0]));
            $rateValue = htmlspecialchars(intVal($args[1]));

            $rates = Rate::findBy("user_id", $user_id, "int");
            foreach ($rates as $rate) {
                if ($rate->getVoterId() == intVal($_SESSION["user_id"])) {
                    $response["message"] = "You already have rated this user";
                    $response["status"] = "danger";
                    echo json_encode($response);
                    return;
                }
            }

            if (!empty($user_id)) {
                $rate = new Rate();
                $rate->setVoterId(intVal($_SESSION["user_id"]));
                $rate->setUserId($user_id);
                if ($rateValue == 0) {
                    $rate->setRate(0);
                    $rate->save();
                    $response["message"] = "Rate updated !";
                    $response["status"] = "success";
                    return json_encode($response);
                } else if ($rateValue == 1) {
                    $rate->setRate(1);
                    $rate->save();
                    $response["message"] = "Rate updated !";
                    $response["status"] = "success";
                    return json_encode($response);
                } else {
                    $response["message"] = "Undefined note";
                    $response["status"] = "danger";
                    return json_encode($response);
                }
            }
        } else {
            header("location" . WEBROOT);
        }
    }
}
