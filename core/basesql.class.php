<?php

class basesql extends PDO
{

	private $columns = [];
	private $pdo;

	public function __construct()
	{
		$dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
		try{
			$this->pdo = new PDO($dsn,DBUSER,DBPWD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(Exception $e){
			die("Erreur SQL:".$e->getMessage());
		}

		//$this->table = get_called_class();
		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars, $class_vars));

		// Unsetting "table" attribute
		if(($key = array_search("table", $this->columns)) !== false) {
		    unset($this->columns[$key]);
		}
	}

	public static function findById($id) {
		$instance = new static;
		$sql = "SELECT * FROM ".$instance->table;
		if (is_numeric($id)) {
			$sql = $sql." WHERE id=".$id.";";
			$query =  $instance->pdo->prepare($sql);
			$query->execute();
			$item = $query->fetch(PDO::FETCH_ASSOC);
			foreach ($item as $column => $value) {
				$instance->$column = $value;
			}
			return $instance;
		} else {
			return False;
		}
	}

	/**
	* Assign data from db to current object
	* @return bolean
	* @param $column string
	* @param $value string or numeric
	* @param $valueType string
	*/
	public static function findBy($column, $value, $valueType) {
		$instance = new static;
		$sql = "SELECT * FROM "
			.$instance->table." WHERE "
			.$column;
		if ($valueType == "string") {
			$sql = $sql."='".$value."';";
		}
		else if ($valueType == "int") {
			$sql = $sql."=".$value.";";
		}
		$query = $instance->pdo->prepare($sql);
		$query->execute();
		$item = $query->fetch(PDO::FETCH_ASSOC);
		if($item) {
			foreach ($item as $column => $value) {
				$instance->$column = $value;
			}
			return $instance;
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
			foreach ($this->columns as $column) {
				if ($i == $len - 1) {
					$sql = $sql.$column."=:".$column;
				} else {
					$sql = $sql.$column."=:".$column." ,";
				}
				$i ++;
			}
			$sql = $sql." WHERE id=".$this->id;
			$stmt = $this->pdo->prepare($sql);
			foreach ($this->columns as $column) {
				$stmt->bindValue(":".$column, $this->$column);
			}
			try {
				$stmt->execute();
			} catch (Exception $e) {
				die("Eerror : ".$e->getMessage());
			}
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
