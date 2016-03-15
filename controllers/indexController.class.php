<?php 

class indexController
{
	public function indexAction($args)
	{

		$articles = new articles();
		$articles->setTitle("Mon titre");
		$articles->setContent("Description de mon article");
		$articles->save();

		$v = new view();
		$v->setView("indexIndex");
		$v->assign("pseudo","mec");
	}

	public function testAction($args)
	{

	}
}