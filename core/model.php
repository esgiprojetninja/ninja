<?php

class Model
{
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            $this->pdo = new PDO($dsn, DBUSER, DBPWD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Erreur SQL:" . $e->getMessage());
        }
    }

    public function save()
    {
        var_dump($_POST);
        die();
        if (is_numeric($this->id)) {
            $sql = "UPDATE " . $this->table . " SET ";
            $len = count($this->columns);
            $i = 0;
            foreach ($this->columns as $column) {
                if ($i == $len - 1) {
                    $sql = $sql . $column . "=:" . $column;
                } else {
                    $sql = $sql . $column . "=:" . $column . " ,";
                }
                $i++;
            }
            $sql = $sql . " WHERE id=" . $this->id;
            $stmt = $this->pdo->prepare($sql);
            foreach ($this->columns as $column) {
                $stmt->bindValue(":" . $column, $this->$column);
            }
            try {
                $stmt->execute();
            } catch (Exception $e) {
                die("Error : " . $e->getMessage());
            }
        } else {
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", $this->columns) . ")
					VALUES (:" . implode(",:", $this->columns) . ")";
            $query = $this->pdo->prepare($sql);
            foreach ($this->columns as $column) {
                $data[$column] = $this->$column;
            }
            try {
                $query->execute($data);
            } catch (Exception $e) {
                die("Error while saving user: " . $e->getMessage());
            }
        }
    }
}
