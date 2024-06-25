<?php
class connectDB
{
    public $conn;
    protected $serverName = "localhost";
    protected $userName = "root";
    protected $pwd = "";
<<<<<<< HEAD

    protected $dbName = "qlktx1";
=======
    protected $dbName = "qlktx";

>>>>>>> afa79e69154fea50d178dffb74a0167b55b9b1f7

    function __construct()
    {
        $this->conn = mysqli_connect($this->serverName, $this->userName, $this->pwd, $this->dbName);
        mysqli_query($this->conn, "SET NAMES 'utf8'");
    }
}
