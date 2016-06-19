<?php

class Event extends basesql
{
    
    public $id;
    protected $table = "event";
    protected $name;
    protected $description;
    protected $content;
    protected $id_creator = 0;
    protected $date_creation;
    protected $date_event;
    protected $max_people;
    protected $current_people;
    protected $finish;
    protected $place;
    protected $sport;

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
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getIdCreator()
    {
        return $this->id_creator;
    }

    /**
     * @param int $id_creator
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
    public function getDateEvent()
    {
        return $this->date_event;
    }

    /**
     * @param mixed $date_event
     */
    public function setDateEvent($date_event)
    {
        $this->date_event = $date_event;
    }

    /**
     * @return mixed
     */
    public function getMaxPeople()
    {
        return $this->max_people;
    }

    /**
     * @param mixed $max_people
     */
    public function setMaxPeople($max_people)
    {
        $this->max_people = $max_people;
    }

    /**
     * @return mixed
     */
    public function getCurrentPeople()
    {
        return $this->current_people;
    }

    /**
     * @param mixed $current_people
     */
    public function setCurrentPeople($current_people)
    {
        $this->current_people = $current_people;
    }

    /**
     * @return mixed
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * @param mixed $finish
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param mixed $sport
     */
    public function setSport($sport)
    {
        $this->sport = $sport;
    }



}