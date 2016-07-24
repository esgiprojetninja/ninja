<?php

//Pourquoi un modèle pour une table de liaison? Malheureusement avec le code actuel, si je peux afficher ou récupérer des infos
// de cette table je suis obligé de créer des instances différentes propre à ma table, du coups c'est plus simple de créer cette
// classe pour réutiliser les fonctions existantes.

class Comment extends basesql
{
	protected $id;
	protected $table = "comment";
	protected $comment;
	protected $date_created;
  protected $id_author;
	protected $columns = [
		"id",
		"comment",
		"date_created",
    "id_author"
	];

	public function __construct(){
		parent::__construct();
	}

	public function getId() {
		return $this->id;
	}

	public function getIdComment(){
		return $this->comment;
	}

	public function getDateCreated() {
		return $this->date_created;
	}

  public function getIdAuthor(){
    return $this->id_author;
  }


	public function setId($id) {
		$this->id = $id;
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function setDateCreated($date_created){
		$this->date_created = $date_created;
	}

  public function setIdAuthor($id_author){
    $this->id_author = $id_author;
  }

}
