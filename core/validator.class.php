<?php
class Validator extends basesql{
	public function __construct(){

	}

	public static function check($struct, $data){
		$listErrors = [];
		foreach ($struct as $name => $options) {
			if($options["required"] && self::isEmpty($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["type"]=="password" && !self::passwordCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["type"]=="email" && !self::emailCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="username" && !self::existUsername($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="teamName" && !self::verifTeamName($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
		}
		return $listErrors;
	}


	public static function isEmpty($var){
		return empty(trim($var));
	}


	public static function passwordCorrect($var){
		return !( strlen($var)<8 || strlen($var)>12 ||
					!preg_match("/[0-9]/", $var) ||
					!preg_match("/[a-z]/", $var) ||
					!preg_match("/[A-Z]/", $var) );	
	}

	public static function emailCorrect($var){
		return !((filter_var($var,FILTER_VALIDATE_EMAIL)) && (User::findBy("email", $var, "string")) );	
	}

	public static function existUsername($var){
		return !(User::findBy("username",$var,"string"));
	}

	public static function verifTeamName($var){
		return !((Team::findBy("teamName",$var,"string")) && !(strlen($var)<4 || strlen($var)>30));
	}
}







