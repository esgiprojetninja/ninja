<?php 

class userController
{

	public function indexAction()
	{
		$users = new users();
		$v = new view();
		$v->setView("userShow");
		$v->assign("users",$users->find("SELECT email,password FROM users"));
	}


	public function validationAction($request){
		//Est ce qu'il existe en bdd un user avec cet email et cet accesstoken

		//Si oui Activer le flag a 1

		//Regenerer l'accesstoken et le stocker en session avec l'email
		$accesstoken = regenerateToken($request['email']);
		$_SESSION["accesstoken"] = $accesstoken;
		$_SESSION["email"] = $request['email'];

		//Rediriger sur l'edition du profil
		header("Location: ".URLAPP."/user/edit");
	}

	public function editAction($request){

			if( isset($request["action"]) && $request["action"]=="edit"){
				//update en SQL
			}
			
			$v = new view();
			$v->setView("userEdit");
			$v->assign("name","skrzypczyk");
			$v->assign("surname","yves");
	}


	public function showAction($id)
	{	
		if(isset($id)){
			$users = new users();
			$v = new view();
			$v->setView("userShow");
			$v->assign("users",$users->find("SELECT email,password FROM users WHERE idUser = :id",[':id'=>$id]));
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
		$users = new users();
		$v = new view();
		if(isset($_POST['submit'])){
			if(isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['favorite_sports']) && isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['password'])){
				$email = $_POST['email'];
				$phone_number = $_POST['phone_number'];
				$favorite_sports = $_POST['favorite_sports'];
				$last_name = $_POST['last_name'];
				$first_name = $_POST['first_name'];
				$password = $_POST['password'];

		//	$users->setEmail=$_POST['email'];
				$data = ['email' => $email,'phone_number'=>$phone_number,'favorite_sports'=>$favorite_sports,
				'last_name'=>$last_name,'first_name'=>$first_name,'password'=>$password];
				$v->assign("users",$users->add("users",$data));
			}
		}
		$v->setView("userAdd");
	}

	public function updateAction()
	{
		echo "User -> update";
	}
}