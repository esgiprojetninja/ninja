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

	public function deleteAction($id)
	{
		//TODO : vérifier isAdmin();
		if(isset($id)){
			$users = new users();
			$v = new view();
			$v->setView("userDelete");
			$v->assign("users",$users->delete("users",['idUser'=>$id]));
		}else{
			echo "Id pas défini";
		}
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

	public function editAction($id)
	{
		$users = new users();
		$v = new view();
		$data = [];
		$where = ['idUser' => $id];

		if(isset($_POST['submit'])){
			
			if(!empty($_POST['email'])){
				$email = $_POST['email'];
				$data['email'] = $email;
			} 
			if(!empty($_POST['phone_number'])){
				$phone_number = $_POST['phone_number'];
				$data['phone_number'] = $phone_number;
			} 
			if(!empty($_POST['favorite_sports'])){
				$favorite_sports = $_POST['favorite_sports'];
				$data['favorite_sports'] = $favorite_sports;
			} 
			if(!empty($_POST['last_name'])){
				$last_name = $_POST['last_name'];
				$data['last_name'] = $last_name;
			}
			if(!empty($_POST['first_name'])){
				$first_name = $_POST['first_name'];
				$data['first_name'] = $first_name;
			}
			if(!empty($_POST['password'])){
				$password = $_POST['password'];
				$data['password'] = $password;
			}
		}
		$v->setView("userEdit");
		$v->assign("idUser",$id);
		$v->assign("users",$users->update("users",$data,$where));
	}
}
