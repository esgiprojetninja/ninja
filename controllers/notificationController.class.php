<?php

class notificationController
{

	public function createAction($args)
	{

		$notification = new Notification();

		$notification->setId_user($args['id_user']);
		$notification->setDatetime(date("Y-m-d H:i:s"));
		$notification->setType(1);
		$notification->setOpened(0);
		$notification->setMessage($args['message']);
		$notification->setAction($args['action']);

		$notification->save();

	}


	public function deleteAction($args)
	{
		$notification = Notification::findById($args[0]);
		if ($notification) {
			if ($notification->getId_user()==$_SESSION['user_id']){
				$notification->setOpened(1);
				$notification->save();
			}else{
				//Non, ce n'est pas ta notif
			}
		} else {
			//ici renvoyer un header 404 par exemple
		}
	}

	public function listAction($args)
	{
		header('Content-Type: application/json');
		$notifications = Notification::findBy(["id_user"],[$_SESSION['user_id']],['int','int'],false);
		echo json_encode($notifications);
	}

}
