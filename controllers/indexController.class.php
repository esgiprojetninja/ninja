<?php

class indexController
{
	public function indexAction($args)
	{
		if (User::isConnected()) {
			$view = new View;
			$view->setView("indexIndex");

			$teams = Team::FindAll(10,"dateCreated",["teamName","id"]);
            $view->assign("teams", $teams);

            $users = User::findAll(10,"dateCreated",["username","id"]);
            $view->assign("users",$users);

			$events = Event::findAll(10,"id",["name","id"]);
			$view->assign("events",$events);

		} else {
			header("location:" . WEBROOT ."user/subscribe");
		}
	}
}
