<?php

    class Event extends basesql {

        protected $id;
        protected $table = "events";
        protected $pivot_table = "events_users_pivot";
        protected $name;
        protected $from_date;
        protected $to_date;
        protected $joignable_until;
        protected $tags;
        protected $owner;
        protected $description;
        protected $location;

        protected $columns = [
            "id",
            "name",
            "from_date",
            "to_date",
            "joignable_until",
            "tags",
            "owner",
            "description",
            "location"
        ];


        /**
         * return id attribute
         * @return int
         */
        public function getId() {
            return $this->id;
        }

        /**
         * return name attribute
         * @return string
         */
        public function getName() {
            return $this->name;
        }

        /**
         * return from_date attribute
         * @return datetime
         */
        public function getFromDate() {
            return $this->from_date;
        }

        /**
         * return to_date attribute
         * @return datetime
         */
        public function getToDate() {
            return $this->to_date;
        }

        /**
         * return joignable_until attribute
         * @return datetime
         */
        public function getJoignableUntil() {
            return $this->joignable_until;
        }

        /**
         * return tags attribute
         * @return string
         */
        public function getTags() {
            return $this->tags;
        }

        /**
         * return users attribute
         * @return array
         */
        public function getUsers() {
            return $this->users;
        }

        /**
         * return owner attribute
         * @return int
         */
        public function getOwner() {
            return $this->owner;
        }

        /**
         * return description attribute
         * @return string
         */
        public function getDescription() {
            return $this->description;
        }

        /**
         * return location attribute
         * @return string
         */
        public function getLocation() {
            return $this->location;
        }

        /**
         * Set id attribute
         * @param int $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * Set name attribute
         * @param string $name
         */
        public function sesetNametId($name) {
            $this->name = $name;
        }

        /**
         * Set from_date attribute
         * @param datetime $date
         */
        public function setFromDate($date) {
            $this->from_date = $date;
        }

        /**
         * Set to_date attribute
         * @param datetime $date
         */
        public function setToDate($date) {
            $this->to_date = $date;
        }

        /**
         * Set joignable_until attribute
         * @param datetime $date
         */
        public function setJoignableUntil($date) {
            $this->joignable_until = $date;
        }

        /**
         * Set tags attribute
         * @param string $tags
         */
        public function setTags($tags) {
            $this->tags = $tags;
        }

        /**
         * Set owner attribute
         * @param int $id
         */
        public function setOwner($id) {
            $this->owner = $id;
        }

        /**
         * Set description attribute
         * @param string $description
         */
        public function setDescription($description) {
            $this->description = $description;
        }

        /**
         * Set location attribute
         * @param string $location
         */
        public function setLocation($location) {
            $this->location = $location;
        }

        /**
         * Return occurences of the relation
         * @return array of User
         */
        public function gatherUsers() {
            $pivot = new ManyToManyPivot(
                $this->pivot_table,
                "event_id",
                "user_id",
                $this->id
            );
            return $pivot->getData();
        }

        /**
         * Add user to event
         * @param [int] $id 
         */
        public function addUser($id) {
            if (is_numeric($id)) {
                $pivot = new ManyToManyPivot(
                    $this->pivot_table,
                    "event_id",
                    "user_id",
                    $this->id,
                    $id
                );
            }
        }

        /**
         * Return form structure.
         * @param string $formType
         * @return array
         */
        public function getForm($formType) {

            $form = [];

            if ($formType == "createEvent") {
                $form = [
    				"title" => "Create an event",
    				"buttonTxt" => "Create",
    				"options" => ["method" => "POST", "action" => WEBROOT . "inbox/createEvent", "class" => "", "data-attributes" => []],
    				"struct" => [
    					"name"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Event Name", "required"=>1, "msgerror"=>"" ],
                        "description"=>[ "type"=>"textarea", "class"=>"form-control", "placeholder"=>"Event description", "required"=>0, "msgerror"=>"" ],
    					"from_date" => ["type" => "date", "placeholder" => "From date", "required" => 1, "msgerror" => "", "class" => "form-control"],
                        "to_date"=>[ "type"=>"date", "class"=>"form-control", "placeholder"=>"To date", "required"=>1, "msgerror"=>"" ]
    				]
    			];
            }

            return $form;
        }

    }
