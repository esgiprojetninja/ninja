<?php

class Notification extends basesql
{

	public $id;
	protected $table = "notifications";
	protected $id_user;
	protected $datetime;
	protected $type;
	protected $opened = 0;
	protected $message = "";

	protected $columns = [
		"id",
		"id_user",
		"datetime",
		"type",
		"opened",
		"message"
	];

	//Oui
	public function __construct(){
		parent::__construct();
	}

	//Getteurs
	public function getId() {
		return $this->id;
	}
	public function getId_user() {
		return $this->id_user;
	}
	public function getDatetime() {
		return $this->datetime;
	}
	public function getType() {
		return $this->type;
	}
	public function getOpened() {
		return $this->opened;
	}
	public function getMessage() {
		return $this->message;
	}

	//Setteurs
	public function setId($id) {
		$this->id = $id;
	}
	public function setId_user($id_user) {
		$this->id_user = $id_user;
	}
	public function setDatetime($datetime) {
		$this->datetime = $datetime;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function setOpened($opened) {
		$this->opened = $opened;
	}
	public function setMessage($message) {
		$this->message = $message;
	}

	public static function createNotification($msg)
	{

		$notification = new Notification();

		$notification->setId_user($_SESSION['user_id']);
		$notification->setDatetime(date("Y-m-d H:i:s"));
		$notification->setType(1);
		$notification->setOpened(0);
		$notification->setMessage($msg);
		//$notification->setMessage('Notification');

		$notification->save();

	}
	
}
