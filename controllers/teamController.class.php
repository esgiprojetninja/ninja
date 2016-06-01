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
					$teamHasUser->setAdmin(2);
					$teamHasUser->setIdTeam($id_team);
					$teamHasUser->setIdUser($id_user_creator);
					$teamHasUser->save();
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
					$team->setTeamName($_POST["teamName"]);
					$team->setDescription($_POST["description"]);
					$team->save();
				}
			}
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
            $view = new view();
            $view->setView("team/show.tpl");
            $view->assign("members",$members);
            $view->assign("team", $team);
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
            $view->setView("team/manage.tpl");
            $view->assign("members",$members);
            $view->assign("team", $team);
		}else{
			//A voir la redirection
			header('Location:'.WEBROOT.'user/login');
		}
	}

	public function inviteAction($args){
		if(User::isConnected() && !empty($args[0])){
			$errors = [];
			$id_user_creator = $_SESSION['user_id'];
			$validForm = TRUE;
			$view = new view();
			if(isset($_POST["team_invite_form"]) ) {
				if(!isset($_POST["usernameOrEmail"])||strlen($_POST["usernameOrEmail"])<3||strlen($_POST["usernameOrEmail"])>30) {
					$validForm = FALSE;
					$errors[] = "Please enter a valid Username or Email";
				}else {
					if(filter_var($_POST["usernameOrEmail"], FILTER_VALIDATE_EMAIL)){
						$email = strtolower(htmlspecialchars($_POST["usernameOrEmail"]));
					}else{
						$username = strtolower(htmlspecialchars($_POST["usernameOrEmail"]));
					}
				}
			}else{
				$validForm = FALSE;
			}
			if(!$validForm) {
				$view->assign("errors", $errors);
			} else {
				$teamHasUser = new TeamHasUser();
				if(!isset($email)){
					$id_user_invited = User::FindBy("username",$username,"string");
				}else{
					$id_user_invited = User::FindBy("email",$email,"string");
				}
				$id_user_invited = $id_user_invited->getId();
				$id_team = $args[0];
				$teamHasUser->setIdUser($id_user_invited);
				$teamHasUser->setIdTeam($id_team);
				$teamHasUser->save();
			}
			$view->assign("id",$args[0]);
            $view->setView("team/invite.tpl");
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