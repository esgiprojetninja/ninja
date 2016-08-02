<?php
class EventHasComment extends basesql
{
	protected $id;
	protected $table = "event_has_comment";
	protected $id_comment;
	protected $id_event;

	protected $columns = [
		"id",
		"id_comment",
		"id_event"
	];

	public function __construct(){
		parent::__construct();
	}

	public function getId() {
		return $this->id;
	}

	public function getIdComment(){
		return $this->id_comment;
	}

	public function getIdEvent() {
		return $this->id_event;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setIdComment($id_comment){
		$this->id_comment = $id_comment;
	}

	public function setIdEvent($id_event){
		$this->id_event = $id_event;
	}

}
