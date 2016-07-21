<?php

class indexController
{
	public function indexAction($args)
	{
		if (User::isConnected()) {
			$view = new View;
			$view->setView("indexIndex");

			$teams = Team::FindAll(10,"dateCreated","teamName");
            $view->assign("teams", $teams);

			//$notifications = Notification::findBy(["id_user","opened"],[$_SESSION['user_id'],0],['int','int'],false);
            //$view->assign("notifications", $notifications);

            $users = User::findAll(10,"dateCreated","username");
            $view->assign("users",$users);

            $invitations = Invitation::findBy(["idUserInvited","state"],[$_SESSION['user_id'],0],['int','int'],false);
            $view->assign("invitations",$invitations);

			$idUser = [];			

			$usersNoted = User::findAll();
			foreach($usersNoted as $key => $user){
				$idUser = $user->getId();
			}

			var_dump($idUser);

			$view->assign("idUser", $idUser);

            $rating = new Rating();
			
			$formRating = $rating->getForm("rating");
			$view->assign("formRating", $formRating);

            $ratingErrors = [];
			$view->assign("ratingErrors", $ratingErrors);
            

            if($rating->rating()){
            	echo "ENJOY !";
            }

		} else {
	   		header("location: ".WEBROOT."user/subscribe");
		}
	}
}
