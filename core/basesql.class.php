<?php 

class basesql
{

	private $table;
	private $columns = [];
	private $pdo;

	public function __construct()
	{		
		$dsn = "mysql:host=".DBHOST.";dmname=".DBHOST;
		try{
			$this->pdo = new PDO($dsn,DBUSER,DBPWD);

		}catch(Exception $e){
			die("Erreur SQL:".$e->getMessage());
		}
		
		$this->table = get_called_class();
		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars, $class_vars));
	}

	public function save()
	{
		if (is_numeric($this->id)) {
			# code...
		}
		else
		{
			$sql = "INSERT INTO ".$this->table." (".implode(",",$this->columns).")
					VALUES (:".implode(",:",$this->columns).")";
					
			//$sql = "INSERT INTO articles (id,title,content) VALUES (:id,:title,:content)";
					
			echo $sql;
			
			$query = $this->pdo->prepare($sql);
			foreach ($this->columns as $column) {
				$data[$column] = $this->$column;
			}
			
			//$data["id"] = 1;
			
			$query->execute($data);
			echo "<pre>";		
				print_r($data);
			echo "</pre>";
		}
	}
}
