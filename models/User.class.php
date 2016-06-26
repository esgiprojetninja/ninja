<?php

class User extends basesql
{

	public $id; //passage en public, afin de pouvoir dans le validator vérifier que l'utilisateur ne fasse pas partie de la team
	protected $table = "users";
	protected $email = "";
	protected $token = "";
	protected $is_active = 0;
	protected $password = "";
	protected $username = "";
	protected $first_name = "";
	protected $last_name = "";
	protected $phone_number = 0;
	protected $favorite_sports = "";
	protected $city = "";
	protected $birthday;
	protected $avatar = "";
	protected $dateCreated;
	protected $discussionPivotTable = "discussions_users_pivot";

	protected $columns = [
		"email",
		"token",
		"is_active",
		"password",
		"username",
		"first_name",
		"last_name",
		"phone_number",
		"avatar",
		"favorite_sports",
		"city",
		"birthday",
		"dateCreated"
	];


	/**
	* @param array
	* Init new user
	*/
	public function __construct(){
		parent::__construct();
	}

	public function getId() {
		return $this->id;
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

	public function getIsActive() {
		return $this->is_active;
	}

	public function getCity(){
		return $this->city;
	}

	public function getBirthday(){
		return $this->birthday;
	}

	public function getAvatar(){
		return $this->avatar;
	}

	public function getDateCreated() {
		return $this->dateCreated;
	}

	public function setIsActive($is_active) {
		$this->is_active = $is_active;
	}

	public function setUsername($username){
		$this->username = htmlspecialchars($username);
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setPassword($password){
		$this->password = crypt($password, SALT);
	}

	public function setFirstName($first_name){
		$this->first_name = htmlspecialchars($first_name);
	}

	public function setLastName($last_name){
		$this->last_name = htmlspecialchars($last_name);
	}

	public function setPhoneNumber($phone_number){
		$this->phone_number = $phone_number;
	}

	public function SetFavoriteSports($favorite_sports){
		$this->favorite_sports = $favorite_sports;
	}

	public function setCity($city){
		$this->city = $city;
	}

	public function setBirthday($birthday){
		$this->birthday = $birthday;
	}

	public function setAvatar($avatar){
		$this->avatar = $avatar;
	}

	public function setDateCreated($dateCreated) {
		$this->dateCreated = $dateCreated;
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

	/**
	* Check user token and assign user to session
	* @return boolean
	*/
	public static function isConnected() {
		if(!isset($_SESSION["user_id"])) {
			return False;
		}
		$user = self::findById(intVal($_SESSION["user_id"]));
		if ($_SESSION["user_token"] === $user->getToken()) {
			$user->setToken();
			$user->save();
			$token = $user->getToken();
			$_SESSION["user_token"] = $token;
			return True;
		}
		else {
			return False;
		}
	}

	/**
	* Send confirmation email using users's email
	* @return boolean
	*/
	public function sendEmail($typeMail) {
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
		
		if( $typeMail == "subscribe"){

			$mail->Subject = 'Welcome in Sport Nation World Wide';

			$link = WEBROOT."user/activate?email="
				.$this->email
				."&token="
				.$this->token."";

			$_SESSION['link_subscribe'] = $link;

			ob_start();
				include("views/subscribe_mail_html.php");
			$body = ob_get_clean();

			$mail->Body    = $body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			//$mail->send();
			if(!$mail->send()) {
					echo "<span class='info'> Message could not be sent. </span>";
					echo "<span class='info'> Mailer Error: " . $mail->ErrorInfo ."</span>";
					return FALSE;
			} else {
					return TRUE;
			}

		}else if( $typeMail == "reset"){
			
			$mail->Subject = 'Password reset';
			
			$link = WEBROOT."user/setNewPassword?email="
				.$this->email
				."&token="
				.$this->token."";

			$_SESSION['link_reset_pwd'] = $link;

			ob_start();
				include("views/resetpwd_mail_html.php");
			$body = ob_get_clean();


			$mail->Body    = $body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			//$mail->send();
			if(!$mail->send()) {
					echo "<span class='info'> Message could not be sent. </span>";
					echo "<span class='info'> Mailer Error: " . $mail->ErrorInfo . "</span>";
					return FALSE;
			} else {
					return TRUE;
			}
		}
	}

	/**
	* Form subscribe
	* @return array
	*/
	public function getForm($formType){

		$form = [];
		if ($formType == "subscription") {
			$form = [
				"title" => "Want to join the Nation ?",
				"buttonTxt" => "Sign Up",
				"options" => ["method" => "POST", "action" => WEBROOT . "user/subscribe"],
				"struct" => [
					"email"=>[ "type"=>"email", "class"=>"form-control", "placeholder"=>"Email", "required"=>1, "msgerror"=>"new_email" 
					],
					"username"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Username", "required"=>1, "msgerror"=>"new_username" 
					],
					"form-type" => ["type" => "hidden", "value" => "subscription", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""
					]
				]
			];
		}
		else if ($formType == "activation") {
			$form = [
				"title" => "Welcome back ! Please choose a password to activate your account.",
				"buttonTxt" => "Activate",
				"options" => ["method" => "POST", "action" => WEBROOT . "user/activate?email=".$this->getEmail()."&token=".$this->getToken()],
				"struct" => [
					"password"=>[ "type"=>"password", "class"=>"form-control", "placeholder"=>"Password", "required"=>1, "msgerror"=>"password" 
					],
					"confpassword"=>[ "type"=>"password", "class"=>"form-control", "placeholder"=>"Confirm your password", "required"=>1, "msgerror"=>"confirm_password" 
					],
					"form-type" => ["type" => "hidden", "value" => "activation", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""
					]
				]
			];
		}
		else if ($formType == "login") {
			$form = [
				"title" => "Already a sport citizen ?",
				"buttonTxt" => "Sign In",
				"options" => ["method" => "POST", "action" => WEBROOT . "user/login"],
				"struct"=>[
					"email"=>[ "type"=>"email", "class"=>"form-control", "placeholder"=>"Email", "required"=>1, "msgerror"=>"email" 
					],
					"password"=>[ "type"=>"password", "class"=>"form-control", "placeholder"=>"Password", "required"=>1, "msgerror"=>"password" 
					],
					"form-type" => ["type" => "hidden", "value" => "login", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""
					]
				]
			];
		} else if ($formType == "edit") {
			$form = [
				"title" => "Account params",
				"buttonTxt" => "Confirm",
				"options" => ["method" => "POST", "action" => WEBROOT . "user/edit/" . $this->id,"enctype"=>"multipart/form-data"],
				"struct"=>[
					"avatar"=>["type"=>"file","class"=>"form-control","placeholder"=>"Your avatar","required"=>0,"msgerror"=>"avatar","value"=>$this->getAvatar()
					],
					"email"=>[ "type"=>"email", "class"=>"form-control", "placeholder"=>"Email", "required"=>1, "msgerror"=>"", "value" => $this->getEmail()
					],
					"username"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Username", "required"=>1, "msgerror"=>"username", "value" => $this->getUsername()
					],
					"first_name"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"First name", "required"=>1, "msgerror"=>"first_name", "value" => $this->getFirstName()
					],
					"last_name"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Last name", "required"=>1, "msgerror"=>"last_name", "value" => $this->getLastName()
					],
					"favorite_sports"=>[ "type"=>"select", "class"=>"form-control", "placeholder"=>"Favorite sports", "required"=>0, "msgerror"=>"favorite_sports", "value" => $this->getFavoriteSports()
					],
					"phone_number"=>[ "type"=>"number", "class"=>"form-control", "placeholder"=>"Phone number", "required"=>1, "msgerror"=>"phone_number", "value" => $this->getPhoneNumber()
					],
					"form-type" => ["type" => "hidden", "value" => "edit", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""
					]
				]
			];
		} else if ($formType == "setNewPassword") {
			$form = [
				"title" => "Change password",
				"buttonTxt" => "Confirm",
				"options" => ["method" => "POST", "action" => WEBROOT . "user/setNewPassword/","enctype"=>"multipart/form-data"],
				"struct"=>[
					"password"=>[ "type"=>"password", "class"=>"form-control", "placeholder"=>"Password", "required"=>1, "msgerror"=>"password" 
					],
					"confpassword"=>[ "type"=>"password", "class"=>"form-control", "placeholder"=>"Confirm your password", "required"=>1, "msgerror"=>"confirm_password" 
					],
					"email" => ["type" => "hidden", "value" => "", "class" => "", "placeholder" => "", "required" => 1, "msgerror" => "hidden input"
					],
					"token" => ["type" => "hidden", "value" => "", "class" => "", "placeholder" => "", "required" => 1, "msgerror" => "hidden input"
					],
					"form-type" => ["type" => "hidden", "value" => "setNewPassword", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""
					]
				]
			];
		} else if ($formType == "resetPassword") {
			$form = [
				"title" => "Reset password",
				"buttonTxt" => "Confirm",
				"options" => ["method" => "POST", "action" => WEBROOT . "user/resetPassword/", "enctype"=>"multipart/form-data"],
				"struct"=>[
					"reset-email"=>[ "type"=>"email", "class"=>"form-control", "placeholder"=>"Email address", "required"=>1, "msgerror"=>"email_exist" 
					],
					"form-type" => ["type" => "hidden", "value" => "reset-passord", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""
					]
				]
			];
		}

		return $form;
	}

	public function getDiscussions() {
		$pivot = new ManyToManyPivot(
			$this->discussionPivotTable,
			"user",
			"discussion",
			$this->id
		);
		return $pivot->getData();
	}
}
