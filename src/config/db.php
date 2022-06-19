<?php

class db {
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPass = '';
    private $dbName = 'taaskin';

    public function dbConnect() {
        $mysqlConn = "mysql:host=$this->dbHost;dbname=$this->dbName";
        try{
            $dbConnex = new PDO($mysqlConn, $this->dbUser, $this->dbPass);
            $dbConnex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnex;
        }catch (PDOException $e){
            die('Error: ' . $e->getMessage());
        }
    }
}