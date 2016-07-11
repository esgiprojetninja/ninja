<?php

class Rating extends basesql{
	
	protected $id;
	protected $table = "user_score";
	protected $idUser;
	protected $promote = 0;
	protected $idUserLastPromote;
	protected $demote = 1;
	protected $idUserLastDemote;
	protected $ratio = 0;

	protected $columns = [
		"id", // id rate
		"idUser", // user concerne
		"promote", // appreciation
		"idUserLastPromote",
		"demote", // depreciation
		"idUserLastDemote",
		"ratio"
	];

	public function __construct(){
		parent::__construct();
	}

	public function getId() {
		return $this->id;
	}

	public function getIdUser(){
		return $this->idUser;
	}

	public function getPromote(){
		return $this->promote;
	}
	
	public function getIdUserLastPromote(){
		return $this->idUserLastPromote;	
	}

	public function getDemote(){
		return $this->demote;
	}

	public function getIdUserLastDemote(){
		return $this->idUserLastDemote;	
	}

	public function getRatio(){
		return $this->ratio;
	}

	public function setIdUser($idUser){
		$this->idUser = $idUser;
	}

	public function setPromote($promote){
		$this->promote = $promote;
	}

	public function setDemote($demote){
		$this->demote = $demote;
	}

	public function setRatio($ratio){
		$this->ratio = $ratio;
	}

	public function getForm($formType){

		$form = [];
		if ($formType == "rating") {
			$form = [
				"title" => "rating",
				"buttonTxt" => "",
				"options" => ["method" => "POST", "action" => WEBROOT],
				"struct" => [
					"promote"=>[ "type"=>"submit", "class"=>"btn btn-primary", "value"=>"promote", "placeholder"=>"", "required"=>0, "msgerror"=>"vote" 
					],
					"demote"=>[ "type"=>"submit", "class"=>"btn btn-primary", "value"=>"demote", "placeholder"=>"", "required"=>0, "msgerror"=>"vote" 
					],
					"ratio"=>[ "type"=>"text", "class"=>"", "value"=> $this->getRatio(), "placeholder"=>"", "required"=>0, "disabled"=>1, "msgerror"=>"vote"
					],
					"form-type" => ["type" => "hidden", "value" => "ratingForm", "placeholder" => "", "required" => 0, "msgerror" => "hidden_input", "class" => ""
					]
				]
			];
		}

		return $form;
	}

	public static function rating(){
		var_dump($_POST);
		
		if(isset($_POST['promote'])){
			
			$user = new User();
			$id = $user->getId();

			$rate = new Rating();
			
			$rate->setIdUser($id);
			

			$promote = $rate->getPromote();
			$newPromote =  $promote + 1;

			$demote = $rate->getDemote();

			$ratio = $promote / $demote;

			$rate->setRatio($ratio);

			$rate->setPromote($newPromote);
			$rate->save();

			return True;
		}else{
			echo "tepu";
		}
	}
	

}

?>