<?php
class TKDien extends controller
{
    private $tk;

    function __construct()
    {
        $this->tk = $this->model('TKDien_m');
    }

    function Get_data()
    {
        // Lấy dữ liệu ban đầu để hiển thị form thống kê 
        $dulieu = $this->tk->getMonthlyElectricityUsage();
        $dulieu1 = $this->tk->getid_room();
        $toa = $this->tk->get_all_toa();
        $this->view('MasterLayout', [
            'page' => 'TKDien_v',
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

    function thongkedien()
    {
        $dulieu = null;
        $dulieu1 = $this->tk->getid_room();
        $toa1 = $this->tk->get_all_toa();
        if (isset($_POST['btnTKD'])) {
            $tkd = $_POST['txtTKD'];
            $month = $_POST['SearchMonth'];
            $year = $_POST['SearchYear'];   
            $toa = $_POST['SearchToa'];   

            
            $dulieu = $this->tk->getMonthlyElectricityUsage($tkd, $month,$year, $toa);
        }

        // Truyền dữ liệu vào View
        $this->view('MasterLayout', [
            'page' => 'TKDien_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'toa' => $toa1

        ]);
    }
}


?>
