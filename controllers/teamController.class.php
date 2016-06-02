<?php

class teamController
{

	public function createAction()
	{
		if(User::isConnected()){
			$id_user_creator = $_SESSION['user_id'];
			$view = new view();
			$team = new Team();
			$formCreateTeam = $team->getForm("create");
			$creaErrors = [];
			$validator = new Validator();
			if(!empty($_POST)) {
				$creaErrors = $validator->check($formCreateTeam["struct"], $_POST);
				if(count($creaErrors) == 0) {
					$teamHasUser = new TeamHasUser();
					$admin = new Admin();
					$team->setTeamName($_POST["teamName"]);
					date_default_timezone_set('Europe/Paris');
					$now = date("Y-m-d H:i");
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

					$admin->setIdTeam($id_team);
					$admin->setIdUser($id_user_creator);
					$admin->setCaptain(2);
					$admin->save();

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
            $view = new view();
			$formEdit = $team->getForm("edit");
			if ($team->getId() != $args[0]) {
				header("location:" . WEBROOT);
			}
			$editErrors = [];
			if(!empty($_POST)) {
				$validator = new Validator();
				$editErrors = $validator->check($formEdit["struct"], $_POST);
				if(count($editErrors) == 0) {
					$path = "public/img/teams/".trim(strtolower($_POST["teamName"])).".".strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
					$movingFile = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
					if($movingFile){
						$view->assign("success","Changes has been saved");
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
					$team->setAvatar($path);
					$team->setTeamName($_POST["teamName"]);
					$team->setDescription($_POST["description"]);
					$team->save();
					$view->assign("success","Changes has been saved");
				}
			}
			$admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"],false);
			$view->assign("admin",$admin);
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
			$members = TeamHasUser::findBy("idTeam",$args[0],"int",false);
			$admin = Admin::findBy("idUser",$_SESSION['user_id'],"int",false);
            $view = new view();
            $view->setView("team/show.tpl");
            $view->assign("members",$members);
            $view->assign("team", $team);
            $view->assign("admin",$admin);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function manageAction($args){
		if(User::isConnected() && !empty($args[0])){
			$team = Team::findById($args[0]);
			$members = TeamHasUser::findBy("idTeam",$args[0],"int",false);
            $view = new view();
            $admin = Admin::findBy("idUser",$_SESSION['user_id'],"int",false);
            $view->setView("team/manage.tpl");
            $view->assign("members",$members);
            $view->assign("team", $team);
            $view->assign("admin",$admin);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function inviteAction($args){
		if(User::isConnected() && !empty($args[0])){
			$team = Team::findById($args[0]);
			$inviteErrors = [];
			$view = new view();
			$formInviteTeam = $team->getForm("invite");
			if(!empty($_POST)) {
				$validator = new Validator();
				$_SESSION['idTeam'] = $args[0];
				$inviteErrors = $validator->check($formInviteTeam["struct"], $_POST);
				if(count($inviteErrors) == 0) {
					$teamHasUser = new TeamHasUser();
					$admin = new Admin();
					if(!filter_var($_POST["emailOrUsername"],FILTER_VALIDATE_EMAIL)){
						$id_user_invited = User::FindBy("username",$_POST["emailOrUsername"],"string");
					}else{
						$id_user_invited = User::FindBy("email",$_POST["emailOrUsername"],"string");
					}
					//Si l'utilisateur existe
					if($id_user_invited){
						unset($_SESSION['idTeam']);
						$teamHasUser->setIdUser($id_user_invited->getId());
						$teamHasUser->setIdTeam($args[0]);
						$teamHasUser->save();

						$admin->setIdTeam($args[0]);
						$admin->setIdUser($id_user_invited->getId());
						$admin->setCaptain(0);
						$admin->save();
						$view->assign("success","Utilisateur invité !");
					}else{
						$view->assign("error","Utilisateur inexistant");
					}
				}
			}		
			$admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"],false);
			$view->assign("admin",$admin);
            $view->setView("team/invite.tpl");
            $view->assign("team",$team);
            $view->assign("formInviteTeam", $formInviteTeam);
            $view->assign("inviteErrors", $inviteErrors);
        }else{
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function deleteAction($args){
		if(User::isConnected() && empty($args[0])){
			$team = Team::findById($args[0]);
			$view = new view();

            $view->setView("team/delete.tpl");
            $view->assign("team", $team);
            $view->assign("id",$args[0]);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function listAction($args){
		if(User::isConnected()){
			$teams = Team::FindAll();
			$view = new view();

            $view->setView("team/list.tpl");
            $view->assign("teams", $teams);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

}