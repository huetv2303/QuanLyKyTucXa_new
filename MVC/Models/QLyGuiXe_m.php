<?php
class QLyGuiXe_m extends connectDB
{

    function getData()
    {
        $sql = "SELECT * FROM dich_vu_gui_xe";
        return mysqli_query($this->conn, $sql);
    }

    // Hàm load dữ liệu
    function searchData($id, $tsv)
    {
        $sql = "SELECT * FROM dich_vu_gui_xe WHERE ID like '%$id%' AND studentName like '%$tsv%'";
        return mysqli_query($this->conn, $sql);
    }

    // Hàm thêm dữ liệu vào database
    function insert($id, $tnv, $maphong, $matoa, $sdt, $email, $cccd, $ngaybatdau, $loaixe, $bienxe)
    {
        $sql = "INSERT INTO dich_vu_gui_xe VALUES('$id', '$tnv', '$maphong', '$matoa', '$sdt', '$email', '$cccd', '$ngaybatdau', '$loaixe', '$bienxe')";
        return mysqli_query($this->conn, $sql);
    }

    // Func lấy id của sinh viên
}
