<?php 

class userController
{

	public function indexAction()
	{
		$user = new users();
		$v = new view();
		$v->setView("userShow");
		$v->assign("users",$user->get_users());
	}

		public function showAction($id)
	{	
		if(isset($id)){
			$user = new users();
			$v = new view();
			$v->setView("userShow");
			$v->assign("users",$user->get_user($id[0]));
		}else{
			echo "Id pas défini";
		}
	}

	public function deleteAction()
	{
		echo "User -> delete";
	}

	public function addAction()
	{
		echo "User -> add";	
	}

	public function updateAction()
	{
		echo "User -> update";
	}
}