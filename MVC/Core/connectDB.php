<?php
class connectDB
{
    public $conn;
    protected $serverName = "localhost";
    protected $userName = "root";
    protected $pwd = "";
<<<<<<< HEAD
    protected $dbName = "testsql";
=======

    protected $dbName = "qlktx";


>>>>>>> 94688866de83f24a8b807f90948041736ba5cc57
    function __construct()
    {
        $this->conn = mysqli_connect($this->serverName, $this->userName, $this->pwd, $this->dbName);
        mysqli_query($this->conn, "SET NAMES 'utf8'");
    }
}
