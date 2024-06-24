<?php
class themPhong_c extends controller
{
    public $them;

    function __construct()
    {
        $this->them = $this->model('Phong_m');
    }

    function Get_data()
    {
        $ma = $this->them->toa_All();
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'ma' => $ma
        ]);
    }

    function themmoi()
    {
        if (isset($_POST['btnLuuPhong'])) {
            $maphong = $_POST['txtMaphong'];
            $matoa = $_POST['txtMatoa'];
            $songuoi = $_POST['txtSonguoi'];
            $tienphong = $_POST['txtTienphong'];
            $trangthai = $_POST['txtTrangthai'];

            $kq1 = $this->them->checktrungma($maphong);
            $kq2 = $this->them->checkrong($maphong, $matoa, $songuoi, $tienphong, $trangthai);

            if ($kq1) {
                echo "<script>alert('Trùng mã phòng!')</script>";
            } else if ($kq2) {
                echo "<script>alert('Không để trống dữ liệu!')</script>";
            } else {
                $kq = $this->them->insert($maphong, $matoa, $songuoi, $tienphong, $trangthai);

                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else {
                    echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }


        }
        $dulieu = $this->them->all();
        $ma = $this->them->toa_All();
        $ma1 = $this->them->toa_All();
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'dulieu' => $dulieu,
            'ma' => $ma,
            'ma1' => $ma1,
          
        ]);

    }
}

?>
