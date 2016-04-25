<?php

class User extends Model
{
    protected $table = "users";

    protected $email;
    protected $city;
    protected $token;
    protected $is_active;
    protected $password;
    protected $username;
    protected $first_name;
    protected $last_name;
    protected $phone_number;
    protected $favorite_sports;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setCity($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setBirthday($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Generate a token
     */
    public function setToken()
    {
        $this->token = md5(
            $this->email . $this->username . SALT . date("YmdHis")
        );
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param mixed $is_active
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getFavoriteSports()
    {
        return $this->favorite_sports;
    }

    /**
     * @param mixed $favorite_sports
     */
    public function setFavoriteSports($favorite_sports)
    {
        $this->favorite_sports = $favorite_sports;
    }


}