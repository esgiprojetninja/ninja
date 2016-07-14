<?php

class Rating extends basesql{
	
	protected $id;
	protected $table = "rating";
	protected $idUser;
	protected $idFor;
	protected $type;
	protected $date;

	protected $columns = [
		"id", // id row
		"id_user", // user connecte $id
		"id_for", // user connecte $idUser
		"type",
		"date"
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

	public function setType($type){
		$this->type = $type;
	}

	public function setDate($date){
		$this->date = $date;
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
					"form-type" => ["type" => "hidden", "value" => "ratingForm", "placeholder" => "", "required" => 0, "msgerror" => "hidden_input", "class" => ""
					]
				]
			];
		}

		return $form;
	}

	public static function rating(){
		var_dump($_POST);
		
		
    	if(User::isConnected() && !empty($args[0])){
			
			$user = self::findById($args[0]);

			if(isset($_POST['promote'])){
					
				$type = $_POST['promote'];

				$noted = new Rating();
				$noted->setIdUser(1);
				$noted->setIdFor(1);
				$noted->setType($type);
				$noted->save();

				return True;

			}else if(isset($_POST['demote'])){

				$type = $_POST['demote'];

				$noted = new Rating();
				$noted->setType(2);
				$noted->setIdFor(2);
				$noted->setType($type);
				$noted->save();

				return True;

			}else{
				echo "tepu";
			}
		}
	}
	

}

?>