<?php
class User extends basesql
{

	protected $id;
	protected $email;
	protected $token;
	protected $is_active;
	protected $password;
	protected $username;
	protected $first_name;
	protected $last_name;
	protected $phone_number;
	protected $favorite_sports;


	/**
	* @param array
	* Init new user
	*/
	public function __construct(){
		parent::__construct();
		$this->setTable("users");
		$this->setToken();
	}

	public function getUsername(){
		return $this->username;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getFirstName(){
		return $this->first_name;
	}

	public function getLastName(){
		return $this->last_name;
	}

	public function getPhoneNumber(){
		return $this->phone_number;
	}

	public function getFavoriteSports(){
		return $this->favorite_sports;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setFirstName($first_name){
		$this->first_name = $first_name;
	}

	public function setLastName($last_name){
		$this->last_name = $last_name;
	}

	public function setPhoneNumber($phone_number){
		$this->phone_number = $phone_number;
	}

	public function SetFavoriteSports($favorite_sports){
		$this->favorite_sports = $favorite_sports;
	}

	/**
	* @return string
	*/
	public function getToken() {
		return $this->token;
	}

	/**
  * Creates token based on username and email
  */
	public function setToken() {
	    $this->token = md5(
				$this->email.$this->username.SALT.date("YmdHis")
			);
	}

	public static function toto($toto) {
		$this->username = $toto;
	}

	public static function find($id) {
			$self = new static();
			$user = $self->findById($id);
			return $user;
	}

	/**
	* Send confirmation email using users's email
	* @return boolean
	*/
	public function sendConfirmationEmail() {
		try {
				require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
		} catch(Execption $e) {
			die("Unable to load phpmailer : ".$e->getMessage());
		}
		$mail = new PHPMailer();

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'testmail3adw@gmail.com';                 // SMTP username
		$mail->Password = 'test3ADW';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('SportNation@WorldWide', 'Sport Nation Babe');
		$mail->addAddress($this->email);     // Add a recipient
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Welcome in Sport Nation World Wide';
		$link = "http://ninja.dev/user/activate?email="
			.$this->email
			."&token="
			.$this->token."";
		$mail->Body    = 'Click the following link to validate your registration : '. $link;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		//$mail->send();
		if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				return FALSE;
		} else {
				return TRUE;
		}
	}
}
