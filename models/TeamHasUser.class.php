<?php

//Pourquoi un modèle pour une table de liaison? Malheureusement avec le code actuel, si je peux afficher ou récupérer des infos
// de cette table je suis obligé de créer des instances différentes propre à ma table, du coups c'est plus simple de créer cette
// classe pour réutiliser les fonctions existantes.

class TeamHasUser extends basesql
{
	protected $id;
	protected $table = "team_has_user";
	protected $idTeam;
	protected $idUser;
	protected $admin = 0;

	public function __construct(){
		parent::__construct();
	}

	public function getId() {
		return $this->id;
	}

	public function getIdTeam(){
		return $this->idTeam;
	}

	public function getIdUser() {
		return $this->idUser;
	}

	public function getAdmin() {
		return $this->admin;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setIdTeam($idTeam){
		$this->idTeam = $idTeam;
	}

	public function setIdUser($idUser){
		$this->idUser = $idUser;
	}

	public function setAdmin($admin) {
		$this->admin = $admin;
	}

}
