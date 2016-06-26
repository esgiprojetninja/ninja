<?php

require_once "models/User.class.php";


class adminController
{
    public function indexAction($args)
    {
        $view = new View;
        $view->setView("admin/ui-collection.tpl");
    }

    public function testAction($args)
    {
        echo 'lol';
    }

    # Create database
    public function createdbAction($args) {
       $pdo = new PDO("mysql:host=".DBHOST,DBUSER,DBPWD);

       try {
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `".DBNAME."`;");
       }catch(Execption $e) {
            die("Error while creating database : ".$e->getMessage());
       }

       header("location: ".WEBROOT."admin/initdb");
    }

    # Create tables
    public function initdbAction($args) {

        $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);

        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS users(
                    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    email VARCHAR(50),
                    conf_email VARCHAR(50),
                    password VARCHAR(100),
                    username VARCHAR(50),
                    first_name VARCHAR(50),
                    last_name VARCHAR(50),
                    phone_number int(20),
                    city VARCHAR(50),
                    access_token VAARCHAR(50),
                    favorite_sports LONGTEXT
                );"
            );
        } catch (Execption $e) {
            die("Error while creating table user : ".$e->getMessage());
        }

        $admin = new User();
        $admin->setUsername("Admin");
        $admin->setEmail("admin@admin.admin");
        $admin->save();

        echo DBNAME;

    }


    # Delete db
    # Use with caution
    public function deletedbAction($args) {
        $pdo = new PDO("mysql:host=".DBHOST,DBUSER,DBPWD);
    }
    

    public function showUiKitAction() {
        $view = new View;
        $view->setView("admin/ui-collection.tpl");
    }
}