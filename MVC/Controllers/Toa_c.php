<?php 
class Toa_c extends controller{
    private $ds;
    function __construct()
    {
        $this->ds=$this->model('Toa_m');
    }

    function Get_data() {
       
        $ma = $this->ds->all();
        $dulieu = $this->ds->all_toa();
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
           'dulieu' => $dulieu,
            'ma' => $ma,
            
            
        ]);
        
    }

    
    function thongtin(){
        if(isset($_POST['txtMatoa'])){
            $matoa=$_POST['txtMatoa']; 
            $ma = $this->ds->all();
        $dulieu = $this->ds->update($matoa);
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu' => $dulieu,
            'ma' => $ma,
            
            
        ]);
        }
        if(isset($_POST['btnThongtin'])){
            $matoa=$_POST['txtMatoa'];
            $sophong=$_POST['txtSophong'];
            $tennv=$_POST['txtTennv'];
            $sdt=$_POST['txtSDT'];
            $dulieu=$this->ds->all();
            $dulieu=$this->ds->update();
            $dulieu=$this->ds->find2();
            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout',[
                'page'=>'Toa_v',
                'dulieu'=>$dulieu,
                'matoa'=>$matoa,
                'sophong'=>$sophong,
                'tennv'=>$tennv,
                'sdt'=>$sdt,
            ]);
        }
       
          
    }
    function sua($tennv)
    {
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu' => $this->ds->find2($tennv),
            'ma' => $this->ds->toa_All(), 
        ]);
    }    
    
    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
           
          
           
            $tennv = $_POST['txtTennv'];
            $sdt = $_POST['txtSDT'];

            // Kiểm tra dữ liệu trống
            if (empty($maphong) || empty($matoa) || empty($songuoi) || empty($tienphong) || empty($trangthai)) {
                echo "<script>alert('Không để trống dữ liệu !')</script>";

                $dulieu = $this->ds->find($maphong, $matoa, $songuoi, $tienphong, $trangthai);
                $this->view('Masterlayout', [
                    'page' => 'DanhsachPhong_v',
                    'dulieu' => $dulieu,
                    'ma' => $this->ds->toa_All(),
                    'maphong' => $maphong,
                    'matoa' => $matoa,
                    'songuoi' => $songuoi,
                    'tienphong' => $tienphong,
                    'trangthai' => $trangthai,
                ]);
            } else {
                // Gọi hàm update dữ liệu trong model
                $kq = $this->ds->update($maphong, $matoa, $songuoi, $tienphong, $trangthai);

                if ($kq) {
                    echo "<script>alert('Sửa thành công!')</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!')</script>";
                }

                // Lấy lại tất cả dữ liệu để hiển thị
                $dulieu = $this->ds->all();
                $ma = $this->ds->toa_All();
                $ma1 = $this->ds->toa_All();
                $this->view('Masterlayout', [
                    'page' => 'DanhsachPhong_v',
                    'dulieu' => $dulieu,
                    'ma' => $ma,
                    'ma1' => $ma1,
                    // 'maphong' => $maphong,
                    // 'matoa' => $matoa,
                    // 'songuoi' => $songuoi,
                    // 'tienphong' => $tienphong,
                    // 'trangthai' => $trangthai,
                ]);
            }
        }
        //Gọi lại giao diện và truyền $dulieu ra
    }
     

    function xoa($matoa){
        $kq=$this->ds->delete($matoa);
        if($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        
        $dulieu=$this->ds->all();
        $this->view('Masterlayout',[
            'page'=>'Toa_v',
            'dulieu'=>$dulieu,
        ]);
    }
    
   
}

?>