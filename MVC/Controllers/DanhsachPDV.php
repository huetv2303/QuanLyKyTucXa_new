<?php
class DanhsachPDV extends controller
{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('PDV_m');
    }

    // index, create, store, edit, update, destroy(delete) 

    function Get_data()
    {

        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $dulieu = $this->dsdv->dichvuPDV_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);

        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        $dulieu2 = $this->dsdv->hopdong_idP();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        $phong = $this->dsdv->hopdong_idP();
         $toa = $this->dsdv->get_all_toa_hopdong();
         $toa1 = $this->dsdv->get_all_toa_hopdong();
        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'phong' => $phong,
            'toa' => $toa,
            'toa1' => $toa1,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }


    function get_phong_by_toa_hopdong()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->dsdv->get_phong_by_toa_hopdong($maToa);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }
    function them()
    {
        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v'
        ]);
    }


    function timkiem()
    {
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        // $dulieu = $this->dsdv->dichvuPDV_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        if (isset($_POST['btnTimKiem'])) {
            $id_service = $_POST['txtMaDV'];
            $id_room = $_POST['txtMaPhong'];
            $month = $_POST['txtThang'];
            $year = $_POST['txtNam'];

            $timkiem = $this->dsdv->dichvuPDV_find($id_room, $id_service, $month, $year);
            $dulieu1 = $this->dsdv->dichvu_idnamdv();
            $dulieu2 = $this->dsdv->dichvu_idP();
            $dulieu3 = $this->dsdv->dichvu_idnamdv();
            $dulieu4 = $this->dsdv->dichvu_idP();
            $phong = $this->dsdv->hopdong_idP();
            $toa = $this->dsdv->get_all_toa_hopdong();
            $toa1 = $this->dsdv->get_all_toa_hopdong();
            $this->view('MasterLayout', [
                'page' => 'DanhsachPDV_v',
                'dulieu1' => $dulieu1,
                'dulieu2' => $dulieu2,
                'dulieu3' => $dulieu3,
                'dulieu4' => $dulieu4,
                'dulieu' => $timkiem,
                'phong' => $phong,
                'toa' => $toa,
                'toa1' => $toa1,
                'madv' => $id_service,
                'map' => $id_room,
                'total_page' => $total_page,
                'limit' => $limit,
                'page_number' => $page

            ]);
        }
    }


    function sua($id)
    {
        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $this->dsdv->dichvuPDV_find($id, '')
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnLuu'])) {

            $id = $_POST['txtID'];
            $id_service = $_POST['txtMaDV'];
            $id_room = $_POST['txtMaPhong'];
            $month = $_POST['txtThang'];
            $year = $_POST['txtNam'];
            $maToa = $_POST['txtMaToa'];
            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->dsdv->dichvuPDV_upd( $id,$maToa, $id_room, $id_service, $month, $year);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

        }
        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();;
        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        // $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        // $dulieu4 = $this->dsdv->dichvu_idP();
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 3;
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $dulieu = $this->dsdv->dichvuPDV_all($page, $limit);

        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            // 'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'phong' => $phong,
            'toa' => $toa,
            'toa1' => $toa1,
            // 'dulieu4' => $dulieu4,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }

    function xoa($id)
    {
        $kq = $this->dsdv->dichvuPDV_del($id);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        //Gọi lại giao diện và truyền $dulieu ra
        // $msv = $_POST['txtMaSinhVien'];
        // $tsv = $_POST['txtTenSinhVien'];


        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $dulieu = $this->dsdv->dichvuPDV_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);

        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();
        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        // $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        // $dulieu4 = $this->dsdv->dichvu_idP();

        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            // 'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'phong' => $phong,
            'toa' => $toa,
            'toa1' => $toa1,
            // 'dulieu4' => $dulieu4,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }

    function themmoi()
    {



        // var_dump($_GET);

        if (isset($_POST['btnLuu'])) {

            $id_service = $_POST['txtMaDV'];
            $id_room = $_POST['txtMaPhong'];
            $month = $_POST['txtThang'];
            $year = $_POST['txtNam'];
            $maToa = $_POST['txtMaToa'];



            $kq1 = $this->dsdv->check_trung_ma($id_room, $id_service, $month,$year );
            if ($kq1) {
                echo "<script>alert('Phòng đã sử dụng dịch vụ này!')</script>";
            } else {
                $kq = $this->dsdv->dichvuPDV_ins($maToa, $id_room, $id_service, $month, $year);
                if ($kq)
                    echo "<script>alert('Thêm mới thành công!')</script>";
                else

                    echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            }
        }
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $dulieu = $this->dsdv->dichvuPDV_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);


        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();
        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        // $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        // $dulieu4 = $this->dsdv->dichvu_idP();

        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            // 'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'phong' => $phong,
            'toa' => $toa,
            'toa1' => $toa1,
            // 'dulieu4' => $dulieu4,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }
}
// }
