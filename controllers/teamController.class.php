<?php

class teamController
{

	public function createAction()
	{
		if(User::isConnected()){
			$id_user_creator = $_SESSION['user_id'];
			$view = new View();
			$team = new Team();
			$formCreateTeam = $team->getForm("create");
			$creaErrors = [];
			$validator = new Validator();
			if(!empty($_POST)) {
				$creaErrors = $validator->check($formCreateTeam["struct"], $_POST);
				if(count($creaErrors) == 0) {
					$teamHasUser = new TeamHasUser();
					$captain = new Captain();
					$team->setTeamName($_POST["teamName"]);
					$now = date("Y-m-d H:i:s");
					$team->setDateCreated($now);
					if(isset($_POST['description'])){
						$team->setDescription($_POST['description']);
					}
					$team->save();

					//On rajoute l'utilisateur qui crée la team dans sa team
					$id_team = Team::findBy("teamName", $_POST["teamName"], "string");
					$id_team = $id_team->getId();
					$teamHasUser->setIdTeam($id_team);
					$teamHasUser->setIdUser($id_user_creator);
					$teamHasUser->save();

					$captain->setIdTeam($id_team);
					$captain->setIdUser($id_user_creator);
					$captain->setCaptain(2);
					$captain->save();

					$view->assign("success","Your team has been created");
				}
			}
			$view->setView("team/create.tpl");
			$view->assign("formCreateTeam",$formCreateTeam);
			$view->assign("creaErrors",$creaErrors);
		}else{
			header('Location:'.WEBROOT.'user/login');
		}
	}

	/**
    * Edit a team profile
    * @param $args
    */
    public function editAction($args)
    {
    	if(User::isConnected() && !empty($args[0])){
			$team = Team::findById($args[0]);
            $view = new View();
			$formEdit = $team->getForm("edit");
			if ($team->getId() != $args[0]) {
				header("location:" . WEBROOT);
			}
			$editErrors = [];
			if(!empty($_POST)) {
				$validator = new Validator();
				$_SESSION['temp_idTeam'] = $args[0];
				$editErrors = $validator->check($formEdit["struct"], $_POST);
				if(count($editErrors) == 0) {
					if($_FILES['avatar']['size']!= 0){
						$path = "public/img/teams/".trim(strtolower($_POST["teamName"])).".".strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
						$movingFile = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
						if($movingFile){
							$view->assign("success","Changes has been saved");
							$team->setAvatar($path);
							//Suppression des anciennes images, si l'extension changeait ça en enregistrait deux, cordialement
							if($dossier = opendir('public/img/teams')){
								while(false !== ($fichier = readdir($dossier))){
									$explode = explode(".", $fichier);
									if($explode[0] == $_POST['teamName'] && $explode[1] != strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1))){
										unlink('public/img/teams/'.$fichier);
									}
								}
							}
						}else{
							$view->assign("movingFile", "An error while seting your team avatar");
						}
					}
					unlink($_SESSION['temp_idTeam']);
					$team->setTeamName($_POST["teamName"]);
					$team->setDescription($_POST["description"]);
					$team->save();
					$view->assign("success","Changes has been saved");
				}
			}
			$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"]);
			$view->assign("captain",$captain);
            $view->setView("team/edit.tpl");
            $view->assign("team", $team);
            $view->assign("formEdit", $formEdit);
            $view->assign("editErrors", $editErrors);
		}else{
			header('Location:'.WEBROOT.'user/login');
		}
    }

	public function showAction($args)
	{
		if(User::isConnected() && !empty($args[0])){
			$team = Team::findById($args[0]);
			$members = TeamHasUser::findBy("idTeam",$args[0],"int");
			$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"]);
	    $view = new view();
	    $invitation = Invitation::findBy(["idUserInvited","idTeamInviting","type"],[$_SESSION['user_id'],$args[0],1],['int',"int","int"]);
      $view->setView("team/show.tpl");
      $view->assign("invitation",$invitation);
      $view->assign("members",$members);
      $view->assign("team", $team);
      $view->assign("captain",$captain);
      $view->assign("idTeam",$args[0]);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function manageAction($args){
		if(User::isConnected() && !empty($args[0])){
				$response = [];
				$team = Team::findById($args[0]);
				$members = TeamHasUser::findBy("idTeam",$args[0],"int");
        $view = new View();
        $captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"]);

        $invitationsFrom = Invitation::findBy(["idTeamInviting","type"],[$args[0],1],['int','int']);
        $view->assign("invitationsFrom",$invitationsFrom);

		    $invitationsTo = Invitation::findBy(["idTeamInviting","type"],[$args[0],0],['int','int']);
        $view->assign("invitationsTo",$invitationsTo);

		    $view->setView("team/manage.tpl");
        $view->assign("members",$members);
        $view->assign("team", $team);
        $view->assign("captain",$captain);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function inviteAction($args){
		if(User::isConnected() && !empty($args[0])){
			$team = Team::findById($args[0]);
			$inviteErrors = [];
			$view = new View();
			$formInviteTeam = $team->getForm("invite");
			if(!empty($_POST)) {
				$validator = new Validator();
				$_SESSION['idTeam'] = $args[0];
				$inviteErrors = $validator->check($formInviteTeam["struct"], $_POST);
				if(count($inviteErrors) == 0) {
					$invitation = new Invitation();
					if(!filter_var($_POST["emailOrUsername"],FILTER_VALIDATE_EMAIL)){
						$id_user_invited = User::FindBy("username",$_POST["emailOrUsername"],"string");
					}else{
						$id_user_invited = User::FindBy("email",$_POST["emailOrUsername"],"string");
					}
					unset($_SESSION['idTeam']);
					//Si l'utilisateur existe
					if($id_user_invited){
						$now = date("Y-m-d H:i:s");
						$invitation->setDateInvited($now);
						if(!empty($_POST['message'])){
							$invitation->setMessage($_POST['message']);
						}
						$invitation->setType(0);
						$invitation->setIdTeamInviting($args[0]);
						$invitation->setIdUserInvited($id_user_invited->getId());
						$invitation->save();
            $message= " : the team ".$team->getTeamName()."  has invited you";
            Notification::createNotification($id_user=$id_user_invited->getId(),$message,$action=WEBROOT."team/show/".$args[0]);
            $view->assign("success","Utilisateur invité !");
					}else{
						$view->assign("error","Utilisateur inexistant");
					}
				}
			}
			$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"]);
			$view->assign("captain",$captain);
            $view->setView("team/invite.tpl");
            $view->assign("team",$team);
            $view->assign("formInviteTeam", $formInviteTeam);
            $view->assign("inviteErrors", $inviteErrors);
        }else{
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function listAction($args){
		if(User::isConnected()){
			$teams = Team::FindAll();
			$view = new View();

            $total = count($teams);//Nombre de team
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
			$retour_messages= Team::findAll([$premiereEntree,$messagesParPage],'id');
			$myTeams = TeamHasUser::findBy("idUser",$_SESSION['user_id'],"int");
			if($myTeams != false){
				$myTeams = Team::findById($myTeams);
				$view->assign("myTeams",$myTeams);
			}

			$view->assign('pageActuelle', $pageActuelle);
			$view->assign('nombreDePages',$nombreDePages);
      $view->setView("team/list.tpl");
    	$view->assign("teams", $retour_messages);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function demoteAction($args){
		if(User::isConnected() && isset($args["idTeam"]) && isset($args["idUser"])){
		 	$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"]);
		    if(!($captain->getCaptain() > 0)){
		      header('Location:'.WEBROOT.'user/login');
		    }
		    $userToDemote = Captain::findBy(["idUser","idTeam"],[$args["idUser"],$args["idTeam"]],["int","int"]);
		    // Si l'utilisateur a un role de captain 0 ou 1, donc pas admin
		    if($userToDemote->getCaptain() == 1 ){
		    	$userToDemote->setCaptain($userToDemote->getCaptain()-1);
		    	$userToDemote->save();
				$team =Team::findById($args["idTeam"]);
				$nameTeam =$team->getTeamName();
				Notification::createNotification($id_user=$args["idUser"],$message="You've got demoted of your captain function in the group ".$nameTeam." !",$action=WEBROOT."team/show/".$args["idTeam"]);
		    }
				Helpers::getMessageAjaxForm("User has been demoted !");
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
        $teams = Team::findByLike($args1,$args2);
        echo json_encode($teams);
    }

    public function membersAction($args){
        $args = implode(",", $args);
        $members = TeamHasUser::findBy("idTeam",$args,"int",false);
        $members = count($members);
        echo json_encode($members);
    }

	public function promoteAction($args){
		if(User::isConnected() && isset($args["idTeam"]) && isset($args["idUser"])){
		 	$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"]);
		    if(!($captain->getCaptain() > 0)){
		      header('Location:'.WEBROOT.'user/login');
		    }
		    $userToPromote = Captain::findBy(["idUser","idTeam"],[$args["idUser"],$args["idTeam"]],["int","int"]);
		    // Si l'utilisateur a un role de captain 0 ou 1, donc pas admin
		    if($userToPromote->getCaptain() < 2 ){
		    	$userToPromote->setCaptain($userToPromote->getCaptain()+1);
				$team =Team::findById($args["idTeam"]);
				$nameTeam =$team->getTeamName();
				Notification::createNotification($id_user=$args["idUser"],$message="You've got promoted to captain of the group ".$nameTeam." !",$action=WEBROOT."team/show/".$args["idTeam"]);
		    	$userToPromote->save();
		    }
				Helpers::getMessageAjaxForm("User has been promoted !");
		 }else{
		 	//A voir la redirection
		 	header('Location:'.WEBROOT.'user/login');
		 }
	}

	public function kickAction($args){
		 if(User::isConnected() && isset($args["idTeam"]) && isset($args["idUser"])){
		 	$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"]);
		    if(!($captain->getCaptain() > 0)){
		      header('Location:'.WEBROOT.'user/login');
		    }
		    Captain::findBy(['idUser','idTeam'],[$args['idUser'],$args["idTeam"]],["int","int"])->delete();
		    TeamHasUser::findBy(['idUser','idTeam'],[$args['idUser'],$args["idTeam"]],["int","int"])->delete();
			 Helpers::getMessageAjaxForm("User has been kicked !");
			 $team = Team::findById($args["idTeam"]);
			 $nameTeam = $team->getTeamName();
			 Notification::createNotification($id_user=$args['idUser'],$message="You've got kicked out of the group ".$nameTeam." !",$action=WEBROOT."team/show/".$args["idTeam"]);

         }else{
		 	//A voir la redirection
		 	header('Location:'.WEBROOT.'user/login');
		 }
	}

	public function leaveAction($args){
		if(User::isConnected() && isset($args["idTeam"])){
		    Captain::findBy(['idUser','idTeam'],[$_SESSION['user_id'],$args["idTeam"]],["int","int"])->delete();
			$captain = Captain::findBy(['idUser','idTeam'],[$_SESSION['user_id'],$args["idTeam"]],["int","int"])->delete();
		    TeamHasUser::findBy(['idUser','idTeam'],[$_SESSION['user_id'],$args["idTeam"]],["int","int"])->delete();

			$team = Team::findById($args["idTeam"]);
			$nameTeam = $team->getTeamName();
			$user = User::findById($args["idUser"]);
			$userName = $user->getUsername();
			Notification::createNotification($id_user=$captain,$message="The member ".$userName." has just left the group ".$nameTeam." !",$action=$action=WEBROOT."team/show/".$args["idTeam"]);

			// on véifie qu'apres avoir quitté l'equipe il y a encore des membres, sinon on supprime l'equipe
		    if(TeamHasUser::findBy("idTeam",$args['idTeam'],"int") == false){
		    	Team::findBy("id",$args['idTeam'],"int")->delete();
		    }

				Helpers::getMessageAjaxForm("Invitation canceled !");
		 }else{
		 	//A voir la redirection
		 	header('Location:'.WEBROOT.'user/login');
		 }
	}

	public function deleteAction($args){
		if(User::isConnected() && isset($args["idTeam"]) && isset($_SESSION['user_id'])){
		 	$captain = Captain::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"]);
		    if(!($captain->getCaptain() > 0)){
		      header('Location:'.WEBROOT.'user/login');
		    }

			$team = Team::findById($args["idTeam"]);
			$nameTeam = $team->getTeamName();
			$members = TeamHasUser::findBy('idTeam',$args["idTeam"],"int");
			foreach ($members as $member){
				Notification::createNotification($member,$message="The group ".$nameTeam." has been deleted !",$action="");
			}

			Captain::findBy('idTeam',$args["idTeam"],"int")->delete();
		    TeamHasUser::findBy('idTeam',$args["idTeam"],"int")->delete();
		    Team::findBy("id",$args['idTeam'],"int")->delete();

			Helpers::getMessageAjaxForm("Team deleted !");
		 }else{
		 	//A voir la redirection
		 	header('Location:'.WEBROOT.'user/login');
		 }
	}


	public function joinAction($args){
		if(User::isConnected() && isset($args["idTeam"]) && isset($args["type"])){
			if(isset($args["idUser"])){
				$idUser = $args["idUser"];
			}else{
				$idUser = $_SESSION['user_id'];
			}
			$teamHasUser = new TeamHasUser();
			$teamHasUser->setIdUser($idUser);
			$teamHasUser->setIdTeam($args["idTeam"]);
			$teamHasUser->save();

			$captain = new Captain();
			$captain->setIdTeam($args["idTeam"]);
			$captain->setIdUser($idUser);
			$captain->setCaptain(0);
			$captain->save();

			$invitation = Invitation::findBy(["idUserInvited","idTeamInviting","type"],[$idUser,$args["idTeam"],$args["type"]],['int','int','int']);
			$invitation->delete();

			$team = Team::findById($args["idTeam"]);
			$nameTeam = $team->getTeamName();
			$user = User::findById($args["idUser"]);
			$userName = $user->getUsername();
			Notification::createNotification($id_user=$captain,$message="The member ".$userName." has just join the group ".$nameTeam." !",$action=$action=WEBROOT."team/show/".$args["idTeam"]);

			Helpers::getMessageAjaxForm("Invitation accepted !");
		}else{
		 	//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function askToJoinAction($args){
		if(User::isConnected()){
			$invitation = new Invitation();
			if(!Invitation::findBy(["idUserInvited","idTeamInviting","type"],[$_SESSION['user_id'],$args['idTeam'],1],['int',"int","int"])){
				$now = date("Y-m-d H:i:s");
				$invitation->setDateInvited($now);
				if(!empty($args['messageInvit'])){
					$invitation->setMessage($args['messageInvit']);
				}
				$invitation->setType(1);
				$invitation->setIdTeamInviting($args["idTeam"]);
				$invitation->setIdUserInvited($_SESSION['user_id']);
				$invitation->save();
			}
			Helpers::getMessageAjaxForm("Invitation sent !");
		}else{
		 	//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function cancelInvitationAction($args){
		if(User::isConnected() && isset($args["idTeam"])){
			if(isset($args['idUser'])){
				$idUser = $args['idUser'];
			}else{
				$idUser = $_SESSION['user_id'];
			}
      Invitation::findBy(["idUserInvited","idTeamInviting"],[$idUser,$args["idTeam"]],['int','int'])->delete();

			Helpers::getMessageAjaxForm("Invitation canceled !");
		}else{
		 	//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

}
