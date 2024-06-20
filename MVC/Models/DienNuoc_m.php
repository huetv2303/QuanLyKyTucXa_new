<?php
class DienNuoc_m extends connectDB
{
    public function dichvuDN_all()
    {
        $sql = "SELECT * FROM dich_vu_dien_nuoc";
        
        return mysqli_query($this->conn, $sql);
    }

    function dichvuDN_upd($id_service,$name, $price, $unit)
    {
        $sql = "UPDATE dich_vu_dien_nuoc SET name_service ='$name', price ='$price', unit ='$unit'   WHERE id_service ='$id_service'";
        return mysqli_query($this->conn, $sql);
    }

    
}
