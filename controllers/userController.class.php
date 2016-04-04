<?php

class userController
{

	public function showAction($id)
	{
		if(!empty($id)){
			$users = new users();
			$v = new view();
			$v->setView("user/userShow");
			$v->assign("users",$users->find("SELECT email,password FROM users WHERE id_user = :id",[':id'=>$id]));
		}else{
			header('Location: /user');
		}
	}

	/**
	*
	*/
	public function preSubAction($args) {
		$view = new view();

		$errors = [];
		$validForm = TRUE;
		$formData = [];

		// Basic security
		if(isset($_POST["preSubForm"])) {
			// verif mail
			if(!isset($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
				$validForm = FALSE;
				$errors[] = "Please enter a valid email";
			} else {
				$useremail = strtolower(trim($_POST["email"]));
			}
			// verif username
			if(!isset($_POST["username"]) || strlen($_POST["username"]) < 3) {
				$validForm =  FALSE;
				$errors[] = "Username must be at least 4 char long.";
			} else {
				$username = strtolower(trim($_POST["usename"]));
			}
		} else {
			$validForm = FALSE;
		}

		if(!$validForm) {
			$view->assign("errors", $errors);
		} else {
			$user = new User();
			$user->setEmail($useremail);
			$user->setUsername($username);
			$user->save();
			if($user->sendConfirmationEmail()) {
				$view->assign( "mailerMessage", "An email has just been sent to ".$user->getEmail() );
			} else {
				$view->assign( "mailerMessage", "Something went when trying to send email." );
			}
		}
		$view->setView("user/pre-subscription.tpl");
	}

	public function activateAction($args) {
		$view = new view;
		$user = new User();
		$user->findById(2);
		print_r($user);
		if($user["is_active" == 1]) {
			$user->update();
		}
		$view->assign("user", $user);
		$view->setView("user/activation.tpl");
	}


	public function addAction()
	{
		$users = new users();
		$v = new view();
		$error = FALSE;
		$msg_error = "";
		$v->setView("user/add.tpl");

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
			$v->setView("user/profil-edit.tpl");
			$v->assign("idUser",$id);
			$v->assign("users",$users->update("users",$data,$where));
		}
	}
}
