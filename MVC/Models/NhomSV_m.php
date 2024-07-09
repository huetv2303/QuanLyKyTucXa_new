<?php
class NhomSV_m extends connectDB
{
    // $matoa, $maphong,
    public function nhomsinhvien_ins($manhom, $matruongnhom, $maphong, $soluong)
    {
        $sql = "INSERT INTO nhomsinhvien VALUES ('$manhom','$matruongnhom', '$maphong', $soluong)";
        return mysqli_query($this->conn, $sql);
    }

    public function  nhomsinhvien_all()
    {
        $sql = "SELECT * FROM nhomsinhvien";
        return mysqli_query($this->conn, $sql);
    }

    function check_trung_ma($manhom)
    {
        $sql = "SELECT * FROM nhomsinhvien WHERE maNhomSinhVien ='$manhom'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) {
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    function nhomsinhvien_find($manhom, $maphong)
    {
        $sql = "SELECT * FROM nhomsinhvien WHERE maNhomSinhVien like '%$manhom%'and maPhong like '%$maphong%'";
        return mysqli_query($this->conn, $sql);
    }

    function nhomsinhvien_del($manhom)
    {
        $sql = "DELETE FROM nhomsinhvien WHERE maNhomSinhVien ='$manhom'";
        return mysqli_query($this->conn, $sql);
    }

    function nhomsinhvien_upd($manhom, $matruongnhom, $maphong)
    {
        $sql = "UPDATE nhomsinhvien SET maTruongNhom = '$matruongnhom',  maPhong ='$maphong' WHERE maNhomSinhVien ='$manhom'";
        return mysqli_query($this->conn, $sql);
    }

    function update_nhomsv_ttsv($masv, $manhom)
    {
        $sql = "UPDATE thongtinsinhvien SET maNhomSinhVien = '$manhom' WHERE maSinhVien ='$masv'";
        return mysqli_query($this->conn, $sql);
    }

    function dem_sv_trongnhom($manhom)
    {
        $sql = "SELECT COUNT(*) FROM `thongtinsinhvien` WHERE maNhomSinhVien = '$manhom'";
        return mysqli_query($this->conn, $sql);
    }

    function update_soluong($manhom, $soluong)
    {
        $sql = "UPDATE nhomsinhvien SET soLuong = '$soluong' WHERE maNhomSinhVien ='$manhom'";
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

    public function get_all_nhom()
    {
        $sql = "SELECT maNhomSinhVien FROM nhomsinhvien";
        return mysqli_query($this->conn, $sql);
    }

    public function get_all_masv_noGroup()
    {
        $sql = "SELECT maSinhVien FROM thongtinsinhvien WHERE maNhomSinhVien = ''";
        return mysqli_query($this->conn, $sql);
    }

    public function get_phong_by_toa($maToa)
    {
        $sql = "SELECT maPhong, tienPhong FROM phong WHERE maToa = '$maToa'";
        return mysqli_query($this->conn, $sql);
    }

    public function get_masv_by_nhom($manhom)
    {
        $sql = "SELECT maSinhVien FROM thongtinsinhvien WHERE maNhomSinhVien = '$manhom'";
        return mysqli_query($this->conn, $sql);
    }

    function xoa_sv_khoi_nhom($masv)
    {
        $sql = "UPDATE thongtinsinhvien SET maNhomSinhVien = '' WHERE maSinhVien ='$masv'";
        return mysqli_query($this->conn, $sql);
    }


    public function idP()
    {
        $sql = "SELECT maPhong FROM phong";
        return mysqli_query($this->conn, $sql);
    }
}
