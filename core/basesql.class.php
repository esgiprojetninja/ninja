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
								
			$query = $this->pdo->prepare($sql);
			foreach ($this->columns as $column) {
				$data[$column] = $this->$column;
			}
			
			//$data["id"] = 1;
			
			$query->execute($data);
		}
	}

	public function find($sql,$array = [], $fetchMode = PDO::FETCH_OBJ){
		$stmt = $this->pdo->prepare($sql);
		foreach($array as $key => $value){
			$stmt->bindValue($key, $value[0]);
		}
		$stmt->execute();
		return $stmt->fetchAll($fetchMode);
	}

	public function add($table, $data){

		ksort($data);

		$fieldNames = implode(',', array_keys($data));
		$fieldValues = ':'.implode(', :', array_keys($data));
		$stmt = $this->pdo->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");
		foreach($data as $key => $value){
			$stmt->bindValue(":$key", $value);
		}

		$stmt->execute();		

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
			$stmt->bindValue(":$key", $value);
		}

		foreach($where as $key => $value){
			$stmt->bindValue(":$key", $value[0]);
		}

		$stmt->execute();
	}

	public function delete($table, $where, $limit = 1)
	{

		ksort($where);

		$whereDetails = NULL;
		$i = 0;
		foreach($where as $key => $value){
			if($i == 0){
				$whereDetails .= "$key = :$key";
			} else {
				$whereDetails .= " AND $key = :$key";
			}
			
		$i++;}
		$whereDetails = ltrim($whereDetails, ' AND ');

		$stmt = $this->pdo->prepare("DELETE FROM $table WHERE $whereDetails LIMIT $limit");

		foreach($where as $key => $value){
			$stmt->bindValue(":$key", $value[0]);
		}

		$stmt->execute();

	}

	function createToken($user = [])
	{
	    return md5($user["id"] . $user["name"] . $user["email"] . SALT . date("Ymd"));
	}

	function logAuth($login,$pwd)
	{

	    $path_log = "log";
	    $name_file = "auth.txt";
	    //Est ce que le dossier existe
	    if (!file_exists($path_log)) {
	        //Si non il faut le créer
	        mkdir($path_log);
	    }
	    //On ouvre le fichier
	    //(s'il n'existe pas il faut le créer et écrire à la suite)
	    $handle = fopen($path_log . "/" . $name_file, "a");
	    //Ecrire dedans
	    fwrite($handle, $login . "  :  " . $pwd . "\r\n");
	    //Fermer le fichier
	    fclose($handle);
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

	public function sendMail($email)
	{
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer();

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'testmail3adw@gmail.com';                 // SMTP username
		$mail->Password = 'test3ADW';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('SportNation@WorldWide', 'Sport Nation Babe');
		$mail->addAddress($email);     // Add a recipient
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Welcome in Sport Nation World Wide';
		$mail->Body    = 'Click the following link to validate your registration : ';
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}

	public function emailExist($email)
	{
        if ($this->find("SELECT email FROM users WHERE email = :email",[':email'=>$email]) == FALSE){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
