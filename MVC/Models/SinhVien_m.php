<?php
class SinhVien_m extends connectDB
{
    // $matoa, $maphong,
    public function sinhvien_ins($msv, $tensv, $email, $sdt, $ns, $gt, $cccd, $dc)
    {

        $sql = "INSERT INTO thongtinsinhvien VALUES ('$msv', '', '$tensv','$email','$sdt','$ns','$gt','$cccd','$dc')";
        return mysqli_query($this->conn, $sql);
    }

    public function sinhvien_all()
    {
        $sql = "SELECT * FROM thongtinsinhvien";
        return mysqli_query($this->conn, $sql);
    }

    function check_trung_ma($msv)
    {
        $sql = "SELECT * FROM thongtinsinhvien WHERE maSinhVien ='$msv'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    function sinhvien_find($masv, $tensv)
    {
        $sql = "SELECT * FROM thongtinsinhvien WHERE hoTen like '%$tensv%' and maSinhVien like '%$masv%'";
        return mysqli_query($this->conn, $sql);
    }

    function sinhvien_del($msv)
    {
        $sql = "DELETE FROM thongtinsinhvien WHERE maSinhVien ='$msv'";
        return mysqli_query($this->conn, $sql);
    }

    function sinhvien_upd($msv, $tensv, $email, $sdt, $ns, $gt, $cccd, $dc)
    {
        $sql = "UPDATE thongtinsinhvien SET hoTen ='$tensv', email ='$email', soDienThoai = '$sdt', ngaySinh = '$ns', gioiTinh = '$gt', cccd = '$cccd', diaChi = '$dc' WHERE maSinhVien ='$msv'";
        return mysqli_query($this->conn, $sql);
    }

    public function get_all_toa()
    {
        $sql = "SELECT maToa FROM toa";
        return mysqli_query($this->conn, $sql);
    }

    public function get_phong_by_toa($maToa)
    {
        $sql = "SELECT maPhong FROM phong WHERE maToa = '$maToa'";
        return mysqli_query($this->conn, $sql);
    }


}
