<?php

class Rate extends basesql {

    protected $id;
    protected $table = "rates";
    protected $user_id;
    protected $voter_id;
    protected $rate;

    protected $columns = [
		"user_id",
        "voter_id",
        "rate"
	];

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getVoterId() {
        return $this->voter_id;
    }

    public function setVoterId($id) {
        $this->voter_id = $id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($id) {
        $this->user_id = $id;
    }

    public function getRate() {
        return $this->rate;
    }

    public function setRate($rate) {
        $this->rate = $rate;
    }


}
