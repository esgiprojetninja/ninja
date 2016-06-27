<?php
	
	//Classe permettant l'envoie d'invitation à un utilisateur, je n'ai pas fait de table de liaison car j'ai besoin de l'idTeam
	// & User, sinon ça faisait une table de liaison à trois infos, invit, user et teams, mais je ne savais pas comment envoyé
	// l'idInvitation a moins de recupérer lors de l'invit la derniere entrée en BDD. 

class Invitation extends basesql
{
	protected $id;
	protected $table = "invitations";
	protected $dateInvited; // date de l'invitation, on pourra supprimer les invitations au bout d'un mois dans le turfu
	protected $message = " We need you ! "; 
	protected $type;
	// 0 -> Team qui invite un user , 1 -> User qui demande à rejoindre
	protected $idTeamInviting; //Team qui invite
	protected $idUserInvited; //User invité
 
	protected $columns = [
		"id",
		"dateInvited",
		"message",
		"type",
		"idTeamInviting",
		"idUserInvited",
	];

	public function __construct(){
		parent::__construct();
	}

	public function setId($id){
		$this->id = $id;
	} 

	public function setDateInvited($dateInvited){
		$this->dateInvited = $dateInvited;
	} 

	public function setMessage($message){
		$this->message = htmlspecialchars($message);
	} 

	public function setType($type){
		$this->type = $type;
	} 

	public function setIdTeamInviting($idTeamInviting){
		$this->idTeamInviting = $idTeamInviting;
	}

	public function setIdUserInvited($idUserInvited){
		$this->idUserInvited = $idUserInvited;
	}

	public function getId(){
		return $this->id;
	} 

	public function getDateInvited(){
		return $this->dateInvited;
	} 

	public function getMessage(){
		return $this->messsage;
	} 

	public function getType(){
		return $this->type;
	} 

	public function getIdTeamInviting(){
		return $this->idTeamInviting;
	}

	public function getIdUserInvited(){
		return $this->idUserInvited;
	}
}