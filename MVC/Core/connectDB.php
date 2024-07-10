<?php
class connectDB
{
    public $conn;
    protected $serverName = "localhost";
    protected $userName = "root";
    protected $pwd = "";

    protected $dbName = "qlktx";

    function __construct()
    {
        $this->conn = mysqli_connect($this->serverName, $this->userName, $this->pwd, $this->dbName);
        mysqli_query($this->conn, "SET NAMES 'utf8'");
    }
}
