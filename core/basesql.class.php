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

	public function find($sql,$array = [], $fetchMode = PDO::FETCH_OBJ){
		$stmt = $this->pdo->prepare($sql);

		foreach($array as $key => &$value){
			if(gettype($value) == "array"){
				$stmt->bindValue($key, $value[0]);
			}else{
				$stmt->bindValue($key, $value);
			}
		}
		$stmt->execute();
		return $stmt->fetchAll($fetchMode);
	}


	// TODO Carefully remove this
	public function add($table, $data){

		ksort($data);

		$fieldNames = implode(',', array_keys($data));
		$fieldValues = ':'.implode(', :', array_keys($data));
		$stmt = $this->pdo->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");
		foreach($data as $key => $value){
			if(gettype($value) == "array"){
				$stmt->bindValue($key, $value[0]);
			}else{
				$stmt->bindValue($key, $value);
			}
		}

		$stmt->execute();

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

			//$sql = "INSERT INTO articles (id,title,content) VALUES (:id,:title,:content)";


			$query = $this->pdo->prepare($sql);
			foreach ($this->columns as $column) {
				$data[$column] = $this->$column;
			}

			print_r("TABlE : ".$this->table);

			print_r($data);
			print_r($this->columns);
			//$data["id"] = 1;

			$query->execute($data);
			// try {
			// } catch (Exception $e) {
			// 	die("Error while saving user: ".$e->getMessage());
			// }
		}
	}

	public function update($table, $data, $where){
		ksort($data);

		$fieldDetails = NULL;
		foreach($data as $key => $value){
			$fieldDetails .= "$key = :$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');

		$whereDetails = NULL;
		$i = 0;
		foreach($where as $key => $value){
			if($i == 0){
				$whereDetails .= "$key = :$key";
			} else {
				$whereDetails .= " AND $key = :$key";
			}

			$i++;
		}
		$whereDetails = ltrim($whereDetails, ' AND ');

		$stmt = $this->pdo->prepare("UPDATE $table SET $fieldDetails WHERE $whereDetails");

		foreach($data as $key => $value){
			if(gettype($value) == "array"){
				$stmt->bindValue($key, $value[0]);
			}else{
				$stmt->bindValue($key, $value);
			}
		}

		foreach($where as $key => $value){
			if(gettype($value) == "array"){
				$stmt->bindValue($key, $value[0]);
			}else{
				$stmt->bindValue($key, $value);
			}
		}
		$stmt->execute();
	}

	public function delete($table, $where, $limit = 1)
	{

		ksort($where);

		$whereDetails = NULL;
		$i = 0;
		foreach($where as $key => &$value){
			if($i == 0){
				$whereDetails .= "$key = :$key";
			} else {
				$whereDetails .= " AND $key = :$key";
			}
			$i++;
		}
		$whereDetails = ltrim($whereDetails, ' AND ');

		$stmt = $this->pdo->prepare("DELETE FROM $table WHERE $whereDetails LIMIT $limit");

		foreach($where as $key => $value){
			if(gettype($value) == "array"){
				$stmt->bindValue($key, $value[0]);
			}else{
				$stmt->bindValue($key, $value);
			}
		}

		$stmt->execute();

	}

	function regenerateToken($user = [])
	{
		if(isset($user[0]->first_name) && isset($user[0]->email)){
			$data=[];
		    $token = md5($user[0]->first_name . $user[0]->email . SALT . date("YmdHis"));
		    $where = ['email' => $user[0]->email];
			$data['access_token'] = $token;
		    return $token;
		}
	}

	function isConnected()
	{
	    if (isset($_SESSION['token'], $_SESSION['id'])) {
	        $token = $_SESSION['token'];
	        $id = $_SESSION['id'];
	        $bdd = connectBdd();
	        $users = getUser($bdd, ['id' => $id]);
	        if (!empty($users)) {
	            $user = $users[0];
	            if ($token == createToken($user)) {
	                return true;
	            }
	        }
	    }
	    return false;
	}

	public function emailExist($email)
	{
        if ($this->find("SELECT email FROM users WHERE email = :email",[':email'=>$email]) == FALSE){
            return false;
        } else {
            return true;
        }
    }
}
