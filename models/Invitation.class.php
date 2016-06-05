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
	protected $state; //En vrai c'est inutile, je vais surement le supprimer
	// 0 -> pending , 1 -> accepted(surement supprimé quand accepté, et l'user rejoind la team),2 -> refusé (supprimé aussi mais ne rejoind pas l'equipe)
	protected $idTeamInviting; //Team qui invite
	protected $idUserInvited; //User invité
 
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

	public function setState($state){
		$this->state = $state;
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

	public function getState(){
		return $this->state;
	} 

	public function getIdTeamInviting(){
		return $this->idTeamInviting;
	}

	public function getIdUserInvited(){
		return $this->idUserInvited;
	}
}
