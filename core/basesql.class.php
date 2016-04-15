<?php

class basesql extends PDO
{

	private $table;
	private $columns = [];
	private $pdo;

	public function __construct()
	{
		$dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
		try{
			$this->pdo = new PDO($dsn,DBUSER,DBPWD);
		}catch(Exception $e){
			die("Erreur SQL:".$e->getMessage());
		}

		//$this->table = get_called_class();
		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars, $class_vars));
	}


	public function setTable($table) {
		$this->table = $table;
	}

	public function findById($id) {
		$sql = "SELECT * FROM ".$this->table;
		if (is_numeric($id)) {
			$sql = $sql." WHERE id=".$id.";";
			$query =  $this->pdo->prepare($sql);
			$query->execute();
			$item = $query->fetch(PDO::FETCH_ASSOC);
			foreach ($item as $column => $value) {
				$this->$column = $value;
			}
		} else {
			$sql = $sql.";";
			return $query = $this->pdo->execute($sql);
		}
	}

	/**
	* Assign data from db to current object
	* @return bolean
	* @param $column string
	* @param $value string or numeric
	* @param $valueType string
	*/
	public function findBy($column, $value, $valueType) {
		$sql = "SELECT * FROM "
			.$this->table." WHERE "
			.$column;
		if ($valueType == "string") {
			$sql = $sql."='".$value."';";
		}
		else if ($valueType == "int") {
			$sql = $sql."=".$value.";";
		}
		$query = $this->pdo->prepare($sql);
		$query->execute();
		$item = $query->fetch(PDO::FETCH_ASSOC);
		if($item) {
			foreach ($item as $column => $value) {
				$this->$column = $value;
			}
			return True;
		}
		else {
			return False;
		}
	}

	public function save()
	{
		if (is_numeric($this->id)) {
			$sql = "UPDATE ".$this->table." SET ";
			$len = count($this->columns);
			$i = 0;
			foreach ($this->columns as $colmun) {
				if ($i == $len - 1) {
					$sql = $sql.$colmun."=:".$colmun;
				} else {
					$sql = $sql.$colmun."=:".$colmun.",";
				}
				$i ++;
			}
			$sql = $sql." WHERE id=".$this->id;
			$stmt = $this->pdo->prepare($sql);
			foreach ($this->columns as $column) {
				$stmt->bindValue(":".$column, $this->$column);
			}
			$stmt->execute();
		}
		else
		{
			$sql = "INSERT INTO ".$this->table." (".implode(",",$this->columns).")
					VALUES (:".implode(",:",$this->columns).")";

			$query = $this->pdo->prepare($sql);
			foreach ($this->columns as $column) {
				$data[$column] = $this->$column;
			}


			try {
				$query->execute($data);
			} catch (Exception $e) {
				die("Error while saving user: ".$e->getMessage());
			}
		}
	}
}
