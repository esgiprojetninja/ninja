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
		$notification->setMessage("COUCOU VOUS ÊTES INVITÉS À UN EVENT !");

		$notification->save();

	}

	public function deleteAction($args)
	{
		//echo "OK " . $args[0];
		$notification = Notification::findById($args[0]);
		if ($notification) {
			if ($notification->getId_user()==$_SESSION['user_id']){
				$notification->setOpened(1);
				$notification->save();
			}else{
				//Va te faire enculer c'est pas ta notif
			}
		} else {
			//ici renvoyer un header 404 par exemple
		}
	}
}