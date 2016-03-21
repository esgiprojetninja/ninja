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
			return $query->fetch();
		} else {
			$sql = $sql.";";
			return $query = $this->pdo->execute($sql);
		}
	}

	public function save()
	{
		if (is_numeric($this->id)) {
			$sql = "UPDATE ".$this->table." SET ".implode(
				"=:".$this->columns.",", $this->columns
			);
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
