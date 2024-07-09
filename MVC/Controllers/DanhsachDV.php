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
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $dulieu = $this->dsdv->dichvu_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }



    function them()
    {
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v'
        ]);
    }

    function import()
    {
        if (isset($_POST['btnUpLoad'])) {
            if (empty($_FILES['txtfile']['name'])) {
                echo "<script>alert('Vui lòng chọn file!')</script>";
            } elseif ($_FILES['txtfile']['size'] == 0) {
                echo "<script>alert('File không được để trống!')</script>";
            } else {
                $file = $_FILES['txtfile']['tmp_name'];
                $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                $objExcel = $objReader->load($file);
                // Lấy sheet hiện tại
                $sheetData = $objExcel->getActiveSheet()->toArray(null, true, true, true);
                $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                $importSuccess = true;

                for ($i = 2; $i <= $highestRow; $i++) {
                    $id_service = $sheetData[$i]["A"];
                    $name = $sheetData[$i]["B"];
                    $price = $sheetData[$i]["C"];
                    $unit = $sheetData[$i]["D"];
                    $note = $sheetData[$i]["E"];

                    if (empty($id_service) || empty($name) || empty($price) || empty($unit)) {
                        echo "<script>alert('Vui lòng điền đầy đủ thông tin ở hàng {$i}!')</script>";
                        $importSuccess = false;
                        continue;
                    }

                    // Kiểm tra trùng mã dịch vụ và tên dịch vụ
                    $kq1 = $this->dsdv->check_trung_ma($id_service);
                    $kq2 = $this->dsdv->check_name($name);
                    if ($kq1) {
                        echo "<script>alert('Mã dịch vụ ở hàng {$i} đã tồn tại!')</script>";
                        $importSuccess = false;
                        continue;
                    } elseif ($kq2) {
                        echo "<script>alert('Tên dịch vụ ở hàng {$i} đã tồn tại!')</script>";
                        $importSuccess = false;
                        continue;
                    } else {
                        // Gọi hàm thêm dl dichvu_ins trong model
                        $kq = $this->dsdv->dichvu_ins($id_service, $name, $price, $unit, $note);
                        if (!$kq) {
                            echo "<script>alert('Import thất bại ở hàng {$i}!')</script>";
                            $importSuccess = false;
                        }
                    }
                }

                if ($importSuccess) {
                    echo "<script>alert('Import thành công!')</script>";
                } else {
                    echo "<script>alert('Có lỗi xảy ra khi import! Vui lòng kiểm tra lại.')</script>";
                }
            }
        }
        
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;

        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $dulieu = $this->dsdv->dichvu_all($page, $limit);
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }


    function timkiem()
    {
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        if (isset($_POST['btnTimKiem'])) {
            $id_service = $_POST['txtMaDV'];
            $name = $_POST['txtTenDV'];
            if ($id_service == '' &&  $name == '') {
                $dulieu = $this->dsdv->dichvu_all($page, $limit);
            } else {
                $dulieu = $this->dsdv->dichvu_find($id_service, $name);
            }
            //Gọi lại giao diện và truyền $dulieu ra

            $this->view('MasterLayout', [
                'page' => 'DanhsachDV_v',
                'dulieu' => $dulieu,
                'madv' => $id_service,
                'tendv' => $name,
                'total_page' => $total_page,
                'limit' => $limit,
                'page_number' => $page
            ]);
        }
    }

    function sua($id_service)
    {
        $this->view('MasterLayout', [
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
            if ($id_service == '' || $name == '' || $price == '' || $unit == '') {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            } else {
                //gọi hàm thêm dl tacgia_ins trong model
                if ($kq) {
                    echo "<script>alert('Sửa thành công!')</script>";
                } else
                    echo "<script>alert('Sửa thất bại!')</script>";
            }
        }
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;

        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $dulieu = $this->dsdv->dichvu_all($page, $limit);
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }

    function xoa($id_service)
    {
        $kq = $this->dsdv->dichvu_del($id_service);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Hiện có phòng đang sử dụng dịch vụ này không thể xóa được')</script>";
        //Gọi lại giao diện và truyền $dulieu ra


        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $dulieu = $this->dsdv->dichvu_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

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

            if ($id_service == '' || $name == '' || $price == '' || $unit == '') {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            } else {
                //Kiểm tra trùng mã tác giả
                $kq1 = $this->dsdv->check_trung_ma($id_service);
                $kq2 = $this->dsdv->check_name($name);
                if ($kq1) {
                    echo "<script>alert('Mã dịch vụ đã tồn tại!')</script>";
                } else if ($kq2) {
                    echo "<script>alert(' Tên dịch vụ này đã tồn tại!')</script>";
                } else {
                    //gọi hàm thêm dl tacgia_ins trong model
                    $kq = $this->dsdv->dichvu_ins($id_service, $name, $price, $unit, $note);

                    if ($kq) {
                        echo "<script>alert('Thêm mới thành công!')</script>";
                    } else

                        echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }
        }
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $dulieu = $this->dsdv->dichvu_all($page, $limit);
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $this->view('MasterLayout', [
            'page' => 'DanhsachDV_v',
            'dulieu' => $dulieu,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page

        ]);
    }
}
// }
