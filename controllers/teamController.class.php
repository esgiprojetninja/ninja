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
                    $admin = new Admin();
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
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"],false);
            $view = new View();
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
            $view = new View();
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args[0]],["int","int"],false);
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
                        $invitation->setState(0);
                        $invitation->setIdTeamInviting($args[0]);
                        $invitation->setIdUserInvited($id_user_invited->getId());
                        $invitation->save();
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
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"],false);
            if(!($admin[0]['captain'] > 0)){
                header('Location:'.WEBROOT.'user/login');
            }
            $userToDemote = Admin::findBy(["idUser","idTeam"],[$args["idUser"],$args["idTeam"]],["int","int"]);
            // Si l'utilisateur a un role de captain 0 ou 1, donc pas admin
            if($userToDemote->getCaptain() == 1 ){
                $userToDemote->setCaptain($userToDemote->getCaptain()-1);
                $userToDemote->save();
            }
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

    public function promoteAction($args){
        if(User::isConnected() && isset($args["idTeam"]) && isset($args["idUser"])){
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"],false);
            if(!($admin[0]['captain'] > 0)){
                header('Location:'.WEBROOT.'user/login');
            }
            $userToPromote = Admin::findBy(["idUser","idTeam"],[$args["idUser"],$args["idTeam"]],["int","int"]);
            // Si l'utilisateur a un role de captain 0 ou 1, donc pas admin
            if($userToPromote->getCaptain() < 2 ){
                $userToPromote->setCaptain($userToPromote->getCaptain()+1);
                $userToPromote->save();
            }
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

    public function kickAction($args){
        if(User::isConnected() && isset($args["idTeam"]) && isset($args["idUser"])){
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"],false);
            if(!($admin[0]['captain'] > 0)){
                header('Location:'.WEBROOT.'user/login');
            }
            Admin::delete(['idUser','idTeam'],[$args['idUser'],$args["idTeam"]],["int","int"]);
            TeamHasUser::delete(['idUser','idTeam'],[$args['idUser'],$args["idTeam"]],["int","int"]);
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

    public function leaveAction($args){
        if(User::isConnected() && isset($args["idTeam"]) && isset($_SESSION['user_id'])){
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"],false);
            if(!($admin[0]['captain'] > 0)){
                header('Location:'.WEBROOT.'user/login');
            }
            Admin::delete(['idUser','idTeam'],[$_SESSION['user_id'],$args["idTeam"]],["int","int"]);
            TeamHasUser::delete(['idUser','idTeam'],[$_SESSION['user_id'],$args["idTeam"]],["int","int"]);

            // on véifie qu'apres avoir quitté l'equipe il y a encore des membres, sinon on supprime l'equipe
            if(TeamHasUser::findBy("idTeam",$args['idTeam'],"int",false) == false){
                Team::delete("id",$args['idTeam'],"int");
            }
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

    public function deleteAction($args){
        if(User::isConnected() && isset($args["idTeam"]) && isset($_SESSION['user_id'])){
            $admin = Admin::findBy(["idUser","idTeam"],[$_SESSION['user_id'],$args["idTeam"]],["int","int"],false);
            if(!($admin[0]['captain'] > 0)){
                header('Location:'.WEBROOT.'user/login');
            }

            Admin::delete('idTeam',$args["idTeam"],"int");
            TeamHasUser::delete('idTeam',$args["idTeam"],"int");
            Team::delete("id",$args['idTeam'],"int");

        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }


    public function joinAction($args){
        if(User::isConnected() && isset($args["idTeam"]) && isset($_SESSION['user_id'])){
            $teamHasUser = new TeamHasUser();
            $teamHasUser->setIdUser($_SESSION['user_id']);
            $teamHasUser->setIdTeam($args["idTeam"]);
            $teamHasUser->save();

            $admin = new Admin();
            $admin->setIdTeam($args["idTeam"]);
            $admin->setIdUser($_SESSION['user_id']);
            $admin->setCaptain(0);
            $admin->save();

            Invitation::delete(["idUserInvited","idTeamInviting"],[$_SESSION['user_id'],$args["idTeam"]],['int','int']);
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

    public function refuseInvitAction($args){
        if(User::isConnected() && isset($args["idTeam"]) && isset($_SESSION['user_id'])){
            Invitation::delete(["idUserInvited","idTeamInviting"],[$_SESSION['user_id'],$args["idTeam"]],['int','int']);
        }else{
            //A voir la redirection
            header('Location:'.WEBROOT.'user/login');
        }
    }

}
