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
        protected $owner_name;
        protected $description;
        protected $location;
        protected $nb_people_max;

        protected $columns = [
            "id",
            "name",
            "from_date",
            "to_date",
            "joignable_until",
            "tags",
            "owner",
            "owner_name",
            "description",
            "location",
            "nb_people_max"
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
         * return owner_name attribute
         * @return string
         */
        public function getOwnerName() {
            return $this->owner_name;
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
         * return nb_people_max attribute
         * @return int
         */
        public function getNbPeopleMax() {
            return $this->nb_people_max;
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
        public function setName($name) {
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
         * Set owner_name attribute
         * @param string $id
         */
        public function setOwnerName($name) {
            $this->owner_name = $name;
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
         * Set nb_people_max attribute
         * @param int $max
         */
        public function setNbPeopleMax($max) {
            $this->nb_people_max = $max;
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
            if (is_numeric(intval($id))) {
                $pivot = new ManyToManyPivot(
                    $this->pivot_table,
                    "event",
                    "user",
                    $this->id,
                    intval($id)
                );
                $pivot->save();
            }
        }

        /**
         * return splitted tag list
         * @return [array]
         */
        public function getTagArray() {
            return split(",", $this->getTags());
        }

        /**
         * Serialize tags
         * @param  [array] $tags
         */
        public function serializeTags($tags) {
            if (is_array($tags)) {
                $this->setTags(join(",", $tags));
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
    				"options" => ["method" => "POST", "action" => WEBROOT . "event/create", "class" => "", "data-attributes" => []],
    				"struct" => [
    					"name"=>[ "type"=>"text", "class"=>"form-control", "placeholder"=>"Event Name", "required"=>1, "msgerror"=>"" ],
                        "description"=>[ "type"=>"textarea", "class"=>"form-control", "placeholder"=>"Event description", "required"=>0, "msgerror"=>"" ],
    					"from_date" => ["type" => "date", "placeholder" => "From date", "required" => 1, "msgerror" => "", "class" => "form-control"],
                        "from_time" => ["type" => "text", "placeholder" => "From Time", "required" => 1, "msgerror" => "", "class" => "form-control js-time-input"],
                        "to_date"=>[ "type"=>"date", "class"=>"form-control", "placeholder"=>"To date", "required"=>1, "msgerror"=>"" ],
                        "to_time" => ["type" => "text", "placeholder" => "To Time", "required" => 1, "msgerror" => "", "class" => "form-control js-time-input"],
                        "joignable_until" => ["type" => "date", "placeholder" => "Joignable until", "required" => 1, "msgerror" => "", "class" => "form-control"],
                        "joignable_until_time" => ["type" => "text", "placeholder" => "Joignable until time", "required" => 1, "msgerror" => "", "class" => "form-control js-time-input"],
                        "location" => ["type" => "text", "placeholder" => "Location", "required" => 1, "msgerror" => "", "class" => "form-control"],
                        "nb_people_max" => ["type" => "number", "placeholder" => "Max number of people", "required" => 1, "msgerror" => "", "class" => "form-control"],
                        "tags" => ["type" => "text", "placeholder" => "Tags", "required" => 1, "msgerror" => "", "class" => "form-control"],
    				]
    			];
            }

            return $form;
        }

    }
