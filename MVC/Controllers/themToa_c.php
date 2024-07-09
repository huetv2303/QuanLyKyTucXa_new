<?php
class themToa_c extends controller
{
    public $them;

    function __construct()
    {
        $this->them = $this->model('Toa_m');
    }

    function Get_data() {
       
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            
            
        ]);
        
    }

    function themmoi()
    {
        if (isset($_POST['btnLuuToa'])) {
            $matoa = $_POST['txtMatoa'];
            $sophong = $_POST['txtSophong'];

            $kq1 = $this->them->checktrungma($matoa);
            $kq2 = $this->them->checkrong($matoa,$sophong);

            if ($kq1) {
                echo "<script>alert('Trùng mã toa!')</script>";
            } else if ($kq2) {
                echo "<script>alert('Không để trống dữ liệu!')</script>";
            } else {
                $kq = $this->them->insert($matoa,$sophong);

                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else {
                    echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }


        }
       
        $dulieu = $this->them->all();
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
           'dulieu' => $dulieu,//hiển thị bảng
           
            
            
        ]);

    }
}

?>
