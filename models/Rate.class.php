<?php

class Rate extends basesql{
	
	protected $id;
	protected $table = "rate";
	protected $idUser;
	protected $idFor;
	protected $score;
	protected $dateLastVote;

	protected $columns = [
		"id", // id row
		"id_user", // user connecte $id
		"id_for", // user pour qui je vote
		"score", // promote or demote
		"dateLastVote"
	];

	public function __construct(){
		parent::__construct();
	}

	public function getIdUser(){
		return $this->idUser;
	}

	public function getIdFor(){
		return $this->idFor;
	}
	
	public function getType(){
		return $this->type;	
	}

	public function getDate(){
		return $this->date;
	}

	public function setIdUser($idUser){
		$this->idUser = $idUser;
	}

	public function setIdFor($idFor){
		$this->idFor = $idFor;
	}

	public function setScore($score){
		$this->score = $score;
	}

	public function setDate($date){
		$this->date = $dateLastVote;
	}

	setRate($rate, $id){
		if(User::isConnected()){
			
		}
	}
	

}

