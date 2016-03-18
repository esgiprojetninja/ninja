<?php

class indexController
{
	public function indexAction($args)
	{
		$v = new view();
		$v->setView("indexIndex");
		$v->assign("pseudo","mec");
	}

	public function testAction($args)
	{

	}
}
