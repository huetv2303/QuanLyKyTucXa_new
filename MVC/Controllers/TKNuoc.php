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
        $phong = $this->tk->hopdong_idP();
        $toa = $this->tk->get_all_toa_hopdong();
        // $toa1 = $this->tk->get_all_toa_hopdong();
        $this->view('MasterLayout', [
            'page' => 'TKNuoc_v',
            'dulieu' => $dulieu,
            'toa' => $toa,
            'phong' => $phong
        ]);
    }

    
    function get_phong_by_toa_hopdong()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->tk->get_phong_by_toa_hopdong($maToa);
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
        $toa = $this->tk->get_all_toa_hopdong();
        $phong = $this->tk->hopdong_idP();
        if (isset($_POST['btnTKN'])) {
            $month = $_POST['SearchMonth'];
            $year = $_POST['SearchYear'];   
            $maPhong = $_POST['txtMaPhong'];   
            $maToa = $_POST['txtMaToa'];   
            
            $dulieu = $this->tk->getMonthlyWaterUsage($maPhong, $month,$year, $maToa);
        }

        // Truyền dữ liệu vào View
        $this->view('MasterLayout', [
            'page' => 'TKNuoc_v',
            'dulieu' => $dulieu,
            'toa' => $toa,
            'phong' => $phong

        ]);
    }
}


?>
