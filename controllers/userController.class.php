<?php 

class userController
{

	public function indexAction()
	{
		$users = new users();
		$v = new view();

		$v->setView("user/userShow");
		$v->assign("users",$users->find("SELECT email,password FROM users"));
	}


	public function validationAction($request){
		$msg_error = "";
		$v = new view();
		$users = new users();
		$v->setView("user/userValidation");
		$data=[];
		//Est ce qu'il existe en bdd un user avec cet email et cet accesstoken
		if(isset($request['email']) && isset($request['access_token'])){
			$email = $request['email'];
			$access_token = $request['access_token'];
		//Si oui Activer le flag a 1
			if($users->find('SELECT * FROM users WHERE email = :email AND access_token = :access_token' ,[':email'=>$email,':access_token'=>$access_token])){ 
					$where = ['email' => $email];
					$data['is_active'] = 1;
			//Regenerer l'accesstoken et le stocker en session avec l'email
					$new_access_token = $users->regenerateToken($users->find("SELECT id_user,first_name,email FROM users WHERE email = :email AND access_token = :access_token",[':email'=>$email,':access_token'=>$access_token]));
					$_SESSION["access_token"] = $new_access_token;
					$_SESSION["email"] = $email;
					$v->assign("validate","Validation confirmed");
			}else{
				$msg_error .= "<li>Email ou Token incorrect";
			}
			$v->assign("errors",$msg_error);
		}
		//Rediriger sur l'edition du profil
		//header("Location: ".URLAPP."/user/edit");
	}

	public function showAction($id)
	{	
		if(!empty($id)){
			$users = new users();
			$v = new view();
			$v->setView("user/userShow");
			$v->assign("users",$users->find("SELECT email,password FROM users WHERE id_user = :id",[':id'=>$id]));
		}else{
			header('Location: /user/');
		}
	}

	public function deleteAction($id)
	{
		//TODO : vérifier isAdmin();
		if(!empty($id)){
			$users = new users();
			$v = new view();
			$v->setView("user/userDelete");
			$v->assign("users",$users->delete("users",['id_user'=>$id]));
		}else{
			header('Location: /user/');
		}
	}

	
	public function addAction()
	{
		$users = new users();
		$v = new view();
		$error = FALSE;
		$msg_error = "";
		$v->setView("user/userAdd");

		if(isset($_POST['submit'])){
			if(!empty($_POST['email']) && !empty($_POST['conf_email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['conf_password']) && !empty($_POST['city'])){
				$email = strtolower(trim($_POST['email']));
				$conf_email = strtolower(trim($_POST['conf_email']));
				$first_name = strtolower(trim($_POST['first_name']));
				$last_name = strtolower(trim($_POST['last_name']));
				$city = $_POST['city'];
				$password = $_POST['password'];
				$conf_password = $_POST['conf_password'];
				$access_token = $users->createToken($email); 
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
					$data = ['last_name'=>$last_name,'first_name'=>$first_name, 'city'=>$city,'email' => $email, 'password'=>$password,'access_token'=>$access_token,'is_active'=>0,'admin'=>0];
					$v->assign("users",$users->add("users",$data));
					$users->sendMail($email,$access_token);
					$v->assign("validate","Registration confirmed, go validate your account on your mail box");
				}else{
	                $v->assign("errors",$msg_error);
				}
			}
		}
	}

	public function editAction($id)
	{
		if(!empty($id)){
			$users = new users();
			$v = new view();
			$data = [];
			$where = ['id_user' => $id];
			if(isset($_POST['submit'])){
				if(!empty($_POST['last_name'])){
					$last_name = $_POST['last_name'];
					$data['last_name'] = $last_name;
				}
				if(!empty($_POST['first_name'])){
					$first_name = $_POST['first_name'];
					$data['first_name'] = $first_name;
				} 
				if(!empty($_POST['city'])){
					$city = $_POST['city'];
					$data['city'] = $city;
				} 
				if(!empty($_POST['birthday'])){
					$birthday = $_POST['birthday'];
					$data['birthday'] = $birthday;
				} 
				if(!empty($_POST['email'])){
					$email = $_POST['email'];
					$data['email'] = $email;
				} 
				if(!empty($_POST['password'])){
					$password = $_POST['password'];
					$data['password'] = $password;
				}
				if(!empty($_POST['favorite_sports'])){
					$favorite_sports = $_POST['favorite_sports'];
					$data['favorite_sports'] = $favorite_sports;
				} 
			}
			$v->setView("user/userEdit");
			$v->assign("idUser",$id);
			$v->assign("users",$users->update("users",$data,$where));
		}else{
			header('Location: /user/');
		}
	}
}
