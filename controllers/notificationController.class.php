<?php

class notificationController
{

	public function createAction($args)
	{

		$notification = new Notification();

		$notification->setId_user(26);
		$notification->setDatetime(date("Y-m-d H:i:s"));
		$notification->setType(1);
		$notification->setOpened(0);
		$notification->setMessage("Bondour vous avez une notification !");

		$notification->save();

	}

	public function deleteAction($args)
	{
		if (User::isConnected() && !empty($args[0])) {
			$user = User::findById($args[0]);
			if ($user->getId() != $args[0]) {
				header("location:" . WEBROOT);
			}
			$v = new view();
			$teams = TeamHasUser::findBy("idUser", $args[0], "int", false);
			$v->setView("user/show.tpl");
			$v->assign("user", $user);
			$v->assign("teams", $teams);
		} else {
			header('Location:' . WEBROOT . 'user/login');
		}
	}
}