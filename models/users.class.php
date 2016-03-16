<?php
class users extends basesql
{

	protected $email;
	protected $password;
	protected $first_name;
	protected $last_name;
	protected $phone_number;
	protected $favorite_sports;

	public function __construct(){
		parent::__construct();
	}	

	public function getEmail(){
		return $this->email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getFirstName(){
		return $this->first_name;
	}

	public function getLastName(){
		return $this->last_name;
	}

	public function getPhoneNumber(){
		return $this->phone_number;
	}

	public function getFavoriteSports(){
		return $this->favorite_sports;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setFirstName($first_name){
		$this->first_name = $first_name;
	}

	public function setLastName($last_name){
		$this->last_name = $last_name;
	}

	public function setPhoneNumber($phone_number){
		$this->phone_number = $phone_number;
	}

	public function SetFavoriteSports($favorite_sports){
		$this->favorite_sports = $favorite_sports;
	}
}