<?php 
class Toa_m extends connectDB{
    public function insert($matoa,$sophong){
        $sql = "INSERT INTO toa VALUES ( '$matoa', '$sophong') WHERE count (soPhong <26 and maToa='A1'),
        (soPhong <31 and maToa='A2'),
        (soPhong <36 and maToa='A3')
        ";
    
        return mysqli_query($this->conn,$sql);
    }
   public function all(){
    $sql = "SELECT * FROM toa";
  
    return mysqli_query($this->conn, $sql);
   
}

    function checktrungma($matoa){
        $sql="SELECT * From toa Where maToa='$matoa'";
        $dl=mysqli_query($this->conn,$sql);
        $kq=false;
        if(mysqli_num_rows($dl)>0){
            $kq=true;  //trùng mã
        }
        return $kq;
    }
    
    
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

   public function truyen($matoa){
        $sql = "SELECT toa.*,nhanvien.MaNhanVien, nhanvien.TenNhanVien, nhanvien.SoDienThoai
                FROM toa
                JOIN nhanvien ON toa.maToa = nhanvien.maToa
                WHERE toa.maToa='$matoa' ";
        return  mysqli_query($this->conn, $sql);
        
    }
    function update1($sophong,$matoa){
        $sql="UPDATE toa SET soPhong='$sophong' where maToa='$matoa'";
        return mysqli_query($this->conn,$sql);
    }
    function update2($tennv,$sdt,$manv){
        $sql="UPDATE nhanvien SET TenNhanVien='$tennv', SoDienThoai='$sdt' where MaNhanVien='$manv'";
        return mysqli_query($this->conn,$sql);
    }

    public function all_toa(){
        $sql = "SELECT toa.*,nhanvien.MaNhanVien, nhanvien.TenNhanVien, nhanvien.SoDienThoai
                FROM toa
                JOIN nhanvien ON toa.maToa = nhanvien.maToa";
        return  mysqli_query($this->conn, $sql);
        
    }
   
    function find2($matoa){
        $sql="SELECT * FROM toa WHERE maToa = '$matoa'  " ;
        return mysqli_query($this->conn,$sql);
    }
    function find3($manv){
        $sql="SELECT * FROM nhanvien WHERE MaNhanVien = '$manv'  " ;
        return mysqli_query($this->conn,$sql);
    }


    function find($tennv){
        $sql="SELECT * FROM nhanvien  WHERE TenNhanVien like N'%$tennv%'" ;
        return mysqli_query($this->conn,$sql);
    }
    //
    
    
}
?>