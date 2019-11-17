<?php

class Db
{
    public $servername;
    public $username;
    public $password;
    public $dbname;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function getConnection()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
    }

}

$db = new Db('localhost', 'root', '', 'short_url_db');
$conn = $db->getConnection();
