<?php 
class Phong_m extends connectDB{
    public function insert($maphong,$matoa,$songuoi,$tienphong,$trangthai){
        $sql = "INSERT INTO phong (maPhong, maToa, soNguoi, tienPhong, trangThai) VALUES ('$maphong', '$matoa', '$songuoi', '$tienphong', '$trangthai')";
    
        return mysqli_query($this->conn,$sql);
    }
    public function all(){
        $sql="SELECT * From phong";
        return mysqli_query($this->conn,$sql);
    }
    function checktrungma($maphong){
        $sql="SELECT * From phong Where maPhong='$maphong' ";
        $dl=mysqli_query($this->conn,$sql);
        $kq=false;
        if(mysqli_num_rows($dl)>0){
            $kq=true;  //trùng mã
        }
        return $kq;
    }
    function checktrungma2($maphong, $matoa){
        // Sử dụng câu truy vấn SQL để kiểm tra xem có dòng nào khớp với cả mã phòng và mã tòa hay không
        $sql = "SELECT * FROM phong WHERE maPhong = '$maphong' AND maToa = '$matoa'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
    
        // Nếu số hàng trả về lớn hơn 0, tức là có trùng mã phòng và mã tòa
        if(mysqli_num_rows($dl) > 0){
            $kq = true;  // Trùng mã
        }
    
        // Trả về kết quả
        return $kq;
    }
    
    function checkrong($maphong,$matoa,$songuoi,$tienphong,$trangthai){
        if(empty($maphong) || empty($matoa) || empty($songuoi)||empty($tienphong)||empty($trangthai)){
            return true; // Có trường dữ liệu rỗng
        } else {
            return false; // Không có trường dữ liệu rỗng
        }
    }
    
    function find($maphong,$matoa,$trangthai){
        $sql="SELECT * FROM phong  WHERE maPhong like '%$maphong%'  OR maToa like '%$matoa%' OR trangThai like '%$trangthai%' " ;
        return mysqli_query($this->conn,$sql);
    }
    function find2($maphong){
        $sql="SELECT * FROM phong WHERE maPhong = '$maphong' " ;
        return mysqli_query($this->conn,$sql);
    }
    function find_radio($maphong,$matoa,$trangthai){
        $sql="SELECT * FROM phong  WHERE( maPhong like '%$maphong%'  or maToa like '%$matoa%') and trangThai like '%$trangthai%' " ;
        return mysqli_query($this->conn,$sql);
    }

    function delete($maphong){
        $sql="DELETE FROM phong WHERE maPhong='$maphong'";
        return mysqli_query($this->conn,$sql);
    }
    function update($maphong,$matoa,$songuoi,$tienphong,$trangthai){
        $sql="UPDATE phong SET maToa='$matoa', soNguoi='$songuoi',tienPhong='$tienphong',trangThai='$trangthai' WHERE maPhong='$maphong'";
        return mysqli_query($this->conn,$sql);
    }
    public function toa_All(){
        $sql = "SELECT * FROM toa";
        return mysqli_query($this->conn,$sql);
    }
    function sumPhong($maphong){
        $sql = "SELECT maPhong, COUNT(*) AS soNguoi FROM phong WHERE maPhong = '$maphong' GROUP BY maPhong HAVING COUNT(*) = 8";
        return mysqli_query($this->conn, $sql);
    }
    //danh sách phòng hiện ra danh sách sinh viên//
    //
    // public function update_ctphong()
    // {
    //     $sql2 = "UPDATE phong
    //     JOIN nhomsinhvien ON phong.maPhong = nhomsinhvien.maPhong
    //     JOIN hopdong ON hopdong.maPhong = phong.maPhong
    //     SET phong.manhomsinhvien = nhomsinhvien.manhomsinhvien;";
    //     return mysqli_query($this->conn, $sql2);
    // }
    public function update_ctphong()
    {
        $sql2 = "UPDATE phong
        JOIN hopdong ON hopdong.maPhong = phong.maPhong
        SET phong.maHopDong = hopdong.maHopDong;";
        return mysqli_query($this->conn, $sql2);
    }


    public function ds_sinhvien($hopdong){
        $sql = "SELECT thongtinsinhvien.maSinhVien,thongtinsinhvien.hoTen,thongtinsinhvien.soDienThoai,thongtinsinhvien.gioiTinh
                FROM hopdong
                join phong on phong.maPhong= hopdong.maPhong
                join nhomsinhvien on nhomsinhvien.maTruongNhom=hopdong.maTruongNhom
                join thongtinsinhvien on thongtinsinhvien.maNhomSinhVien=nhomsinhvien.maNhomSinhVien
                where phong.maHopDong=N'$hopdong'";
        return  mysqli_query($this->conn, $sql);
        
    }
    function find3($hopdong){
        $sql="SELECT * FROM phong WHERE maHopDong = N'$hopdong' " ;
        return mysqli_query($this->conn,$sql);
    }

   
}
?>