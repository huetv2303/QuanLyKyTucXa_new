<?php 
class Toa_m extends connectDB{
    public function insert($matoa,$sonv){
        $sql = "INSERT INTO toa ( maToa, soNhanVien ) VALUES ( '$matoa', '$sonv')";
    
        return mysqli_query($this->conn,$sql);
    }
   public function all(){
    $sql = "SELECT * FROM toa";
    return mysqli_query($this->conn, $sql);
   
}

    // function checktrungma($maphong){
    //     $sql="SELECT * From phong Where maPhong='$maphong'";
    //     $dl=mysqli_query($this->conn,$sql);
    //     $kq=false;
    //     if(mysqli_num_rows($dl)>0){
    //         $kq=true;  //trùng mã
    //     }
    //     return $kq;
    // }
    
    
    // function find($matoa,$sonv){
    //     $sql="SELECT * FROM toa  WHERE maToa like N'%$matoa%'  OR soNhanVien like '$sonv'" ;
    //     return mysqli_query($this->conn,$sql);
    // }
    // function find2($matoa){
    //     $sql="SELECT * FROM toa WHERE maToa = '$matoa'  " ;
    //     return mysqli_query($this->conn,$sql);
    // }
    // function delete($matoa){
    //     $sql="DELETE FROM toa WHERE maToa='$matoa'";
    //     return mysqli_query($this->conn,$sql);
    // }

   public function update($matoa){
        $sql = "SELECT *FROM nhanvien WHERE maToa='$matoa'";
        return  mysqli_query($this->conn, $sql);
        
    }
    function dem($matoa){
        $sql= "SELECT t.maToa, COUNT(n.maNhanVien) AS SoLuongNhanVien
FROM toa t
LEFT JOIN nhanvien n ON t.maToa = n.maToa
WHERE t.maToa = '$matoa'
GROUP BY t.maToa;";
        
         return mysqli_query($this->conn,$sql);
       
    }
    
    
}
?>