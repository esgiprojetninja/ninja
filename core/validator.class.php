<?php
class Validator extends basesql{
	public function __construct(){

	}

	public static function check($struct, $data){
		$listErrors = [];
		foreach ($struct as $name => $options) {
			if($options["required"] && $options["type"]!="file" && self::isEmpty($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			else if($options["required"] && $options["type"]=="file" && self::isFileEmpty($_FILES[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="password" && !self::passwordCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="confirm_password" && !self::passwordCorrect($data[$name]) && self::passwordIdentical($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="new_email" && !self::newEmailCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="email" && !self::emailCorrect($data[$name])) {
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="new_username" && !self::existUsername($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="teamName" && !self::verifTeamName($data[$name]) && !self::existTeamName($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="emailOrUsername" && !self::verifUsernameOfEmail($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="new_teamName" && !self::verifTeamName($data[$name])){
				$listErrors[]=$options["msgerror"];
			}
			elseif($options["msgerror"]=="avatar"  && $options["type"]=="file"&& !self::verifAvatar($_FILES[$name])){
				$listErrors[]=$options["msgerror"];
			}
		}
		return $listErrors;
	}

	public static function verifAvatar($var){
		$sizeMax = 2097152;
		$extension = ["jpg","jpeg","gif","png"];
		$extensionUpload = strtolower(substr(strrchr($var['name'], '.'), 1));
		if($var['size'] > $sizeMax || $var['size'] == 0){
			return !($var['size'] <= $sizeMax || $var['size'] == 0);
		}else if(!in_array($extensionUpload, $extension)){
			return !(in_array($extensionUpload, $extension));
		}else{
			return TRUE;
		}
	}

	//fonciton de verif pour l'invitation par email ou username
	public static function verifUsernameOfEmail($var){
		if(!self::emailCorrect($var)){//Si email
			$idUser = User::findBy("email",$var,"string");
			return !(TeamHasUser::findBy(["idUser","idTeam"],[$idUser->id,$_SESSION['idTeam']],["string","int"]));
		}else{//Sinon pseudo
			$idUser = User::findBy("username",$var,"string");
			return !(TeamHasUser::findBy(["idUser","idTeam"],[$idUser->id,$_SESSION['idTeam']],["string","int"]));
		}
	}

	public static function isFileEmpty($var){
		return empty($var);
	}

	public static function isEmpty($var){
		return empty(trim($var));
	}

	public static function passwordIdentical($var){
		return !(strcmp($var, $_SESSION['passwordValidator']));
	}

	public static function passwordCorrect($var){
		$_SESSION['passwordValidator'] = $var; 
// on stocke le mdp avant de vérifier qu'il soit identique au mot de passe de conf,
// pas d'inquietude, la session est detruite a la fin du processus d'activation
		return !( strlen($var)<8 || strlen($var)>12 ||
					!preg_match("/[0-9]/", $var) ||
					!preg_match("/[a-z]/", $var) ||
					!preg_match("/[A-Z]/", $var) );	
	}

	public static function emailCorrect($var){
		return !(filter_var($var,FILTER_VALIDATE_EMAIL));	
	}

	public static function newEmailCorrect($var){
		return !((filter_var($var,FILTER_VALIDATE_EMAIL)) && (User::findBy("email", $var, "string")) );	
	}

	public static function existUsername($var){
		return !(User::findBy("username",$var,"string"));
	}

	public static function verifTeamName($var){
		return !(strlen($var)<4 || strlen($var)>30);
	}

	public static function existTeamName($var){
		return !(Team::findBy("teamName",$var,"string"));
	}

}







