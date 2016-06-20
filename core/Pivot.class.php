<?php

class Pivot {

    private $pdo;
    protected $table;
    protected $idOne;
    protected $idTwo;
    protected $columnOne;
    protected $columnTwo;


    /**
     * Set db access instance and attributes
     * @param string $table
     * @param int $idOne
     * @param int $idTwo
     * @param string $columnOne
     * @param string $columnTwo
     */
    public function __construct(
        $table,
        $idOne,
        $idTwo,
        $columnOne,
        $columnTwo) {

            $this->table = $table;
            $this->idOne = $idOne;
            $this->idTwo = $idTwo;
            $this->columnOne = $columnOne;
            $this->columnTwo = $columnTwo;

            $dns = "mysql:host=".DBHOST.";dbname=".DBNAME;
            try{
    			$this->pdo = new PDO($dsn,DBUSER,DBPWD);
    			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		}catch(Exception $e){
    			die("Erreur SQL:".$e->getMessage());
    		}
    }

    public function save() {
        $sql = "INSERT INTO " . $this->table . " (" .
        $this->columnOne . "," . $this->columnTwo . ") VALUE (" .
        $this->idOne . "," . $this->idTwo . ");";

        $this->pdo->exec($sql);
    }
}
