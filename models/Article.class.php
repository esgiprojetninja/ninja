<?php

class Article extends basesql
{

    public $id;
    protected $table = "articles";
    public $id_creator;
    public $date_creation;
    public $date_edited;
    public $type;
    public $title = "";
    public $message = "";
    public $is_visible;

    protected $columns = [
        "id",
        "id_creator",
        "date_creation",
        "date_edited",
        "type",
        "title",
        "message",
        "is_visible"
    ];

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

    //Oui
    public function __construct(){
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdCreator()
    {
        return $this->id_creator;
    }

    /**
     * @param mixed $id_creator
     */
    public function setIdCreator($id_creator)
    {
        $this->id_creator = $id_creator;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getDateEdited()
    {
        return $this->date_edited;
    }

    /**
     * @param mixed $date_edited
     */
    public function setDateEdited($date_edited)
    {
        $this->date_edited = $date_edited;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getIsVisible()
    {
        return $this->is_visible;
    }

    /**
     * @param mixed $is_visible
     */
    public function setIsVisible($is_visible)
    {
        $this->is_visible = $is_visible;
    }


}
