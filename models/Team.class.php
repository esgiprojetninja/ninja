<?php


class Team extends basesql
{
	protected $id;
	protected $table = "teams";
	protected $teamName;
	protected $dateCreated;
	protected $sports = [];
	protected $description = "";
	protected $img = "";

	public function __construct(){
		parent::__construct();
	}

	public function getId() {
		return $this->id;
	}

	public function getTeamName(){
		return $this->teamName;
	}

	public function getDateCreated() {
		return $this->dateCreated;
	}

	public function getSports(){
		return $this->sports;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getImg(){
		return $this->img;
	}

	public function setId($id) {
		$this->idTeam = $id;
	}

	public function setTeamName($teamName){
		$this->teamName = $teamName;
	}

	public function setDateCreated($dateCreated) {
		$this->dateCreated = $dateCreated;
	}

	public function setSports($sports){
		$this->sports = $sports;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setImg($img){
		$this->img = $img;
	}

}
