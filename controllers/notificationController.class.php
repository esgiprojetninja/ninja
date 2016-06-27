<?php

class notificationController
{

	public function createAction($args)
	{

		$notification = new Notification();

		$notification->setId_user($_SESSION['user_id']);
		$notification->setDatetime(date("Y-m-d H:i:s"));
		$notification->setType(1);
		$notification->setOpened(0);
		$notification->setMessage($args['msg']);
		//$notification->setMessage('Notification');

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
		$notifications = Notification::findBy(["id_user","opened"],[$_SESSION['user_id'],0],['int','int'],false);
		echo json_encode($notifications);
	}

}
