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
}
