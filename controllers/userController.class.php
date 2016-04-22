<?php

class userController
{

	public function showAction($id)
	{
		if(!empty($id)){
			$users = new users();
			$v = new view();
			$v->setView("user/show.tpl");
			$v->assign("users",$users->find("SELECT email,password FROM users WHERE id_user = :id",[':id'=>$id]));
		}else{
			header('Location: /user');
		}
	}

	/**
	*
	*/
	public function subscribeAction($args) {
		$view = new view();

		$errors = [];
		$validForm = TRUE;
		$formData = [];

		// Basic security
		if(isset($_POST["subscribe_form"])) {
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
				$username = strtolower(trim($_POST["username"]));
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
			$user->setIsActive(0);
			$user->setToken();
			$user->save();
			if($user->sendConfirmationEmail()) {
				$view->assign( "mailerMessage", "An email has just been sent to ".$user->getEmail() );
			} else {
				$view->assign( "mailerMessage", "Something went when trying to send email." );
			}
		}
		$view->setView("user/subscribe.tpl");
	}

	public function activateAction($args) {
		$view = new view;
		$user = new User();
		$view->setView("user/activation.tpl");
		$view->assign("user_token", $args["token"]);
		if (isset($args["token"]) && !$user->findBy("token", $args["token"], "string")) {
			$view->assign("msg", "Not the page you're looking for");
		} 
		else if(isset($args["token"]) && $user->getToken() == $args["token"]) {
			var_dump("TA MERE");
			if ($user->getIsActive() != 1) {
				$view->assign("msg", "Please choose a password so we can activate your account.");
				$view->assign("user_token", $args["token"]);
			} 
			else {
				$view->assign("msg", "Looks like your account had already been activated");
			}
		}
		else if (isset($_POST["pwd_form"])) {
			if ($_POST["password"] === $_POST["pwd_verif"] && strlen($_POST["password"]) > 4) {
				if (isset($_POST["user_token"]) && $user->findBy("token", $_POST["user_token"], "string")) {
					$user->setPassword($_POST["password"]);
					$user->setIsActive(1);
					$user->save();
					$view->assign("account_activated", "yeeha");
					$view->assign("msg", "Your account is now activated");
				} 
				else {
					var_dump($_POST["user_token"]);
					$view->assign("msg", "Wrong token");
				}
			}
			else {
				$view->assign("user_token", $_POST["user_token"]);
				$view->assign("msg", "Password and confirm must be the same ans at least 4 char long");
			}
		}
	}

	public function loginAction () {
		$view = new view();
		$view->setView("user/login.tpl");
		if(isset($_POST["login_form"])) {
			if($user = User::findBy("email", $_POST["email"], "string")) {
				if($user->getEmail() == trim($_POST["email"]) && $user->getPassword() == trim($_POST["password"])) {
					$user->setToken();
					print_r($user->getToken());
					$user->save();
					$token = $user->getToken();
					$id = $user->getId();
					$_SESSION["user_id"] = $id;
					$_SESSION["user_token"] = $token;
					header("location: /");
				}
				else {
					$view->assign("error_message", "Couldn't find you :(");	
				}
			}
			else {
				$view->assign("error_message", "Couldn't find you :(");
			}
		}
	}

	/**
	* Logs out current user
	* @return void
	*/
	public function logoutAction () {
		session_destroy();
		header("location: /user/subscribe");
	}


	public function totoAction () {
		if (!User::isConnected()) {
			header("location: /"); // If the user is not connected we redirect him to /
		}
		$view = new view();
		$view->setView("/user/toto.tpl");
		$view->assign("msg", "This is an example");
	}


// This exist only for example -- TODO : REMOVE THIS


// 	public function addAction()
// 	{
// 		$users = new users();
// 		$v = new view();
// 		$error = FALSE;
// 		$msg_error = "";
// 		$v->setView("user/add.tpl");

// 		if(isset($_POST['submit'])){
// 			if(!empty($_POST['email']) && !empty($_POST['conf_email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['conf_password']) && !empty($_POST['city'])){
// 				$email = strtolower(trim($_POST['email']));
// 				$conf_email = strtolower(trim($_POST['conf_email']));
// 				$first_name = strtolower(trim($_POST['first_name']));
// 				$last_name = strtolower(trim($_POST['last_name']));
// 				$city = $_POST['city'];
// 				$password = $_POST['password'];
// 				$conf_password = $_POST['conf_password'];
// 				$access_token = $users->createToken($email);
//                 // Vérifications des informations
// 				if($first_name === $last_name){
// 					$error = TRUE;
// 					$msg_error .= "<li>Le prénom doit être différent du nom";
// 				}

// 				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
// 					$error = TRUE;
// 					$msg_error .= "<li>Email invalide";
// 				}
// 				if($password != $conf_password){
// 					$error = TRUE;
// 					$msg_error .= "<li>Le mot de passe de confirmation ne correspond pas";
// 				}

// 				if ($users->emailExist($email) == TRUE){
// 					$error = TRUE;
// 					$msg_error .= "<li>Un compte existe déjà avec cette adresse email";
// 				}

// 				if ($error == FALSE){
// 	                    //    $users->setEmail=$_POST['email'];
// 					$data = ['last_name'=>$last_name,'first_name'=>$first_name, 'city'=>$city,'email' => $email, 'password'=>$password,'access_token'=>$access_token,'is_active'=>0,'admin'=>0];
// 					$v->assign("users",$users->add("users",$data));
// 					$users->sendMail($email,$access_token);
// 					$v->assign("validate","Registration confirmed, go validate your account on your mail box");
// 				}else{
// 	                $v->assign("errors",$msg_error);
// 				}
// 			}
// 		}
// 	}

// 	public function editAction($id)
// 	{
// 		if(!empty($id)){
// 			$users = new users();
// 			$v = new view();
// 			$data = [];
// 			$where = ['id_user' => $id];
// 			if(isset($_POST['submit'])){
// 				if(!empty($_POST['last_name'])){
// 					$last_name = $_POST['last_name'];
// 					$data['last_name'] = $last_name;
// 				}
// 				if(!empty($_POST['first_name'])){
// 					$first_name = $_POST['first_name'];
// 					$data['first_name'] = $first_name;
// 				}
// 				if(!empty($_POST['city'])){
// 					$city = $_POST['city'];
// 					$data['city'] = $city;
// 				}
// 				if(!empty($_POST['birthday'])){
// 					$birthday = $_POST['birthday'];
// 					$data['birthday'] = $birthday;
// 				}
// 				if(!empty($_POST['email'])){
// 					$email = $_POST['email'];
// 					$data['email'] = $email;
// 				}
// 				if(!empty($_POST['password'])){
// 					$password = $_POST['password'];
// 					$data['password'] = $password;
// 				}
// 				if(!empty($_POST['favorite_sports'])){
// 					$favorite_sports = $_POST['favorite_sports'];
// 					$data['favorite_sports'] = $favorite_sports;
// 				}
// 			}
// 			$v->setView("user/profil-edit.tpl");
// 			$v->assign("idUser",$id);
// 			$v->assign("users",$users->update("users",$data,$where));
// 		}
// 	}

}
