<?php

class Team extends basesql
{
	protected $id;
	protected $table = "teams";
	protected $teamName;
	protected $dateCreated;
	protected $sports = "";
	protected $description = "";
	protected $avatar = "";

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

	public function getAvatar(){
		return $this->avatar;
	}

	public function setId($id) {
		$this->idTeam = $id;
	}

	public function setTeamName($teamName){
		$this->teamName = htmlspecialchars($teamName);
	}

	public function setDateCreated($dateCreated) {
		$this->dateCreated = $dateCreated;
	}

	public function setSports($sports){
		$this->sports = $sports;
	}

	public function setDescription($description) {
		$this->description = htmlspecialchars($description);
	}

	public function setAvatar($avatar){
		$this->avatar = $avatar;
	}

	public function getForm($formType){
		$form = [];
		if ($formType == "create") {
			$form = [
				"title" => "Create your own team",
				"buttonTxt" => "Create",
				"options" => ["method" => "POST", "action" => WEBROOT . "team/create"],
				"struct" => [
					"teamName"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Team Name", "required"=>1, "msgerror"=>"teamName" ],
					"description"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Description", "required"=>0, "msgerror"=>"description" ],
					"form-type" => ["type" => "hidden", "value" => "createTeam", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""]
				]
			];
		} 
		else if ($formType == "edit") {
			$form = [
				"title" => "Team params",
				"buttonTxt" => "Confirm",
				"options" => ["method" => "POST", "action" => WEBROOT . "team/edit/" . $this->id,"enctype"=>"multipart/form-data"],
				"struct"=>[
					"teamName"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Team name", "required"=>1, "msgerror"=>"newTeamName", "value" => $this->getTeamName()],
					"description"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Description", "required"=>1, "msgerror"=>"newDescription", "value" => $this->getDescription()],
					"avatar"=>["type"=>"file","class"=>"form-control","placeholder"=>"Your avatar","required"=>1,"msgerror"=>"avatar","value"=>"../../".$this->getAvatar()],]
			];
		}
		else if ($formType == "invite") {
			$form = [
				"title" => "Invite a new partner",
				"buttonTxt" => "Invite",
				"options" => ["method" => "POST", "action" => WEBROOT . "team/invite/".$this->id],
				"struct"=>[
					"emailOrUsername"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Email or username to invite", "required"=>1, "msgerror"=>"emailOrUsername"],]
					];
		}
		
		return $form;
	}

};