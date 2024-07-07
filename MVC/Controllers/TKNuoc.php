<?php
class TKNuoc extends controller
{
    private $tk;

    function __construct()
    {
        $this->tk = $this->model('TKNuoc_m');
    }

    function Get_data()
    {
        // Lấy dữ liệu ban đầu để hiển thị form thống kê nước
        $dulieu = $this->tk->getMonthlyWaterUsage();
        $dulieu1 = $this->tk->getid_room();
        $toa = $this->tk->get_all_toa();
        $this->view('MasterLayout', [
            'page' => 'TKNuoc_v',
            'dulieu1' => $dulieu1,
            'dulieu' => $dulieu,
            'toa' => $toa
        ]);
    }

    
    function get_phong_by_toa()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->tk->get_phong_by_toa($maToa);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }

    function thongkenuoc()
    {
        $dulieu = null;
        $dulieu1 = $this->tk->getid_room();
        $toa1 = $this->tk->get_all_toa();
        if (isset($_POST['btnTKN'])) {
            $tkn = $_POST['txtTKN'];
            $month = $_POST['SearchMonth'];
            $year = $_POST['SearchYear'];   
            $toa = $_POST['SearchToa'];   

            
            $dulieu = $this->tk->getMonthlyWaterUsage($tkn, $month,$year, $toa);
        }

        // Truyền dữ liệu vào View
        $this->view('MasterLayout', [
            'page' => 'TKNuoc_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'toa' => $toa1

        ]);
    }
}


?>
