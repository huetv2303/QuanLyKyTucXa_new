<?php
class PDV_m extends connectDB
{
    public function dichvuPDV_ins($maToa,$id_room, $id_service, $month, $year)
    {
        $sql = "INSERT INTO dang_ky_dich_vu(maToa,id_room,id_service,month,year) VALUES ('$maToa','$id_room','$id_service', '$month','$year')";
        return mysqli_query($this->conn, $sql);
    }

    public function dichvuPDV_all($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM dang_ky_dich_vu limit $offset,$limit ";
        return mysqli_query($this->conn, $sql);
    }

    function count()
    {
        $sql = "SELECT COUNT(*) as total FROM dang_ky_dich_vu";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    function dichvuPDV_find($id_room, $id_service, $month, $year)
    {
        $sql = "SELECT * FROM dang_ky_dich_vu WHERE id_room like '%$id_room%' 
    AND id_service like '%$id_service%' AND month like '%$month%' AND year like '%$year%' ";
        return mysqli_query($this->conn, $sql);
    }


    function check_trung_ma($id_room, $id_service,$thang,$nam)
    {

        $sql = "SELECT * FROM dang_ky_dich_vu WHERE id_service ='$id_service' and id_room = '$id_room'  and month ='$thang' and year = '$nam'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    public function dichvu_idnamdv()
    {
        $sql = "SELECT id_service, name_service FROM dich_vu_khac";
        return mysqli_query($this->conn, $sql);
    }

    public function dichvu_idP()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }

    public function get_phong_by_toa($maToa)
    {
        $sql = "SELECT maPhong FROM phong WHERE maToa = '$maToa'";
        return mysqli_query($this->conn, $sql);
    }

    public function get_all_toa()
    {
        $sql = "SELECT maToa FROM toa";
        return mysqli_query($this->conn, $sql);
    }

    function dichvuPDV_del($id)
    {
        $sql = "DELETE FROM dang_ky_dich_vu WHERE id ='$id'";

        return mysqli_query($this->conn, $sql);
    }

    function dichvuPDV_upd($id, $maToa, $id_room, $id_service, $month, $year)
    {
        $sql = "UPDATE dang_ky_dich_vu SET maToa = '$maToa', id_room ='$id_room', id_service = '$id_service' ,month ='$month', year = '$year'  WHERE id ='$id'";
        return mysqli_query($this->conn, $sql);
    }
}
