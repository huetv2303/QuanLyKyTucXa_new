<?php 
class themPhong_c extends controller {
    public $them;
    
    function __construct() {
        $this->them = $this->model('Phong_m');
    }
    
    function Get_data() {
        
        $ma = $this->them->toa(); // Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'ma' => $ma // Truyền dữ liệu vào view
        ]);
    }    
    function themmoi() {
        if (isset($_POST['btnLuu'])) {
            $maphong=$_POST['txtMaphong'];
            $matoa=$_POST['txtMatoa'];
            $songuoi=$_POST['txtSonguoi'];
            $tienphong=$_POST['txtTienphong'];
            $trangthai=$_POST['txtTrangthai'];
            
            // Kiểm tra trùng mã
            $kq1 = $this->them->checktrungma($maphong);
            //$kq3 = $this->them->checktrungmalop($malop);
            // Kiểm tra các trường dữ liệu rỗng
            $kq2 = $this->them->checkrong($maphong,$matoa,$songuoi,$tienphong,$trangthai);
            
            if ($kq1) {
                echo "<script>alert('Trùng mã phòng !')</script>";

            } 
           
            else if ($kq2) {
                echo "<script>alert('Không để trống dữ liệu !')</script>";
            } else {
                // Chèn dữ liệu nếu không trùng mã và không có trường dữ liệu rỗng
                $kq = $this->them->insert($maphong,$songuoi,$tienphong,$trangthai);
                
                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else {
                    echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }
            
            // Tái render view với dữ liệu đã cung cấp
            $this->view('Masterlayout', [
                'page' => 'DanhsachPhong_v',
                // 'ma' => $this->them -> toa(),
                'maphong'=>$maphong,
                'matoa'=>$matoa,
                'songuoi'=>$songuoi,
                'tienphong'=>$tienphong,
                'trangthai'=>$trangthai,
                
            ]);
        }
    }
}

?>
