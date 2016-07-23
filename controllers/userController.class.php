<?php

class userController
{

	public function indexAction($args){

	}

	public function showAction($args)
	{
		if(User::isConnected() && !empty($args[0])){
			$user = User::findById($args[0]);
			if ($user->getId() != $args[0]) {
				header("location:" . WEBROOT);
			}
      $v = new View();
      $teams = TeamHasUser::findBy("idUser",$args[0],"int");
      $v->setView("user/show.tpl");
      $v->assign("user", $user);
      $v->assign("teams",$teams);
      $v->assign("idUser",$args[0]);
		}else{
			header('Location:' . WEBROOT . 'user/login');
		}
	}

	 /**
     * Edit an user profile
     * @param $args
     */
    public function editAction($args)
    {
    	if(User::isConnected() && !empty($args[0])){
			$user = User::findById($args[0]);

      $v = new View();
      $v->setView("user/edit.tpl");

			$formEdit = $user->getForm("edit");
      $v->assign("formEdit", $formEdit);

			if ($user->getId() != $args[0]) {
				header("location:" . WEBROOT);
			}
			$editErrors = [];
			if(!empty($_POST)) {
				$validator = new Validator();
				$editErrors = $validator->check($formEdit["struct"], $_POST);
				if(count($editErrors) == 0) {
					if($_FILES['avatar']['size']!= 0){
						$path = "public/img/users/".trim(strtolower($_POST["username"])).".".strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
						$movingFile = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
						if($movingFile){
							$v->assign("success","Changes has been saved");
							$user->setAvatar($path);
							//Suppression des anciennes images, si l'extension changeait ça en enregistrait deux, cordialement
							if($dossier = opendir('public/img/users')){
								while(false !== ($fichier = readdir($dossier))){
									$explode = explode(".", $fichier);
									if($explode[0] == $_POST['username'] && $explode[1] != strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1))){
										unlink('public/img/users/'.$fichier);
									}
								}
							}
						}else{
							$v->assign("movingFile", "<span class='info'> An error while seting your avatar </span>");
						}
					}

					$user->setEmail(trim(strtolower($_POST["email"])));
					$user->setUsername(trim(($_POST["username"])));
					$user->setFirstName(trim(($_POST["first_name"])));
					$user->setLastName(trim(($_POST["last_name"])));
					$user->setPhoneNumber($_POST["phone_number"]);
					$user->setCity($_POST['city']);
					$user->setCountry($_POST['country']);
					$user->setStreet($_POST['street']);
					$user->setZipcode($_POST['zipcode']);

					$user->save();
				}
			}
      $v->assign("user", $user);
      $v->assign("idUser",$args[0]);
      $v->assign("editErrors", $editErrors);
		}else{
			header('Location:'.WEBROOT.'user/login');
		}
    }

	/**
	*
	*/

	public function activateAction($args) {
		$view = new View();
		$view->setView("user/activation.tpl");

		$activateErrors = [];

		$user = User::FindBy('email',$args['email'],'string');

		$formActivation = $user->getForm("activation");
		$view->assign("formActivation", $formActivation);

		$validator = new Validator();
		if (isset($args["token"]) && !User::findBy("token", $args["token"], "string")) {
			header("location: ".WEBROOT.'user/login');
		}
		else if(isset($args["token"]) && $user->getToken() == $args["token"]) {
			if ($user->getIsActive() != 1) {
				$view->assign("user",$user);
				if(!empty($_POST)) {
					$activateErrors = $validator->check($formActivation["struct"], $_POST);
					if(count($activateErrors) == 0) {
						$user->setPassword($_POST["password"]);
						$user->setIsActive(1);
						$user->save();
						$view->assign("activate_msg", "<span class='info'> Your account is now activated </span>");
						session_destroy();
					}
				}
			}
			else {
				$view->assign("activate_msg", "<span class='info'> Looks like your account had already been activated </span>");
			}
		}
		$view->assign("activateErrors",$activateErrors);
	}

	public function subscribeAction($args) {
		$view = new View();
		$view->setView("user/subscribe.tpl");

		$subErrors = [];
		$logErrors = [];

		$user = new User();

		$formSubscribe = $user->getForm("subscription");
		$view->assign("formSubscribe", $formSubscribe);

		$formLogin = $user->getForm("login");
		$view->assign("formLogin", $formLogin);
		$validator = new Validator();

		if(isset($_POST["form-type"])) {
			$subErrors = $validator->check($formSubscribe["struct"], $_POST);
			if(count($subErrors) == 0) {
				$user->setEmail(trim(strtolower($_POST["email"])));
				$user->setUsername($_POST['username']);
				$user->setIsActive(0);
				$user->setToken();
				$now = date("Y-m-d H:i:s");
				$user->setDateCreated($now);
				$user->save();
				if($user->sendEmail("subscribe")) {
					$view->assign( "mailerMessage", "<span class='info'> An email has just been sent to ".$user->getEmail() . "</span>" );
				} else {
					$view->assign( "mailerMessage", "<span class='info'> Something went wrong when trying to send email. </span>" );
				}
			}
		}
		$view->assign("subErrors", $subErrors);
		$view->assign("logErrors", $logErrors);
	}

	public function loginAction () {
		$view = new View();
		$view->setView("user/login.tpl");

		$subErrors = [];
		$logErrors = [];

		$formSubscribe = User::getForm("subscription");
		$view->assign("formSubscribe", $formSubscribe);

		$formLogin = User::getForm("login");
		$view->assign("formLogin", $formLogin);

		if(isset($_POST["form-type"])) {
			if($user = User::findBy("email", trim(strtolower($_POST["email"])), "string")) {
				if($user->getEmail() == trim(strtolower($_POST["email"])) && (crypt(trim($_POST["password"]), SALT) == $user->getPassword())){
					$user->setToken();
					$user->save();
					$token = $user->getToken();
					$id = $user->getId();
					$_SESSION["user_id"] = $id;
					$_SESSION["user_token"] = $token;
					header("location: ".WEBROOT);
				}
				else {
					$view->assign("error_message", "<span class='info'> Couldn't find you :( </span>");
				}
			}
			else {
				$view->assign("error_message", "<span class='info'> Couldn't find you :( </span>");
			}
		}

		$view->assign("subErrors", $subErrors);
		$view->assign("logErrors", $logErrors);
	}

	/**
	* Logs out current user
	* @return void
	*/
	public function logoutAction () {
		session_destroy();
		header("location: ".WEBROOT."user/login");
	}

	public function resetPasswordAction($args) {
		$view = new View();
		$form = User::getForm("resetPassword");
		$formErrors = [];

		$view->assign("form", $form);
		$view->assign("formErrors", $formErrors);
		$view->setView("user/change-password.tpl");

		if (isset($_POST["form-type"])) {
			if ($user = User::findBy("email", trim(strtolower($_POST["reset-email"])), "string")) {
				$user->setToken();
				$user->save();
				$user->sendEmail("reset");
				$view->assign(
					"mail_new_pwd",
					"<span class='info'> An email has just been sent to " . $user->getEmail() . ", for reset password. Please check your email box. </span>"
				);
			} else {
				$view->assign("mail_new_pwd", "<span class='info'> Couldn't find this address </span>");
			}
		}
	}

	public function setNewPasswordAction($args) {
		// Get ou Post ?
		if (isset($args["email"]) && isset($args["token"]) || (isset($_POST["form-type"]) && $_POST["form-type"] == "setNewPassword")) {
			if (isset($args["email"])) {
				$user = User::findBy("email", strtolower(trim($args["email"])), "string");
			} else if (isset($_POST["email"])) {
				$user = User::findBy("email", strtolower(trim($_POST["email"])), "string");
			}
			// Good token ?
			if ($user->getToken() == $args["token"] || $user->getToken() == $_POST["token"]) {
				$view = new View();
				$form = User::getForm("setNewPassword");
				$form["struct"]["email"]["value"] = $user->getEmail();
				$form["struct"]["token"]["value"] = $user->getToken();
				$formErrors = [];
				if (isset($_POST["form-type"]) && $_POST["form-type"] == "setNewPassword") {
					$validator = new Validator();
					$formErrors = $validator->check($form["struct"], $_POST);
					if (count($formErrors) == 0) {
						$user->setPassword($_POST["password"]);
						$user->setToken();
						$user->save();
						$view->assign(
							"success",
							"<span class='info'> Your Password has been updated ! You can now log in with you new password :) </span>"
						);
					}
				}
				$view->assign("form", $form);
				$view->assign("formErrors", $formErrors);

				$view->setView("user/set-new-password.tpl");
			} else {
				header("location:" . WEBROOT . "/user/logout");
			}
		} else {
			header("location:" . WEBROOT);
		}
	}

	public function deleteAction($args){
		if(User::isConnected() && User::isAdmin()){
			User::findBy('id',$args[0],'int')->delete();
		}
	}

	public function deleteAvatarAction($args){
			if(User::isConnected()){
				$user = User::findById($_SESSION['user_id']);
				if($user->getAvatar()){
					unlink($user->getAvatar());
					$user->setAvatar("");
					$user->save();
					Helpers::getMessageAjaxForm("Avatar deleted !");

				}else{
					header("location:" . WEBROOT);
				}
			}else {
				header("location:" . WEBROOT);
			}
	}

}
