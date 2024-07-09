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
    protected $dbName = "qlktx2";
>>>>>>> 79926b2fc15c65220bbd83cc97069933bba7920e

    function __construct()
    {
        $this->conn = mysqli_connect($this->serverName, $this->userName, $this->pwd, $this->dbName);
        mysqli_query($this->conn, "SET NAMES 'utf8'");
    }
}
