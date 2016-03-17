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
		$error = FALSE;
		$msg_error = "";
		if(isset($_POST['submit'])){
			if(!empty($_POST['email']) && !empty($_POST['conf_email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['conf_password']) && !empty($_POST['city'])){
				$email = strtolower(trim($_POST['email']));
				$conf_email = strtolower(trim($_POST['conf_email']));
				$first_name = strtolower(trim($_POST['first_name']));
				$last_name = strtolower(trim($_POST['last_name']));
				$city = $_POST['city'];
				$password = $_POST['password'];
				$conf_password = $_POST['conf_password'];                
                // Vérifications des informations
				if($first_name === $last_name){
					$error = TRUE;
					$msg_error .= "<li>Le prénom doit être différent du nom";
				}

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$error = TRUE;
					$msg_error .= "<li>Email invalide";
				}
				if($password != $conf_password){
					$error = TRUE;
					$msg_error .= "<li>Le mot de passe de confirmation ne correspond pas";
				}

				if ($users->emailExist($email) == TRUE){
					$error = TRUE;
					$msg_error .= "<li>Un compte existe déjà avec cette adresse email";
				}

				if ($error == FALSE){
	                    //    $users->setEmail=$_POST['email'];
					$data = ['last_name'=>$last_name,'first_name'=>$first_name, 'city'=>$city,'email' => $email, 'password'=>$password,'is_active'=>0,'admin'=>0];
					$v->assign("users",$users->add("users",$data));
					$users->sendMail($email);
				}else{
	                   echo $msg_error;
				}
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
