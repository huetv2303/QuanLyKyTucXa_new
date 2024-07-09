<?php
class DangNhap_m extends connectDB
{
    public function account($username,$password)
    {
        $sql = "SELECT * FROM account where username = '$username' And password = '$password'";
        
        return mysqli_query($this->conn, $sql);
    }

    

    
}
