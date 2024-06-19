<?php
class DanhsachDV extends controller
{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('DichVu_m');
    }

    function Get_data()
    {

        $dulieu = $this->dsdv->dichvu_all();

        $this->view('LayoutDV', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,


        ]);
    }

    function them()
    {
        $this->view('LayoutDV', [
            'page' => 'DanhsachDV_v'
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
                $id_service = $sheetData[$i]["A"];
                $name = $sheetData[$i]["B"];
                $price = $sheetData[$i]["C"];
                $unit = $sheetData[$i]["D"];
                $note = $sheetData[$i]["E"];
                $kq= $this->dsdv->dichvu_ins($id_service, $name, $price, $unit, $note);
                
            }
            if($kq){
                echo "<script>alert('import thành công!')</script>";
            }else
            echo "<script>alert('import thất bại!')</script>";
           
        }

        $dulieu = $this->dsdv->dichvu_all();
        $this->view('LayoutDV', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,

        ]);
    }

    function timkiem()
    {
        if (isset($_POST['btnTimKiem'])) {
            $id_service = $_POST['txtMaDV'];
            $name = $_POST['txtTenDV'];
            $dulieu = $this->dsdv->dichvu_find($id_service, $name);
            $dulieu1 = $this->dsdv->dichvu_all();
            //Gọi lại giao diện và truyền $dulieu ra

            $this->view('LayoutDV', [
                'page' => 'DanhsachDV_v',
                'dulieu' => $dulieu,
                'madv' => $id_service,
                'tendv' => $name,
                'dulieu1' => $dulieu1,
            ]);
        }

       
    }

    function sua($id_service)
    {
        $this->view('LayoutDV', [
            'page' => 'dichvu_sua_v',
            'dulieu' => $this->dsdv->dichvu_find($id_service, '')
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnLuu'])) {

            $id_service = $_POST['txtMaDV'];
            $name = $_POST['txtTenDV'];
            $price = $_POST['txtGia'];
            $unit = $_POST['txtDonVi'];
            $note = $_POST['txtGhiChu'];
            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->dsdv->dichvu_upd($id_service, $name, $price, $unit, $note);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            //Gọi lại giao diện và truyền $dulieu ra

            $dulieu = $this->dsdv->dichvu_all();
            $this->view('LayoutDV', [
                'page' => 'DanhsachDV_v',
                'dulieu' => $dulieu,

            ]);
        }
    }

    function xoa($id_service)
    {
        $kq = $this->dsdv->dichvu_del($id_service);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        //Gọi lại giao diện và truyền $dulieu ra


        $dulieu = $this->dsdv->dichvu_all();
        $this->view('LayoutDV', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,

        ]);
    }

    function themmoi()
    {

        if (isset($_POST['btnLuuDV'])) {

            $id_service = $_POST['txtMaDV'];
            $name = $_POST['txtTenDV'];
            $price = $_POST['txtGia'];
            $unit = $_POST['txtDonVi'];
            $note = $_POST['txtGhiChu'];


            // if ($id == '' || $ml == '' || $tl == '' || $mk == '') {
            //     echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            //     $this->view('LayoutDV', [
            //         'page' => 'DichVu_v',

            //     ]);
            // } else {
            //Kiểm tra trùng mã tác giả
            $kq1 = $this->dsdv->check_trung_ma($id_service);
            if ($kq1) {
                echo "<script>alert('Trùng  mã!')</script>";
                $this->view('LayoutDV', [
                    'page' => 'DanhsachDV_v',

                ]);
            } else {
                //gọi hàm thêm dl tacgia_ins trong model
                $kq = $this->dsdv->dichvu_ins($id_service, $name, $price, $unit, $note);

                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else

                    echo "<script>alert('Thêm mới thất bại!')</script>";
            }
        }
        $dulieu = $this->dsdv->dichvu_all();
        $this->view('LayoutDV', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,

        ]);
    }
}
// }
