<?php
class PDV_m extends connectDB
{
    public function dichvuPDV_ins($id_room, $id_service)
    {
        $sql = "INSERT INTO phong_dich_vu(id_room,id_service) VALUES ('$id_room','$id_service')";
       
        return mysqli_query($this->conn, $sql);
    }

    public function dichvuPDV_all()
    {
        $sql = "SELECT * FROM phong_dich_vu";
        return mysqli_query($this->conn, $sql);
    }

    public function dichvu_idnamdv()
    {
        $sql = "SELECT id_service, name_service FROM dich_vu_khac";
        return mysqli_query($this->conn, $sql);
    }
    public function dichvu_idP()
    {
        $sql = "SELECT id_room FROM phong_ky_tuc_xa";
        return mysqli_query($this->conn, $sql);
    }


    function dichvuPDV_find($id_room, $id_service)
    {
        $sql = "SELECT * FROM phong_dich_vu WHERE id_room like '%$id_room%' 
    AND id_service like '%$id_service%'";
        return mysqli_query($this->conn, $sql);
    }

    function dichvuPDV_del($id)
    {
        $sql = "DELETE FROM phong_dich_vu WHERE id ='$id'";
        return mysqli_query($this->conn, $sql);
    }

    function dichvuPDV_upd($id,$id_room,$id_service)
    {
        $sql = "UPDATE phong_dich_vu SET id_room ='$id_room', id_service = '$id_service'  WHERE id ='$id'";
        return mysqli_query($this->conn, $sql);
    }


}
