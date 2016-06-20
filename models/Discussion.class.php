<?php

class Discussion extends basesql {
    protected $id;
    protected $table = "discussions";
    protected $people = [];


    /**
     * Init parent
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getPeople() {
        return $this->people;
    }

    /**
     * Add a new user id to people array
     * @param int
     */
    public function addUser($id) {
        if (is_numeric($id) && !in_array($id, $this->people)) {
            $this->people[] = $id;
        } else {
            throw new Exception("Bad data type or user already in conversation", 1);
        }
    }
}
