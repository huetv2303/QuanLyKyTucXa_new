<?php
    class HopDong_m extends connectDB{
        public function hopdong_all(){
            $query = "SELECT * FROM hopdong";
            return mysqli_query($this->conn, $query);
        }

        public function hopdong_ins($mhd, $mnv, $msv, $mp, $start, $end, $tt){
            $query = "INSERT INTO hopdong VALUES ('$mhd', '$mnv', '$msv', '$mp', '$start', '$end', '$tt')";
            return mysqli_query($this->conn, $query);
        }

        public function hopdong_del($mhd){
            $query = "DELETE FROM hopdong where maHopDong = '$mhd'";
            return mysqli_query($this->conn, $query);
        }

        public function hopdong_find($mhd, $mnv, $msv, $mp){
            $query = "SELECT * FROM hopdong WHERE maHopDong like '%$mhd%' and maSinhVien like '%$msv%' and maNhanVien like '%$mnv%' and maPhong like '%$mp%'";
            return mysqli_query($this->conn, $query);
        }

        public function hopdong_upd($mhd, $mnv, $msv, $mp, $start, $end, $tt){
            $query = "UPDATE hopdong SET maNhanVien='$mnv', maSinhVien='$msv', maPhong='$mp', ngayBatDau='$start', ngayKetThuc='$end', tinhTrang='$tt' WHERE maHopDong='$mhd'";
            return mysqli_query($this->conn, $query);
        }


        public function nhanvien_all(){
            $query = "SELECT MaNhanVien, TenNhanVien FROM nhanvien ORDER BY TenNhanVien ASC;";
            return mysqli_query($this->conn, $query);
        }


        public function sinhvien_all(){
            $query = "SELECT hoTen, maSinhVien FROM thongtinsinhvien ORDER BY hoTen ASC";
            return mysqli_query($this->conn, $query);
        }
        public function sinhvien_available(){
            $query = "SELECT sv.hoTen, sv.maSinhVien FROM thongtinsinhvien sv WHERE NOT EXISTS (SELECT 1 FROM hopdong hd WHERE hd.maSinhVien = sv.maSinhVien) ORDER BY hoTen ASC";
            return mysqli_query($this->conn, $query);
        }

        public function phong_all(){
            $query = "SELECT maPhong FROM phong ORDER BY maPhong ASC;";
            return mysqli_query($this->conn, $query);
        }
        public function phong_available(){
            $query = "SELECT p.maPhong FROM phong p WHERE NOT EXISTS (SELECT 1 FROM hopdong hd WHERE hd.maPhong = p.maPhong) ORDER BY maPhong ASC";
            return mysqli_query($this->conn, $query);
        }

        public function checkmahopdong($m){
            $sql = "SELECT * FROM hopdong WHERE maHopDong = '$m'";
            $dl = mysqli_query($this->conn, $sql);
            $kq = false;
            if(mysqli_num_rows($dl)>0) $kq = true; //trung ma 
            return $kq;
        }

        public function checkmasv($m){
            $sql = "SELECT * FROM hopdong WHERE maSinhVien = '$m'";
            $dl = mysqli_query($this->conn, $sql);
            $kq = false;
            if(mysqli_num_rows($dl)>0) $kq = true; //trung ma 
            return $kq;
        }

        public function checkphong($m){
            $sql = "SELECT * FROM hopdong WHERE maPhong = '$m'";
            $dl = mysqli_query($this->conn, $sql);
            $kq = false;
            if(mysqli_num_rows($dl)>0) $kq = true; //trung ma 
            return $kq;
        }
    }
?>