<?php

class indexController
{
	public function indexAction($args)
	{
		$view = new view;
        $view->setView("indexIndex");
	}
}
