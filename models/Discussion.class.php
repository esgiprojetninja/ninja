<?php

class Discussion extends basesql {
    protected $id;
    protected $table = "discussions";
    protected $pivotTable = "discussions_users_pivot";
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
        if (User::isConnected()) {
            if (is_numeric($id) && !in_array($id, $this->people)) {
                $this->people[] = $id;
            } else {
                throw new Exception("Bad data type or user already in conversation", 1);
            }
        }
    }


    /**
     * For each people, save a pivot table.
     */
    public function savePeople() {
        foreach ($this->people as $userId) {
            $pivot = new Pivot(
                $this->pivotTable,
                $this->id,
                $userId,
                "discussion_id",
                "user_id"
            );
            $pivot->save();
        }
    }
}
