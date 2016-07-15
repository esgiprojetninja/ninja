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
					"promote"=>[ "type"=>"submit", "class"=>"btn btn-primary", "value"=>User., "placeholder"=>"", "required"=>0, "msgerror"=>"vote" 
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
		
        if( User::isConnected() && !empty($args[0]) ){
            if(isset($_POST['promote'])){

            	$userWhoPromote = User::findById($arg[0]);

            	// ICI J'AIMERAIS trouver le user pour qui je vote grace au bouton : $_POST['promote'] = 'id_user_pour_qui_je_vote'
        		
				$noted = new Rating();
				$noted->setIdUser($args[0]);
				$noted->setType('promote');
				$noted->setIdFor('id_user_pour_qui_je_vote');
				$noted->save();
        	}else if(isset($_POST['demote'])){

        	}
        }else{

            header('Location:'.WEBROOT);
        }
    
	

}

?>