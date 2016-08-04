<?php

class Articles extends basesql
{

    public $id;
    protected $table = "notifications";
    public $id_user;
    public $datetime;
    public $type;
    public $opened = 0;
    public $message = "";
    public $action;

    protected $columns = [
        "id",
        "id_user",
        "datetime",
        "type",
        "opened",
        "message",
        "action"
    ];

    //Oui
    public function __construct(){
        parent::__construct();
    }

    //Getteurs
    public function getId() {
        return $this->id;
    }
    public function getId_user() {
        return $this->id_user;
    }
    public function getDatetime() {
        return $this->datetime;
    }
    public function getType() {
        return $this->type;
    }
    public function getOpened() {
        return $this->opened;
    }
    public function getMessage() {
        return $this->message;
    }
    public function getAction() {
        return $this->action;
    }

    //Setteurs
    public function setId($id) {
        $this->id = $id;
    }
    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }
    public function setDatetime($datetime) {
        $this->datetime = $datetime;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function setOpened($opened) {
        $this->opened = $opened;
    }
    public function setMessage($message) {
        $this->message = $message;
    }
    public function setAction($action) {
        $this->action = $action;
    }

    public static function createNotification($id_user,$message,$action)
    {

        $notification = new Notification();

        $notification->setId_user($id_user);
        $notification->setDatetime(date("Y-m-d H:i:s"));
        $notification->setType(1);
        $notification->setOpened(0);
        $notification->setMessage($message);
        $notification->setAction($action);

        $notification->save();

    }

}
