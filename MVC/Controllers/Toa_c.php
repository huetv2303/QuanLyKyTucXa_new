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
           'dulieu' => $dulieu,//hiển thị bảng
            'ma' => $ma,//load cbo
            
            
        ]);
        
    }

    
    function thongtin(){
        if(isset($_POST['txtMatoa'])){
            $matoa=$_POST['txtMatoa']; 
            $ma = $this->ds->all();//load_cbo
            $dulieu = $this->ds->truyen($matoa);//bắt trùng điều kiện để lọc tòa
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu' => $dulieu,
            'ma' => $ma,
            
            
        ]);
        }
        // if(isset($_POST['btnThongtin'])){
        //     $matoa=$_POST['txtMatoa'];
        //     $sophong=$_POST['txtSophong'];
        //     $tennv=$_POST['txtTennv'];
        //     $sdt=$_POST['txtSDT'];
        //     $dulieu=$this->ds->all_toa();
        //     $dulieu=$this->ds->find2();
        //     //Gọi lại giao diện và truyền $dulieu ra
        //     $this->view('Masterlayout',[
        //         'page'=>'Toa_v',
        //         'dulieu'=>$dulieu,
        //         'matoa'=>$matoa,
        //         'sophong'=>$sophong,
        //         'tennv'=>$tennv,
        //         'sdt'=>$sdt,
        //     ]);
        // }
       
          
    }
    function sua($tennv)
    {
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu1' => $this->ds->find2($tennv),
            'dulieu' => $this->ds->toa_All(), 
            'dulieu2'=>$this->ds->all(),
        ]);
    }    
    
    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $matoa=$_POST['txtMatoa'];
            $sophong = $_POST['txtSophong'];
            $manv=$_POST['txtManv'];
            $tennv = $_POST['txtTennv'];
            $sdt = $_POST['txtSDT'];

            // Kiểm tra dữ liệu trống
            if (empty($sophong) ||empty($tennv) || empty($sdt)) {
                echo "<script>alert('Không để trống dữ liệu !')</script>";

                $dulieu1 = $this->ds->find($tennv, $sdt,);
                $dulieu2 = $this->ds->find($sophong);
                $this->view('Masterlayout', [
                    'page' => 'Toa_v',
                    'dulieu1' => $dulieu1,
                    'dulieu2' => $dulieu2,
                     'dulieu' => $this->ds->toa_All(),
                    
                    'tennv' => $tennv,
                    'sdt' => $sdt,
                    'sophong' =>$sophong,
                
                   
                ]);
            } else {
                // Gọi hàm update dữ liệu trong model
                $kq = $this->ds->update1($sophong,$matoa);//update thông tin bảng toa
                $dulieu3 = $this->ds->update2($tennv,$sdt,$manv);//update thông tin bảng nhân viên

                if ($kq||$dulieu3) {
                    echo "<script>alert('Sửa thành công!')</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!')</script>";
                }

                // Lấy lại tất cả dữ liệu để hiển thị
                $ma = $this->ds->all();
                $dulieu = $this->ds->all_toa();
                $this->view('Masterlayout', [
                    'page' => 'toa_v',
                    'dulieu' => $dulieu,
                    'ma' => $ma,
                  
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
     

    function xoa($tennv){
        $kq=$this->ds->delete($tennv);
        if($kq)
            echo "<script>alert('Xóa  thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        
        $dulieu=$this->ds->all_toa();
        $this->view('Masterlayout',[
            'page'=>'Toa_v',
            'dulieu'=>$dulieu,
        ]);
    }
    
   
}

?>