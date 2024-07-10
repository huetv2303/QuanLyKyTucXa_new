<?php
class NhanVien_m extends connectDB
{
    // Hàm chèn dữ liệu nhân viên vào database
    public function insertNhanVien($mnv, $tnv, $gt, $ns, $dc, $sdt, $matoa)
    {
        $sql = "INSERT INTO nhanvien VALUES ('$mnv', N'$tnv', N'$gt', '$ns', N'$dc', '$sdt', '$matoa')";
        return mysqli_query($this->conn, $sql);
    }

    // Hàm lấy dữ liệu toàn bộ dữ liệu nhân viên
    public function loadNhanVien()
    {
        $sql = "SELECT * FROM nhanvien";
        return mysqli_query($this->conn, $sql);
    }


    // Func kiểm tra trùng mã nhân viên
    function ktraTrungMa($mnv)
    {
        $sql = "SELECT * FROM nhanvien WHERE MaNhanVien ='$mnv'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    // Func tìm kiếm nhân viên
    function searchNhanVien($mnv, $tnv)
    {
        $sql = "SELECT * FROM nhanvien WHERE MaNhanVien like '%$mnv%' 
        AND TenNhanVien like '%$tnv%'";
        return mysqli_query($this->conn, $sql);
    }

    // Func xóa nhân viên
    function deleteNhanVien($mnv)
    {
        $sql = "DELETE FROM nhanvien WHERE MaNhanVien ='$mnv'";
        return mysqli_query($this->conn, $sql);
    }

    // Func cập nhật thông tin nhân viên
    function updateNhanVien($mnv, $tnv, $gt, $ns, $dc, $sdt, $matoa)
    {
        $sql = "UPDATE nhanvien SET TenNhanVien = N'$tnv', GioiTinh = N'$gt', 
        NgaySinh = '$ns', DiaChi = '$dc', SoDienThoai = '$sdt', MaToa = '$matoa' 
        WHERE MaNhanVien = '$mnv'";
        return mysqli_query($this->conn, $sql);
    }

    // Func lấy dữ liệu mã tòa
    function getMaToa()
    {
        $sql = " SELECT maToa FROM toa";
        return mysqli_query($this->conn, $sql);
    }
}
