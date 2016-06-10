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
            $v = new view();
            $teams = TeamHasUser::findBy("idUser",$args[0],"int",false);
            $v->setView("user/show.tpl");
            $v->assign("user", $user);
            $v->assign("teams",$teams);	
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
            $v = new view();
			$formEdit = $user->getForm("edit");
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
							$v->assign("movingFile", "An error while seting your avatar");
						}
					}
					$user->setEmail(trim($_POST["email"]));
					$user->setUsername(trim(strtolower($_POST["username"])));
					$user->setFirstName(trim(strtolower($_POST["first_name"])));
					$user->setLastName(trim(strtolower($_POST["last_name"])));
					$user->setPhoneNumber($_POST["phone_number"]);
					
					$user->save();
					
				}
			}
            $v->setView("user/edit.tpl");
            $v->assign("user", $user);
            $v->assign("formEdit", $formEdit);
            $v->assign("editErrors", $editErrors);
		}else{
			header('Location:'.WEBROOT.'user/login');
		}
    }

	/**
	*
	*/

	public function activateAction($args) {
		$view = new view();
		$user = User::FindBy('email',$args['email'],'string');
		$view->setView("user/activation.tpl");
		$formActivation = $user->getForm("activation");
		$actErrors = [];
		$validator = new Validator();	
		if (isset($args["token"]) && !User::findBy("token", $args["token"], "string")) {
			header("location: ".WEBROOT.'user/login');
		} 
		else if(isset($args["token"]) && $user->getToken() == $args["token"]) {
			if ($user->getIsActive() != 1) {	
				$view->assign("user",$user);
				if(!empty($_POST)) {
					$actErrors = $validator->check($formActivation["struct"], $_POST);
					if(count($actErrors) == 0) {
						$user->setPassword($_POST["password"]);
						$user->setIsActive(1);
						$user->save();
						$view->assign("account_activated", "yeeha");
						$view->assign("msg", "Your account is now activated");
						session_destroy();
					}
				}
			} 
			else {
				$view->assign("msg", "Looks like your account had already been activated");
			}
		}
		$view->assign("actErrors",$actErrors);	
		$view->assign("formActivation", $formActivation);
	}

	public function subscribeAction($args) {
		$view = new view();
		$view->setView("user/subscribe.tpl");
		$user = new User();
		$formSubscribe = $user->getForm("subscription");
		$formLogin = $user->getForm("login");
		$subErrors = [];
		$logErrors = [];

		$validator = new validator();
		if(isset($_POST["form-type"])) {
			$subErrors = $validator->check($formSubscribe["struct"], $_POST);
			if(count($subErrors) == 0) {
				$user->setEmail($_POST['email']);
				$user->setUsername($_POST['username']);
				$user->setIsActive(0);
				$user->setToken();
				$now = date("Y-m-d H:i:s");
				$user->setDateCreated($now);
				$user->save();
				if($user->sendConfirmationEmail()) {
					$view->assign( "mailerMessage", "An email has just been sent to ".$user->getEmail() );
				} else {
					$view->assign( "mailerMessage", "Something went wrong when trying to send email." );
				}
			}
		}
		
		$view->assign("formSubscribe", $formSubscribe);
		$view->assign("subErrors", $subErrors);
		$view->assign("formLogin", $formLogin);
		$view->assign("logErrors", $logErrors);
	}

	public function loginAction () {
		$view = new view();
		$view->setView("user/login.tpl");
		$formSubscribe = User::getForm("subscription");
		$formLogin = User::getForm("login");
		$subErrors = [];
		$logErrors = [];
		if(isset($_POST["form-type"])) {
			if($user = User::findBy("email", $_POST["email"], "string")) {
				if($user->getEmail() == trim($_POST["email"]) && (crypt(trim($_POST["password"]),$user->getPassword()) == $user->getPassword())){
					$user->setToken();
					print_r($user->getToken());
					$user->save();
					$token = $user->getToken();
					$id = $user->getId();
					$_SESSION["user_id"] = $id;
					$_SESSION["user_token"] = $token;
					header("location: ".WEBROOT);
				}
				else {
					$view->assign("error_message", "Couldn't find you :(");	
				}
			}
			else {
				$view->assign("error_message", "Couldn't find you :(");
			}
		}
		$view->assign("formSubscribe", $formSubscribe);
		$view->assign("subErrors", $subErrors);
		$view->assign("formLogin", $formLogin);
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

}