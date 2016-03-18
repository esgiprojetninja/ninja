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

	function createToken($email)
	{
		if(isset($email)){
		    $token = md5($email . SALT . date("YmdHis"));
		    return $token;
		}
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

	public function sendMail($email,$access_token)
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
		$link = "http://ninja.dev:8888/user/validation?email=".$email."&access_token=".$access_token."";
		$mail->Body    = 'Click the following link to validate your registration : '. $link;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		/*if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}*/
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
