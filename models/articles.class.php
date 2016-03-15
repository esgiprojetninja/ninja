<?php 
class articles extends basesql
{
	protected $id;
	protected $title;
	protected $content;

	public function __construct()
	{
		parent::__construct();
	}


	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}


	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getContent()
	{
		return $this->content;
	}
}