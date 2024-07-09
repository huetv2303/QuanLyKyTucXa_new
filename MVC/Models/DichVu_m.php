<?php
class DichVu_m extends connectDB
{
    public function dichvu_ins($id_service, $name, $price, $unit,$note)
    {
        $sql = "INSERT INTO dich_vu_khac(id_service, name_service, price,unit,note) VALUES ('$id_service','$name','$price','$unit','$note')";
      
        return mysqli_query($this->conn, $sql);
    }

    public function dichvu_all($page , $limit )
    {
        $offset = ($page - 1)* $limit;
        $sql = "SELECT * FROM dich_vu_khac limit  $offset,$limit ";
        return mysqli_query($this->conn, $sql);
    }

    public function dichvu_all1() 
    {
        $sql = "SELECT * FROM dich_vu_khac";
        return mysqli_query($this->conn, $sql);
    }
    
    function count() {
        $sql = "SELECT COUNT(*) as total FROM dich_vu_khac";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    
    function dichvu_find($id_service, $name)
    {
        $sql = "SELECT * FROM dich_vu_khac WHERE id_service like '%$id_service%' 
    AND name_service like '%$name%' " ;
    
        return mysqli_query($this->conn, $sql);
    }


    function check_trung_ma($id_service)
    {
        $sql = "SELECT * FROM dich_vu_khac WHERE id_service ='$id_service' ";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    function check_name($name_service)
    {
        $sql = "SELECT * FROM dich_vu_khac WHERE name_service ='$name_service' ";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

   

    function dichvu_del($id_service)
    {
        $sql = "DELETE FROM dich_vu_khac WHERE id_service ='$id_service'";
        return mysqli_query($this->conn, $sql);
    }

    function dichvu_upd($id_service,$name, $price, $unit,$note)
    {
        $sql = "UPDATE dich_vu_khac SET name_service ='$name', price ='$price', unit ='$unit'  , note ='$note' WHERE id_service ='$id_service' ";
        return mysqli_query($this->conn, $sql);
    }


 

   
}
