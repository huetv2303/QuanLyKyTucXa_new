<?php
class DanhsachHDDV extends controller
{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('HDDV_m');
    }


  
    function Get_data()
    {

        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
      
        $dulieu = $this->dsdv->hddv_invoice($page, $limit);
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu3 = $this->dsdv->hddv_idP();
        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();
        $this->view('MasterLayout', [
            'page' => 'DanhsachHDDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu3' => $dulieu3,
            'toa' => $toa,
            'toa1' => $toa1,
            'phong' => $phong,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page,
            
        ]);
    }

    
    public function get_total_service_cost()
    {
        if (isset($_POST['maPhong']) && isset($_POST['thang']) && isset($_POST['nam'])) {
            $maPhong = $_POST['maPhong'];
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];
            $total_service_cost = $this->dsdv->get_total_service_cost($maPhong, $thang, $nam);
            echo json_encode(['total_service_cost' => $total_service_cost]);
        } else {
            echo json_encode(['total_service_cost' => 0]);
        }
    }

    function them()
    {
        $this->view('MasterLayout', [
            'page' => 'DanhsachHDDV_v'
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
            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $month = $_POST['txtThang'];
            $year = $_POST['txtNam'];
            $notifications = $_POST['TrangThai'];
            $phong = $this->dsdv->hopdong_idP();
            $toa = $this->dsdv->get_all_toa_hopdong();
            $toa1 = $this->dsdv->get_all_toa_hopdong();
            $dulieu = $this->dsdv->hddv_find($id_invoice, $id_room, $month, $year, $notifications);
            $dulieu1 = $this->dsdv->hddv_idP();
            $dulieu3 = $this->dsdv->hddv_idP();
            $this->view('MasterLayout', [
                'page' => 'DanhsachHDDV_v',
                'dulieu' => $dulieu,
                'dulieu1' => $dulieu1,
                'dulieu3' => $dulieu3,
                'mahd' => $id_invoice,
                'map' => $id_room,
                'toa1' => $toa1,
                'phong' => $phong,
                'toa' => $toa,
                'total_page' => $total_page,
                'limit' => $limit,
                'page_number' => $page


            ]);
        }


     

        if (isset($_POST['btnXuat'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('HD');
            $rowCount = 1;
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Phòng');
            $sheet->setCellValue('C' . $rowCount, 'Mã hóa đơn');
            $sheet->setCellValue('D' . $rowCount, 'Số điện đã dùng');
            $sheet->setCellValue('E' . $rowCount, 'Số nước đã dùng');
            $sheet->setCellValue('F' . $rowCount, 'Tổng điện nước');
            $sheet->setCellValue('G' . $rowCount, 'Tổng dịch vụ khác');
            $sheet->setCellValue('H' . $rowCount, 'Tháng');
            $sheet->setCellValue('I' . $rowCount, 'Năm');
            $sheet->setCellValue('J' . $rowCount, 'Tổng');
            $sheet->setCellValue('K' . $rowCount, 'Trạng thái');

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            //gán màu nền
            $sheet->getStyle('A1:K1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            //căn giữa
            $sheet->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $id_invoice = $_POST['MaHD1'];
            $id_room = $_POST['MaPhong1'];
            $month = $_POST['month1'];
            $year = $_POST['year1'];
            $status = $_POST['TrangThai1'];
            $dulieu = $this->dsdv->hddv_find($id_invoice, $id_room, $month, $year,$status );

            $rowCount = 2;
            while ($row = mysqli_fetch_array($dulieu)) {

                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['id_room']);
                $sheet->setCellValue('C' . $rowCount, $row['id_invoice']);
                $sheet->setCellValue('D' . $rowCount, $row['electricity_usage']);
                $sheet->setCellValue('E' . $rowCount, $row['water_usage']);
                $sheet->setCellValue('F' . $rowCount, $row['total_electricity_water_cost']);
                $sheet->setCellValue('G' . $rowCount, $row['total_service_cost']);
                $sheet->setCellValue('H' . $rowCount, $row['month']);
                $sheet->setCellValue('I' . $rowCount, $row['year']);
                $sheet->setCellValue('J' . $rowCount, $row['total_cost']);
                $sheet->setCellValue('K' . $rowCount, $row['status']);
                $rowCount++;
            }
            //Kẻ bảng 
            // $styleAray = array(
            //     'borders' => array(
            //         'allborders' => array(
            //             'style' => PHPExcel_Style_Border::BORDER_THIN
            //         )
            //     )
            // );
            // $sheet->getStyle('A1:' . 'G1' . ($rowCount))->applyFromArray($styleAray);
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'ExportExcel.xlsx';
            $objWriter->save($fileName);
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Type: application/vnd.openxlmformatsofficedocument.speadsheetml.sheet');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Transfer-Encoding:binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: no-cache');
            readfile($fileName);
            unlink($fileName);
            exit;
        }
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

    function sua($id_service)
    {
        $this->view('MasterLayout', [
            'page' => 'dichvu_sua_v',
            'dulieu' => $this->dsdv->hddv_find($id_service, '')
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $electricity = $_POST['txtDien'];
            $water = $_POST['txtNuoc'];
            $ended_day = $_POST['txtNgayKT'];
            $status = $_POST['txtTrangThai'];
            $soDien = $_POST['txtDienBD'];
            $khoiNuoc = $_POST['txtNuocBD'];
            $month = $_POST['txtThang'];
            $year = $_POST['txtNam'];
            $maToa  = $_POST['txtMaToa'];

            //gọi hàm sủa dl tacgia_udp trong model
            

           

                    $kq = $this->dsdv->hddv_upd($id_invoice, $maToa, $id_room, $soDien, $khoiNuoc, $electricity, $water, $month, $year,  $ended_day, $status);
                    if ($kq) {
                        echo "<script>alert('Sửa thành công!')</script>";
                    } else
                        echo "<script>alert('Sửa thất bại!')</script>";
        }
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $dulieu = $this->dsdv->hddv_invoice($page, $limit);
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu3 = $this->dsdv->hddv_idP();
        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();
        $this->view('MasterLayout', [
            'page' => 'DanhsachHDDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu3' => $dulieu3,
            'toa' => $toa,
            'toa1' => $toa1,
            'phong' => $phong,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page
        ]);
    }
    function xoa($id_service)
    {
        $kq = $this->dsdv->hddv_del($id_service);


        // Display the alert based on the result of deletion
        if ($kq) {
            echo "<script>
                    alert('Xóa thành công!');
                  </script>";
        } else {
            echo "<script>
                    alert('Xóa thất bại!');
                  </script>";
        }

        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $dulieu = $this->dsdv->hddv_invoice($page, $limit);
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu3 = $this->dsdv->hddv_idP();
        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();
        $this->view('MasterLayout', [
            'page' => 'DanhsachHDDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu3' => $dulieu3,
            'toa' => $toa,
            'toa1' => $toa1,
            'phong' => $phong,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page
        ]);

    }

    function themmoi()
    {
        if (isset($_POST['btnLuu'])) {


            // Kiểm tra trùng mã
            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $electricity = $_POST['txtDien'];
            $water = $_POST['txtNuoc'];
            // $created_day = $_POST['txtNgayTao'];
            $ended_day = $_POST['txtNgayKT'];
            $status = $_POST['txtTrangThai'];
            $soDien = $_POST['txtDienBD'];
            $khoiNuoc = $_POST['txtNuocBD'];
            $month = $_POST['txtThang'];
            $year = $_POST['txtNam'];
            $maToa = $_POST['txtMaToa'];



            // Gọi lại giao diện và truyền $dulieu ra
            $kq1 = $this->dsdv->check_trung_ma($id_invoice);
            $kq2 = $this->dsdv->check_trung_thangnam($month, $year);
            if ($month > 12) {
                echo "<script>alert('Tháng này không tồn tại, vui lòng điền tháng <= 12!')
                </script>";
            } else {

                if ($kq1) {
                    echo "<script>
                    alert('Trùng mã!');
                  </script>";
                } else if ($kq2) {
                    echo "<script>
                    alert('Tháng năm của hóa đơn này đã tồn tại!');
                  </script>";
                } else {
                    // Gọi hàm thêm dl trong model
                    $kq = $this->dsdv->hddv_ins($id_invoice, $maToa, $id_room, $soDien, $khoiNuoc, $electricity, $water, $month, $year, $ended_day, $status);

                    if ($kq) {
                        echo "<script>
                        alert('Thêm mới thành công!');
                      </script>";
                    } else {
                        echo "<script>
                        alert('Thêm mới thất bại!');
                      </script>";
                    }
                }
            }
        }
        $page = 1;
        if (isset($_GET['page']))  $page = $_GET['page'];
        $limit = 5;
        $total = $this->dsdv->count();
        $total_page = ceil($total / $limit);
        $dulieu = $this->dsdv->hddv_invoice($page, $limit);
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu3 = $this->dsdv->hddv_idP();
        $phong = $this->dsdv->hopdong_idP();
        $toa = $this->dsdv->get_all_toa_hopdong();
        $toa1 = $this->dsdv->get_all_toa_hopdong();
        $this->view('MasterLayout', [
            'page' => 'DanhsachHDDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu3' => $dulieu3,
            'toa' => $toa,
            'toa1' => $toa1,
            'phong' => $phong,
            'total_page' => $total_page,
            'limit' => $limit,
            'page_number' => $page
        ]);
    }
}
    
// }
