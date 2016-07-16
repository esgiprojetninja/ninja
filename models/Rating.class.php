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
		"id_for", // user pour qui je vote
		"type", // promote or demote
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
				"options" => ["method" => "POST", "action" => WEBROOT
				],
				"struct" => [
					"promote"=>[ "type"=>"submit", "class"=>"btn btn-primary", "value"=>$promote, "placeholder"=>"", "required"=>0, "msgerror"=>"vote" 
					],
					"demote"=>[ "type"=>"submit", "class"=>"btn btn-primary", "value"=>$demote, "placeholder"=>"", "required"=>0, "msgerror"=>"vote" 
					],
					"form-type" => ["type" => "hidden", "value" => "ratingForm", "placeholder" => "", "required" => 0, "msgerror" => "hidden_input", "class" => ""
					]
				]
			];
		}

		return $form;
	}

	public static function rating(){

        if( User::isConnected()){
            if(isset($_POST['promote'])){

            	$userToPromote = User::findById($_SESSION['user_id']);

            	$userPromote = $_POST['promote'];

            	self::setIdUser($userToPromote);
            	self::setIdFor($userPromote);
				// var_dump($userToPromote);
				// var_dump($userPromote);

        	}else if(isset($_POST['demote'])){

        	}
        
    	}
	}
	

}

