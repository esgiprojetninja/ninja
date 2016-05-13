<?php

class teamController
{

	public function createAction()
	{
		$view = new View();
		$errors = [];
		$id_user_creator = $_SESSION['user_id'];
		$validForm = TRUE;
		//Verif du formulaire
		if(isset($_POST["team_creation_form"])) {
			if(!isset($_POST["teamName"]) || strlen($_POST["teamName"]) < 4 || strlen($_POST["teamName"]) > 20) {
				$validForm = FALSE;
				$errors[] = "Please enter a valid team name";
			} else {
				$teamName = strtolower(htmlspecialchars($_POST["teamName"]));
			}
			if(isset($_POST['description'])){
				$description = htmlspecialchars($_POST['description']);
			}
		}else{
			$validForm = FALSE;
		}
		if(!$validForm) {
			$view->assign("errors", $errors);
		} else {
			//On crée la team en BDD
			$team = new Team();
			$teamHasUser = new TeamHasUser();
			$team->setTeamName($teamName);
			$now = date("Y-m-d");
			$team->setDateCreated($now);
			if(isset($description)){
				$team->setDescription($description);
			}
			$team->save();
			//On rajoute l'utilisateur qui crée la team dans sa team
			$id_team = Team::findBy("teamName", $teamName, "string");
			$id_team = $id_team->getId();
			$teamHasUser->setIdTeam($id_team);
			$teamHasUser->setIdUser($id_user_creator);
			$teamHasUser->save();
		}
		$view->setView("team/create.tpl");
	}

	public function showAction($args)
	{
		if(!empty($args[0])){
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
		if(!empty($args[0])){
			$team = Team::findById($args[0]);
			$members = TeamHasUser::findBy("idTeam",$args[0],"int");
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
		if(!empty($args[0])){
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
		if(!empty($args[0])){
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

}
