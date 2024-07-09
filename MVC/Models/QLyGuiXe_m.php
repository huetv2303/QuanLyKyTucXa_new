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
    function insert($id, $tnv, $maphong, $matoa, $sdt, $email, $ngaybatdau, $loaixe, $bienxe)
    {
        $sql = "INSERT INTO dich_vu_gui_xe VALUES('$id', '$tnv', '$maphong', '$matoa', '$sdt', '$email', '$ngaybatdau', '$loaixe', '$bienxe')";
        return mysqli_query($this->conn, $sql);
    }

    // Func lấy id của sinh viên
    function getID()
    {
        $sql = "SELECT maSinhVien FROM thongtinsinhvien";
        return mysqli_query($this->conn, $sql);
    }

    // Func kiểm tra sinh viên đã đăng ký gửi xe hay chưa
    function Check($msv)
    {
        $sql = "SELECT * FROM dich_vu_gui_xe WHERE ID = '$msv'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    // Func cập nhật thông tin đăng kí gửi xe của sinh viên
    function update($msv, $sdt, $email, $date, $type, $plate)
    {
        $sql = "UPDATE dich_vu_gui_xe SET phoneNumber = '$sdt', email = '$email', registerDate = '$date', typeOfVehicle = '$type', plate = '$plate' WHERE ID = '$msv'";
        return mysqli_query($this->conn, $sql);
    }

    // Func xóa thông tin đăng kí gửi xe của sinh viên
    function delete($msv)
    {
        $sql = "DELETE FROM dich_vu_gui_xe WHERE ID = '$msv'";
        return mysqli_query($this->conn, $sql);
    }
}
