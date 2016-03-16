<?php

class users extends basesql {

	public function __construct(){
		parent::__construct();
	}	

	public function insert($data){
		$this->_db->insert("users",$data);
	}

	public function update($data,$where){
		$this->_db->update("users",$data,$where);
	}

	public function delete($id){
		$this->_db->delete("users", array('id' => $id));
	}
}