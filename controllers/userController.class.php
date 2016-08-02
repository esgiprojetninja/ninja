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
			$events = Event::findAll();
      $v->setView("user/show.tpl");
      $v->assign("user", $user);
      $v->assign("teams",$teams);
      $v->assign("events",$events);
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

		$formActivation = $user[0]->getForm("activation");
		$view->assign("formActivation", $formActivation);

		$validator = new Validator();
		if (isset($args["token"]) && !User::findBy("token", $args["token"], "string")) {
			header("location: ".WEBROOT.'user/login');
		}
		else if(isset($args["token"]) && $user[0]->getToken() == $args["token"]) {
			if ($user[0]->getIsActive() != 1) {
				$view->assign("user",$user);
				if(!empty($_POST)) {
					$activateErrors = $validator->check($formActivation["struct"], $_POST);
					if(count($activateErrors) == 0) {
						$user[0]->setPassword($_POST["password"]);
						$user[0]->setIsActive(1);
						$user[0]->save();
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
		if(User::isConnected()) {
			header("location:" . WEBROOT . "index/index");
		}
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
		if(User::isConnected()) {
			header("location:" . WEBROOT . "index/index");
		}
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
				if($user[0]->getEmail() == trim(strtolower($_POST["email"])) && (crypt(trim($_POST["password"]), SALT) == $user[0]->getPassword())){
					$user[0]->setToken();
					$user[0]->save();
					$token = $user[0]->getToken();
					$id = $user[0]->getId();
					$_SESSION["user_id"] = $id;
					$_SESSION["username"] = $user[0]->getUsername();
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
				$user[0]->setToken();
				$user[0]->save();
				$user[0]->sendEmail("reset");
				$view->assign(
					"mail_new_pwd",
					"<span class='info'> An email has just been sent to " . $user[0]->getEmail() . ", for reset password. Please check your email box. </span>"
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
			if ($user[0]->getToken() == $args["token"] || $user[0]->getToken() == $_POST["token"]) {
				$view = new View();
				$form = User::getForm("setNewPassword");
				$form["struct"]["email"]["value"] = $user[0]->getEmail();
				$form["struct"]["token"]["value"] = $user[0]->getToken();
				$formErrors = [];
				if (isset($_POST["form-type"]) && $_POST["form-type"] == "setNewPassword") {
					$validator = new Validator();
					$formErrors = $validator->check($form["struct"], $_POST);
					if (count($formErrors) == 0) {
						$user[0]->setPassword($_POST["password"]);
						$user[0]->setToken();
						$user[0]->save();
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
			$user = User::findBy('id',$args[0],'int');
			$user[0]->delete();

			if($teamHasUser = TeamHasUser::findBy('idUser',$args[0],"int")){
				foreach($teamHasUser as $teamUser){
					$teamUser->delete();
					if(TeamHasUser::findBy("idTeam",$teamUser->getIdTeam(),"int") == false){
						$team = Team::findBy("id",$teamUser->getIdTeam(),"int");
						$team[0]->delete();
					}
				}
			}
			if($captain = Captain::findBy('idUser',$args[0],"int")){
				foreach($captain as $cap){
					$cap->delete();
				}
			}

			if($comment = Comment::findBy('id_author',$args[0],"int")){
				foreach($comment as $com){
					$com->delete();
				}
			}

			if($eventsHasComment = EventHasComment::findBy('id_author',$args[0],'int')){
				foreach($EventHasComment as $eventComment){
					$eventComment->delete();
				}
			}

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

	public function listAction($args){
		if(User::isConnected()){
			$users = User::FindAll();
			$view = new View();

			$total = count($users);//Nombre de team
			$messagesParPage=6; //Nombre de messages par page
			$nombreDePages=ceil($total/$messagesParPage);

			if(isset($_GET['page'])){
				$pageActuelle=intval($_GET['page']);
				if($pageActuelle>$nombreDePages)
				{
					$pageActuelle=$nombreDePages;
				}
			}else{
				$pageActuelle=1;
			}
			$premiereEntree=($pageActuelle-1)*$messagesParPage;
			// La requête sql pour récupérer les messages de la page actuelle.
			$retour_messages= User::findAll([$premiereEntree,$messagesParPage],'id');
			//$myUsers = TeamHasUser::findBy("idUser",$_SESSION['user_id'],"int");
			/*if($myUsers != false){
				$myUsers = User::findById($myUsers);
				$view->assign("myTeams",$myUsers);
			}*/

			$view->assign('pageActuelle', $pageActuelle);
			$view->assign('nombreDePages',$nombreDePages);
			$view->setView("user/list.tpl");
			$view->assign("users", $retour_messages);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function searchAction($args)
	{
		header('Content-Type: application/json');
		$args = implode(",", $args);
		$args = explode(",", $args);
		$args1 = $args[0];
		$args2 = $args[1];
		$users = User::findByLikeArray($args1,$args2);

		echo json_encode($users);
	}

}
