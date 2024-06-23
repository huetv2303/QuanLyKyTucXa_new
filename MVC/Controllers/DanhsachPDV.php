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
        $dulieu = $this->dsdv->dichvuPDV_all();
        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        $dulieu4 = $this->dsdv->dichvu_idP();

        // var_dump($_GET);

        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'dulieu4' => $dulieu4,

        ]);
    }

    function them()
    {
        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v'
        ]);
    }


    function timkiem()
    {
        if (isset($_POST['btnTimKiem'])) {
            $id_room = $_POST['txtMaPhong'];
            $id_service = $_POST['txtMaDV'];

            $dulieu = $this->dsdv->dichvuPDV_find($id_room, $id_service);
            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('MasterLayout', [
                'page' => 'DanhsachPDV_v',
                'dulieu' => $dulieu,
                'madv' => $id_service,
                'map' => $id_room,
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



        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu = $this->dsdv->dichvuPDV_all();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        $dulieu4 = $this->dsdv->dichvu_idP();




        if (isset($_POST['btnLuu'])) {

            $id = $_POST['txtID'];
            $id_room = $_POST['txtMaPhong'];
            $id_service = $_POST['txtMaDV'];
            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->dsdv->dichvuPDV_upd($id, $id_room, $id_service);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            $id = $_POST['txtID'];
            //Gọi lại giao diện và truyền $dulieu ra

            // var_dump($_GET);

            $dulieu = $this->dsdv->dichvuPDV_all();
            $this->view('MasterLayout', [
                'page' => 'DanhsachPDV_v',
                'dulieu' => $dulieu,
                'dulieu1' => $dulieu1,
                'dulieu2' => $dulieu2,
                'dulieu3' => $dulieu3,
                'dulieu4' => $dulieu4,

            ]);
        }
    }

    function xoa($id)
    {

        // var_dump($_GET);
        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu = $this->dsdv->dichvuPDV_all();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        $dulieu4 = $this->dsdv->dichvu_idP();



        $kq = $this->dsdv->dichvuPDV_del($id);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        //Gọi lại giao diện và truyền $dulieu ra
        // $msv = $_POST['txtMaSinhVien'];
        // $tsv = $_POST['txtTenSinhVien'];


        $dulieu = $this->dsdv->dichvuPDV_all();
        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'dulieu4' => $dulieu4,

        ]);
    }

    function themmoi()
    {



        // var_dump($_GET);

        if (isset($_POST['btnLuu'])) {

            $id_service = $_POST['txtMaDV'];
            $id_room = $_POST['txtMaPhong'];


            $kq = $this->dsdv->dichvuPDV_ins($id_room, $id_service);
            if ($kq) {
                echo "<script>alert('Thêm mới thành công!')</script>";
            } else

                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
        }
        $dulieu1 = $this->dsdv->dichvu_idnamdv();
        $dulieu2 = $this->dsdv->dichvu_idP();
        $dulieu = $this->dsdv->dichvuPDV_all();
        $dulieu3 = $this->dsdv->dichvu_idnamdv();
        $dulieu4 = $this->dsdv->dichvu_idP();
        $this->view('MasterLayout', [
            'page' => 'DanhsachPDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu2' => $dulieu2,
            'dulieu3' => $dulieu3,
            'dulieu4' => $dulieu4,

        ]);
    }
}
// }
