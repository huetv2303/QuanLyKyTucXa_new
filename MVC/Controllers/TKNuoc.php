<?php
class TKNuoc extends controller
{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('TKNuoc_m');
    }

    function Get_data()
    {
        // Lấy dữ liệu ban đầu để hiển thị form thống kê nước
        $dulieu1 = $this->dsdv->getid_room();
        $this->view('MasterLayout', [
            'page' => 'TKNuoc_v',
            'dulieu1' => $dulieu1,
        ]);
    }

    function thongkenuoc()
    {    

        $dulieu = null;
        $dulieu1 = $this->dsdv->getid_room();
        if (isset($_POST['btnTKN'])) {
            $tkn = $_POST['txtTKN'];
            $dulieu = $this->dsdv->getMonthlyWaterUsage($tkn);

            // Kiểm tra và xử lý dữ liệu trước khi truyền sang View
          
        }

        // Truyền dữ liệu vào View
        $this->view('MasterLayout', [
            'page' => 'TKNuoc_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
        ]);
    }
}
?>
