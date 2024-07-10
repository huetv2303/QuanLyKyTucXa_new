<?php
class HopDong_m extends connectDB
{
    public function hopdong_all()
    {
        $query = "SELECT * FROM hopdong";
        return mysqli_query($this->conn, $query);
    }

    public function hopdong_ins($mhd, $mnv, $msv, $mt, $mp, $start, $end, $tt)
    {
        $query = "INSERT INTO hopdong VALUES ('$mhd', '$mnv', '$msv', '$mt','$mp', '$start', '$end', '$tt')";
        $query2 = "UPDATE nhomsinhvien set maPhong = '$mp' where maTruongNhom = '$msv'";
        mysqli_query($this->conn, $query2);
        return mysqli_query($this->conn, $query);
    }

    public function hopdong_del($mhd)
    {
        $query = "DELETE FROM hopdong where maHopDong = '$mhd'";
        return mysqli_query($this->conn, $query);
    }

    public function hopdong_find($mhd, $mnv, $msv, $mp)
    {
        $query = "SELECT * FROM hopdong WHERE maHopDong like '%$mhd%' and maTruongNhom like '%$msv%' and MaNhanVien like '%$mnv%' and maPhong like '%$mp%'";
        return mysqli_query($this->conn, $query);
    }

    public function hopdong_ketthuc($maPhong){
        $query1 = "DELETE FROM hopdong WHERE maPhong = '$maPhong'";
        $query2 = "DELETE FROM noptienphong WHERE maPhong = '$maPhong'";
        $query3 = "DELETE FROM hoa_don_dich_vu WHERE id_room = '$maPhong'";
        $query4 = "DELETE FROM dang_ky_dich_vu WHERE id_room = '$maPhong'";
        $query5 = "DELETE FROM nhomsinhvien WHERE maPhong = '$maPhong'";
        mysqli_query($this->conn, $query1);
        mysqli_query($this->conn, $query2);
        mysqli_query($this->conn, $query3);
        mysqli_query($this->conn, $query4);
        mysqli_query($this->conn, $query5);

    }

    public function hopdonghethan_find($mhd, $mnv, $msv, $mp)
    {
        $query = "SELECT * FROM hopdong WHERE maHopDong like '%$mhd%' and maTruongNhom like '%$msv%' and MaNhanVien like '%$mnv%' and maPhong like '%$mp%' and tinhTrang like 'hết hạn'";
        return mysqli_query($this->conn, $query);
    }

    public function hopdong_upd($mhd, $mnv, $mt,  $mp, $start, $end, $tt)
    {
        $query = "UPDATE hopdong SET MaNhanVien='$mnv',maToa = '$mt', maPhong='$mp', ngayBatDau='$start', ngayKetThuc='$end', tinhTrang='$tt' WHERE maHopDong='$mhd'";
        return mysqli_query($this->conn, $query);
    }


    public function hopdonggiahan_all()
    {
        $query = "SELECT * FROM hopdong WHERE tinhTrang = 'Hết hạn'";
        return mysqli_query($this->conn, $query);
    }

    public function hopdonggiahan_giahan($mhd, $end)
    {
        $query = "UPDATE hopdong SET tinhTrang='Gia hạn', ngayKetThuc ='$end' WHERE maHopDong = '$mhd'";
        return mysqli_query($this->conn, $query);
    }




    public function nhanvien_all()
    {
        $query = "SELECT * FROM nhanvien";
        return mysqli_query($this->conn, $query);
    }


    public function sinhvien_all()
    {
        $query = "SELECT hoTen, maSinhVien FROM thongtinsinhvien ORDER BY maSinhVien ASC";
        return mysqli_query($this->conn, $query);
    }
    public function truongnhom_available()
    {
        $query = "SELECT p.maTruongNhom, sv.hoTen, sv.maSinhVien
                FROM nhomsinhvien p, thongtinsinhvien sv WHERE NOT EXISTS (SELECT 1 FROM hopdong hd WHERE hd.maTruongNhom = p.maTruongNhom)
                AND p.maTruongNhom = sv.maSinhVien";
        return mysqli_query($this->conn, $query);
    }

    public function phong_all()
    {
        $query = "SELECT maPhong FROM phong ORDER BY maPhong ASC;";
        return mysqli_query($this->conn, $query);
    }
    public function phong_available()
    {
        $query = "SELECT p.maPhong FROM phong p WHERE NOT EXISTS (SELECT 1 FROM hopdong hd WHERE hd.maPhong = p.maPhong) ORDER BY maPhong ASC";
        return mysqli_query($this->conn, $query);
    }

    public function truongnhom_all()
    {
        $query = "SELECT nsv.maTruongNhom, ttsv.hoTen, ttsv.maSinhVien FROM nhomsinhvien nsv, thongtinsinhvien ttsv where nsv.maTruongNhom = ttsv.maSinhVien;";
        return mysqli_query($this->conn, $query);
    }

    public function nhomsinhvien_all($maNhom)
    {
        $query = "SELECT * FROM thongtinsinhvien where maNhomSinhVien = '$maNhom';";
        return mysqli_query($this->conn, $query);
    }

    public function toa_all()
    {
        $query = "SELECT * FROM toa;";
        return mysqli_query($this->conn, $query);
    }

    public function get_phong_by_toa($maToa)
    {
        // $sql = "SELECT maPhong FROM phong WHERE maToa = '$maToa'";
        $sql2 = "SELECT maPhong, tienPhong FROM phong p 
                WHERE NOT EXISTS (SELECT 1 FROM hopdong hd WHERE hd.maPhong = p.maPhong)
                AND maToa = '$maToa'";
        return mysqli_query($this->conn, $sql2);
    }

    public function get_tien_phong_by_phong($maPhong)
    {
        $sql2 = "SELECT maPhong, tienPhong FROM phong WHERE maPhong = '$maPhong' ";
        return mysqli_query($this->conn, $sql2);
    }

    public function checkmahopdong($m)
    {
        $sql = "SELECT * FROM hopdong WHERE maHopDong = '$m'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) $kq = true; //trung ma 
        return $kq;
    }

    public function checkmatn($m)
    {
        $sql = "SELECT * FROM hopdong WHERE maTruongNhom = '$m'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) $kq = true; //trung ma 
        return $kq;
    }

    public function checkphong($m)
    {
        $sql = "SELECT * FROM hopdong WHERE maPhong = '$m'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) $kq = true; //trung ma 
        return $kq;
    }

    public function check_no_phi_dv($m)
    {
        $sql = "SELECT * FROM hoa_don_dich_vu WHERE id_room = '$m' and status = 'Chưa thanh toán'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if (mysqli_num_rows($dl) > 0) $kq = true; //chua thanh toan hoa don dv
        return $kq;
    }

    public function check_no_tien_phong($m)
    {
        $sql = "SELECT * FROM noptienphong WHERE maPhong = '$m' and trangThai = 'Chưa thanh toán'";
        $dl = mysqli_query($this->conn, $sql); 
        $kq = false;
        if (mysqli_num_rows($dl) > 0) $kq = true; //chua thanh toan tien phong
        return $kq;
    }

    public function update_ctphong()
    {
        $sql2 = "UPDATE phong
        JOIN hopdong ON hopdong.maPhong = phong.maPhong
        SET phong.maHopDong = '';";
        return mysqli_query($this->conn, $sql2);
    }

   




}
