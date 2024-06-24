<?php
class TKDien extends controller
{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('TKDien_m');
    }

    function Get_data()
    {
        // Lấy dữ liệu ban đầu để hiển thị form thống kê nước
        $dulieu1 = $this->dsdv->getid_room();
        $this->view('MasterLayout', [
            'page' => 'TKDien_v',
            'dulieu1' => $dulieu1,
        ]);
    }

    function thongkedien()
    {    

        $dulieu = null;
        $dulieu1 = $this->dsdv->getid_room();
        if (isset($_POST['btnTKD'])) {
            $tkd = $_POST['txtTKD'];
            $dulieu = $this->dsdv->tkdien($tkd);

            // Kiểm tra và xử lý dữ liệu trước khi truyền sang View
          
        }

        // Truyền dữ liệu vào View
        $this->view('MasterLayout', [
            'page' => 'TKDien_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
        ]);
    }
}
?>
