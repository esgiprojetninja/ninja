<?php

class OneToManyPivot {

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
        $columnOne,
        $columnTwo,
        $idOne,
        $idTwo = null) {

            $this->table = $table;
            $this->idOne = $idOne;
            $this->idTwo = $idTwo;
            $this->columnOne = $columnOne;
            $this->columnTwo = $columnTwo;

            $dns = "mysql:host=".DBHOST.";dbname=".DBNAME;
            try{
    			$this->pdo = new PDO($dns,DBUSER,DBPWD);
    			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		}catch(Exception $e){
    			die("Erreur SQL:".$e->getMessage());
    		}
    }

    /**
     * Save a new row in pivot table if not exists.
     */
    public function save() {
        $sql = "INSERT IGNORE INTO " . $this->table . " (" .
        $this->columnOne . "," . $this->columnTwo . ") VALUE (" .
        $this->idOne . "," . $this->idTwo . ");";

        $this->pdo->exec($sql);
    }

    /**
     * Return array of data.
     * @return array
     */
    public function getData() {
        $sql = "SELECT " . $this->columnTwo . " FROM " . $this->table .
        " WHERE " . $this->columnOne . " = " . $this->idOne;
        $query = $this->pdo->prepare($sql);
        return $query->fetch();
    }
}
