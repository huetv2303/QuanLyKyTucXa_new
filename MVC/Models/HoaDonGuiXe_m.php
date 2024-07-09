<?php
class HoaDonGuiXe_m extends connectDB
{
    // Func load dữ liệu hóa đơn
    function load_Data()
    {
        $sql = "SELECT * FROM hoa_don_gui_xe";
        return mysqli_query($this->conn, $sql);
    }

    // Func thêm mới hóa đơn
    function insert_Data($mhd, $id, $name, $month, $price, $day, $type, $plate, $status, $note)
    {
        $sql = "INSERT INTO hoa_don_gui_xe VALUES ('$mhd', '$id', '$name', '$month', '$price', '$day', '$type', '$plate', '$status', '$note')";
        return mysqli_query($this->conn, $sql);
    }

    // Func kiểm tra trùng mã hóa đơn
    function Check($mhd)
    {
        $sql = "SELECT * FROM hoa_don_gui_xe WHERE billCode = '$mhd'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    // Func sửa dữ liệu
    function update_Data($mhd, $month, $price, $day, $status, $note)
    {
        $sql = "UPDATE hoa_don_gui_xe SET month = '$month', price = '$price', invoiceDate = '$day', status = '$status', note = '$note' WHERE billCode = '$mhd'";
        return mysqli_query($this->conn, $sql);
    }

    // Func tìm kiếm thông tin
    function search_Data($mhd, $id, $status)
    {
        $sql = "SELECT * FROM hoa_don_gui_xe WHERE billCode like '%$mhd%' AND ID like '%$id%' AND status like '%$status%'";
        return mysqli_query($this->conn, $sql);
    }

    // Func xóa dữ liệu hóa đơn
    function delete_Data($mhd)
    {
        $sql = "DELETE FROM hoa_don_gui_xe WHERE billCode = '$mhd'";
        return mysqli_query($this->conn, $sql);
    }

    // Func lấy ID của sinh viên đã đăng ký gửi xe
    function get_ID()
    {
        $sql = "SELECT ID, studentName, typeOfVehicle, plate FROM dich_vu_gui_xe";
        return mysqli_query($this->conn, $sql); 
    }
}