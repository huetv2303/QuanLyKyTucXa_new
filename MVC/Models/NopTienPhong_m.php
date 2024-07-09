<?php
class NopTienPhong_m extends connectDB
{
    // $matoa, $maphong,
    public function noptienphong_ins($mgd, $matoa, $maphong, $tienphong, $thang, $nam,$ngaytao, $ngayhethan, $trangthai)
    {
        $sql = "INSERT INTO noptienphong VALUES ('$mgd','$matoa','$maphong', '$tienphong','$thang', '$nam', '$ngaytao', '$ngayhethan', '$trangthai')";
        return mysqli_query($this->conn, $sql);
    }

    public function noptienphong_all()
    {
        $sql = "SELECT * FROM noptienphong";
        return mysqli_query($this->conn, $sql);
    }

    function check_trung_ma($mgd)
    {
        $sql = "SELECT * FROM noptienphong WHERE maGiaoDich ='$mgd'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    function noptienphong_find($magiaodich, $maphong)
    {
        $sql = "SELECT * FROM noptienphong WHERE maGiaoDich like '%$magiaodich%'and maPhong like '%$maphong%'";
        return mysqli_query($this->conn, $sql);
    }

    function noptienphong_del($mgd)
    {
        $sql = "DELETE FROM noptienphong WHERE maGiaoDich ='$mgd'";
        return mysqli_query($this->conn, $sql);
    }

    function noptienphong_upd($mgd, $matoa, $maphong, $tienphong, $thang, $nam,$ngaytao, $ngayhethan, $trangthai)
    {
        $sql = "UPDATE noptienphong SET maToa = '$matoa', maPhong ='$maphong', tienPhong = '$tienphong', thang = '$thang', nam = '$nam', ngayNop = '$ngaytao', ngayHetHan = '$ngayhethan', trangthai = '$trangthai' WHERE maGiaoDich ='$mgd'";
        return mysqli_query($this->conn, $sql);
    }

    public function get_all_toa()
    {
        $sql = "SELECT maToa FROM toa";
        return mysqli_query($this->conn, $sql);
    }


    public function get_all_phong()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }
    public function get_phong_by_toa($maToa)
    {
        $sql = "SELECT maPhong, tienPhong FROM phong WHERE maToa = '$maToa'";
        return mysqli_query($this->conn, $sql);
    }


    public function get_tienphong_by_phong($maPhong)
    {
        $sql = "SELECT tienPhong FROM phong WHERE maPhong = '$maPhong'";
        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['tienPhong']; // Return the value of tienPhong directly
        }
        return null;
    }

     public function idP()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }
}
