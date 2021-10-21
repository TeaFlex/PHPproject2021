<?php

class AccessSQL {
    private PDO | null $db = null;
    private $host = "localhost";
    private $user = "root";
    private $pwd = null;
    private $dbname = "movies_proj";
    private $port = 3306;

    function init() {
        $this->db = new PDO(
            "mysql:host={$this->host}:{$this->port};dbname={$this->dbname}", 
            $this->user, 
            $this->pwd
        );
    }

    function insertInto(string $table, array $values) {
        $sql = "INSERT into {$table} (".implode(', ', array_keys($values)).") 
        VALUES (:".implode(', :', array_keys($values)).");";
        $req = $this->db->prepare($sql);
        foreach ($values as $key => $value) 
            $req->bindValue(":{$key}", $value);
        $req->execute();
    }

    function __destruct() {
        $this->db = null;
    }
}