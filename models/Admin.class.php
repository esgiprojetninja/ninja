<?php

//Pourquoi un modèle pour une table de liaison? Malheureusement avec le code actuel, si je peux afficher ou récupérer des infos
// de cette table je suis obligé de créer des instances différentes propre à ma table, du coups c'est plus simple de créer cette
// classe pour réutiliser les fonctions existantes.

class Admin extends basesql
{
	protected $id;
	protected $table = "admin";
	protected $idTeam;
	protected $idUser;
	protected $captain = 0;

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

	public function getCaptain() {
		return $this->captain;
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

	public function setCaptain($captain) {
		$this->captain = $captain;
	}

}
