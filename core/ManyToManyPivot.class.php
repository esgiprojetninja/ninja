<?php

class ManyToManyPivot {

    private $pdo;
    protected $table;
    protected $idOne;
    protected $idTwo;
    protected $entityOne;
    protected $entityTwo;
    protected $tableOne;
    protected $tableTwo;
    protected $columnOne;
    protected $columnTwo;


    /**
     * Set db access instance and attributes
     * @param string $table
     * @param int $idOne
     * @param int $idTwo
     * @param string $entityOne
     * @param string $entityTwo
     */
    public function __construct(
        $table,
        $entityOne,
        $entityTwo,
        $idOne,
        $idTwo = null) {

            $this->table = $table;
            $this->idOne = $idOne;
            $this->idTwo = $idTwo;
            $this->entityOne = $entityOne;
            $this->entityTwo = $entityTwo;
            $this->tableOne = $entityOne . "s";
            $this->tableTwo = $entityTwo . "s";
            $this->columnOne = $entityOne . "_id";
            $this->columnTwo = $entityTwo . "_id";

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
     * Return array of linked data.
     * @return array
     */
    public function getData() {
        $sql = "SELECT "  . $this->tableTwo . ".*, group_concat(" .
        $this->tableOne . ".id) as " . $this->entityOne . "_id FROM " .
        $this->tableTwo . " LEFT JOIN " . $this->table . " on " . $this->table .
        "." .$this->columnTwo . " = " . $this->tableTwo . ".id LEFT JOIN " .
        $this->tableOne . " on " .$this->table . "." .$this->columnOne . " = " .
        $this->tableOne . ".id GROUP BY " . $this->tableTwo . ".id";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($result); $i++) {
            $subItemsIds = split(",", $result[$i][$this->entityOne . "_id"]);
            foreach ($subItemsIds as $subItemId) {
                $sql = "SELECT * FROM " . $this->tableOne . " WHERE id = " .
                $subItemId;
                $query = $this->pdo->prepare($sql);
                $query->execute();
                $result[$i][$this->tableOne][] = $query->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }
}
