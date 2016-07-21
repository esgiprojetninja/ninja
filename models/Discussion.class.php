<?php

class Discussion extends basesql {
    protected $id;
    protected $table = "discussions";
    protected $pivotTable = "discussions_users_pivot";
    protected $people = [];
    protected $columns = [
        "id"
    ];


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
     * Set people.
     * @param array $ppl
     */
    public function setPeople($ppl) {
        $this->people = $ppl;
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
     * Get people from DB and set attribute
     * @return array
     */
    public function gatherPeople() {
        $pivot = new ManyToManyPivot(
            $this->pivotTable,
            "discussion",
            "user",
            $this->id
        );
        return $pivot->getData();
    }

    /**
     * For each people, save a pivot table.
     */
    public function savePeople() {
        foreach ($this->people as $userId) {
            $pivot = new ManyToManyPivot(
                $this->pivotTable,
                "discussion",
                "user",
                $this->id,
                $userId
            );
            $pivot->save();
        }
    }

    /**
     * Save people then save.
     */
    public function save() {
        if (count($this->people) > 0) {
            $this->savePeople();
        }
        $this->id = parent::save();
    }

    /**
     * Return form structure.
     * @param string $formType
     * @return array
     */
    public function getForm($formType) {

        $form = [];

        if ($formType == "createDiscussion") {
            $form = [
				"title" => "Create a discussion",
				"buttonTxt" => "Create",
				"options" => ["method" => "POST", "action" => WEBROOT . "inbox/createDiscussion", "class" => "ajax-form js-create-discussion", "data-attributes" => ["callback"=>"discussions"]],
				"struct" => [
					"username"=>[ "type"=>"username", "class"=>"form-control", "placeholder"=>"Username", "required"=>1, "msgerror"=>"username_doesnt_exists" ],
					"form-type" => ["type" => "hidden", "value" => "createDiscussion", "placeholder" => "", "required" => 0, "msgerror" => "hidden input", "class" => ""]
				]
			];
        }

        return $form;
    }
}
