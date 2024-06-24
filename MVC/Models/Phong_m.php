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
        $sql="SELECT * From phong Where maPhong='$maphong'";
        $dl=mysqli_query($this->conn,$sql);
        $kq=false;
        if(mysqli_num_rows($dl)>0){
            $kq=true;  //trùng mã
        }
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
        $sql="SELECT * FROM phong  WHERE maPhong like N'%$maphong%'  OR maToa like '$matoa' OR trangThai like N'%$trangthai%' " ;
        return mysqli_query($this->conn,$sql);
    }
    function find2($maphong){
        $sql="SELECT * FROM phong WHERE maPhong = '$maphong'  " ;
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
        $sql = "SELECT * FROM toa";//nếu bài bạn là phòng thì đây là tòa
        return mysqli_query($this->conn,$sql);
    }
}
?>