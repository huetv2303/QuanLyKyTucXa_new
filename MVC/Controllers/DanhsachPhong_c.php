<?php 
class DanhsachPhong_c extends controller{
    private $ds;
    function __construct()
    {
        $this->ds=$this->model('Phong_m');
    }

    function Get_data(){
        $dulieu = $this->ds->all();
        $ma=$this->ds-> toa_All();
        $this->view('Masterlayout',[
            'page'=>'DanhsachPhong_v',
            'dulieu'=>$dulieu,
            'ma'=>$ma,// Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
        
    ]);
    }
    function import()
    {
        if (isset($_POST['btnUpLoad'])) {
            $file = $_FILES['txtfile']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objExcel = $objReader->load($file);
            //Lấy sheet hiện tại
            $sheetData = $objExcel->getActiveSheet()->toArray(null, true, true, true);
            $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

            for ($i = 2; $i <= $highestRow; $i++) {
                $maphong = $sheetData[$i]["A"];
                $matoa = $sheetData[$i]["B"];
                $songuoi = $sheetData[$i]["C"];
                $tienphong = $sheetData[$i]["D"];
                $trangthai = $sheetData[$i]["E"];
                $kq = $this->ds->find($maphong,$matoa,$songuoi,$tienphong,$trangthai);
            }

            if ($maphong == '' || $matoa == '' || $songuoi == '' || $tienphong == '' || $trangthai) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            } else {
                //Kiểm tra trùng mã tác giả
                $kq1 = $this->ds->check_trung_ma($maphong);
                $kq2 = $this->ds->check_name($matoa);
                if ($kq1) {
                    echo "<script>alert('Mã dịch vụ đã tồn tại!')</script>";
                } else if ($kq2) {
                    echo "<script>alert(' Tên dịch vụ này đã tồn tại!')</script>";
                } else {
                    //gọi hàm thêm dl tacgia_ins trong model
                    $kq = $this->ds->find($maphong,$matoa,$songuoi,$tienphong,$trangthai);

                    if ($kq) {
                        echo "<script>alert('Import thành công!')</script>";
                    } else

                        echo "<script>alert('Import thất bại!')</script>";
                }
            }

        }

        $dulieu = $this->ds->find();
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,

        ]);
    }
    function timkiem(){
        if(isset($_POST['btnTimkiem'])){
            $maphong=$_POST['txtTimkiem'];
            $matoa=$_POST['txtTimkiem'];
            $trangthai=$_POST['txtTimkiem'];
            // $tienphong=$_POST['txtTimkiem'];
            $dulieu=$this->ds->find($maphong,$matoa,$trangthai);
            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout',[
                'page'=>'DanhsachPhong_v',
                'dulieu'=>$dulieu,
                'maphong'=>$maphong,
                    'matoa'=>$matoa,
                    'trangthai'=>$trangthai,
                
            ]);
        }
       
          
    }
    
     

    function xoa($maphong){
        $kq=$this->ds->delete($maphong);
        if($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        
        $dulieu=$this->ds->all();
        $this->view('Masterlayout',[
            'page'=>'DanhsachPhong_v',
            'dulieu'=>$dulieu,
        ]);
    }
    function sua($maphong){
        $this->view('Masterlayout',[
            'page'=>'DanhsachPhong_v',
            'dulieu'=>$this->ds->find2($maphong),
            'ma'=> $this->ds->toa_All(), // Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
        ]);
    }
    function suadl(){
        if(isset($_POST['btnLuu'])){
            $maphong = $_POST['txtMaphong'];
            $matoa = $_POST['txtMatoa'];
            $songuoi = $_POST['txtSonguoi'];
            $tienphong = $_POST['txtTienphong'];
            $trangthai = $_POST['txtTrangthai'];
    
            // Kiểm tra dữ liệu trống
            if(empty($maphong) || empty($matoa) || empty($songuoi) || empty($tienphong) || empty($trangthai)){
                echo "<script>alert('Không để trống dữ liệu !')</script>";
    
                $dulieu = $this->ds->find($maphong, $matoa, $songuoi, $tienphong, $trangthai);
                $this->view('Masterlayout',[
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
                
                if($kq){
                    echo "<script>alert('Sửa thành công!')</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!')</script>";
                }
    
                // Lấy lại tất cả dữ liệu để hiển thị
                $dulieu = $this->ds->all();
                $this->view('Masterlayout',[
                    'page' => 'DanhsachPhong_v',
                    'dulieu' => $dulieu,
                    'ma' => $this->ds->toa_All(),
                    'maphong' => $maphong,
                    'matoa' => $matoa,
                    'songuoi' => $songuoi,
                    'tienphong' => $tienphong,
                    'trangthai' => $trangthai,
                ]);
            }
        }
    }
}
?>