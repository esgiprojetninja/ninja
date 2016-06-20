<?php

class Message extends basesql {

    protected $id;
    protected $table = "messages";
    protected $sender_id;
    protected $content;
    protected $date;
    protected $discussion_id;

    /**
     * Init parent, good for db candies
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
     * @return int
     */
    public function getSenderId() {
        return $this->sender_id;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @return datetime
     */
    public function getDate() {
        return $this->$date;
    }

    /**
     * @return int
     */
    public function getDiscussionId() {
        return $this->discussion_id;
    }

    /**
     * @param int
     */
    public function setSenderId($sender_id) {
        if (is_numeric($sender_id)) {
            $this->sender_id = $sender_id;
        }
    }

    /**
     * Set date to now
     */
    public function setDate() {
        $this->date = date("Y-m-d H:i:s");
    }

    /**
     * Set message content.
     * @param string $content
     */
    public function setContent($content) {
        $this->content = htmlspecialchars($conten);
    }

    /**
     * Set Discussion id.
     * @param int $discussion_id
     */
    public function setDiscussionId($discussion_id) {
        $thi->discussion_id = $discussion_id;
    }
}
