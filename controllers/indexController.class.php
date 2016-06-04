<?php

class indexController
{
	public function indexAction($args)
	{
		if(User::isConnected()){
			$view = new view;
			$view->setView("indexIndex");

			$teams = Team::FindAll(10,"dateCreated");
            $view->assign("teams", $teams);

            $users = User::findAll(10,"dateCreated");
            $view->assign("users",$users);
		}else{
			header('Location:' . WEBROOT . 'user/login');
		}
	}
}
