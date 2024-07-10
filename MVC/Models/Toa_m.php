<?php 
class Toa_m extends connectDB{
    public function insert($matoa, $sophong){
        $sql = "INSERT INTO toa (maToa, soPhong) VALUES ('$matoa', '$sophong')";
        return mysqli_query($this->conn, $sql);
    }

    public function all(){
        $sql = "SELECT * FROM toa";
        return mysqli_query($this->conn, $sql);
    }

    function checktrungma($matoa){
        $sql = "SELECT * FROM toa WHERE maToa='$matoa'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    function checktrungma2($matoa, $sophong){
        $sql = "SELECT * FROM toa WHERE maToa='$matoa' AND soPhong='$sophong'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;  // Trùng mã
        }
        return $kq;
    }
    function checktrungma3($matoa){
        $sql = "SELECT * 
                FROM phong
                Join toa on phong.maToa=toa.maToa
                WHERE toa.maToa='$matoa'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;  //trùng mã
        }
        return $kq;
    }
    function checktrungma4($matoa){
        $sql = "SELECT * 
                FROM nhanvien
                Join toa on nhanvien.maToa=toa.maToa
                WHERE toa.maToa='$matoa'";
        $dl = mysqli_query($this->conn, $sql);
        $kq = false;
        if(mysqli_num_rows($dl) > 0){
            $kq = true;  //trùng mã
        }
        return $kq;
    }

    function checkrong($matoa, $sophong){
        if(empty($matoa) || empty($sophong)){
            return true; // Có trường dữ liệu rỗng
        } else {
            return false; // Không có trường dữ liệu rỗng
        }
    }

    function delete($matoa){
        $sql = "DELETE FROM toa WHERE maToa='$matoa'";
        return mysqli_query($this->conn, $sql);
    }
    
    function update($matoa, $sophong){
        $sql = "UPDATE toa SET soPhong='$sophong' WHERE maToa='$matoa'";
        return mysqli_query($this->conn, $sql);
    }

    public function ds_nv($matoa){
        $sql = "SELECT nhanvien.MaNhanVien, nhanvien.TenNhanVien, nhanvien.SoDienThoai, nhanvien.GioiTinh
                FROM nhanvien, toa
                WHERE nhanvien.maToa=toa.maToa AND toa.maToa=N'$matoa'";
        return mysqli_query($this->conn, $sql);
    }

    function find3($matoa){
        $sql = "SELECT * FROM toa WHERE maToa = '$matoa'";
        return mysqli_query($this->conn, $sql);
    }
}
?>