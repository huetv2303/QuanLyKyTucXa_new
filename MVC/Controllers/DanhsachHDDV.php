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

        $dulieu = $this->dsdv->hddv_invoice();
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu3 = $this->dsdv->hddv_idP();
        $this->view('LayoutDV', [
            'page' => 'DanhsachHDDV_v',
            'dulieu' => $dulieu,
            'dulieu1' => $dulieu1,
            'dulieu3' => $dulieu3

        ]);
    }

    function them()
    {
        $this->view('LayoutDV', [
            'page' => 'DanhsachHDDV_v'
        ]);
    }


    function timkiem()
    {
        if (isset($_POST['btnTimKiem'])) {
            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $dulieu = $this->dsdv->hddv_find($id_invoice, $id_room);
            $dulieu2 = $this->dsdv->hddv_idP();
            $dulieu3 = $this->dsdv->hddv_idP();

            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('LayoutDV', [
                'page' => 'DanhsachHDDV_v',
                'dulieu' => $dulieu,
                'dulieu2' => $dulieu2,
                'dulieu3' => $dulieu3,
                'mahd' => $id_invoice,
                'map' => $id_room,
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
            $sheet->setCellValue('D' . $rowCount, 'Số điện');
            $sheet->setCellValue('E' . $rowCount, 'Số nước');
            $sheet->setCellValue('F' . $rowCount, 'Tổng điện nước');
            $sheet->setCellValue('G' . $rowCount, 'Tổng dịch vụ khác');
            $sheet->setCellValue('H' . $rowCount, 'Trạng thái');
            $sheet->setCellValue('I' . $rowCount, 'Tổng');

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            //gán màu nền
            $sheet->getStyle('A1:I1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            //căn giữa
            $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $id_invoice = $_POST['MaHD1'];
            $id_room = $_POST['MaPhong1'];
            $dulieu = $this->dsdv->hddv_find($id_invoice, $id_room);
           
            $rowCount = 2;
            while ($row = mysqli_fetch_array($dulieu)) {
              
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['id_room']);
                $sheet->setCellValue('C' . $rowCount, $row['id_invoice']);
                $sheet->setCellValue('D' . $rowCount, $row['electricity']);
                $sheet->setCellValue('E' . $rowCount, $row['water']);
                $sheet->setCellValue('F' . $rowCount, $row['tong_dien_nuoc']);
                $sheet->setCellValue('G' . $rowCount, $row['tong_dich_vu_khac']);
                $sheet->setCellValue('H' . $rowCount, $row['status']);
                $sheet->setCellValue('I' . $rowCount, $row['tong_tat_ca']);
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
        }
    }


    function ExportExcel()
    {
        if (isset($_POST['btnXuat'])) {
             // Adjust the path to the PHPExcel library

            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSLS');
            $rowCount = 1;

            // Create column headers
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Phòng');
            $sheet->setCellValue('C' . $rowCount, 'Mã hóa đơn');
            $sheet->setCellValue('D' . $rowCount, 'Số điện');
            $sheet->setCellValue('E' . $rowCount, 'Số nước');
            $sheet->setCellValue('F' . $rowCount, 'Tổng điện nước');
            $sheet->setCellValue('G' . $rowCount, 'Tổng dịch vụ khác');
            $sheet->setCellValue('H' . $rowCount, 'Trạng thái');
            $sheet->setCellValue('I' . $rowCount, 'Tổng');

            // Apply styles
            $sheet->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // Fetch data from database
            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $dulieu = $this->dsdv->hddv_find($id_invoice, $id_room);

            // Populate the Excel sheet with data
            $rowCount = 2; // Start from the second row for data
            while ($row = mysqli_fetch_array($dulieu)) {
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['id_room']);
                $sheet->setCellValue('C' . $rowCount, $row['id_invoice']);
                $sheet->setCellValue('D' . $rowCount, $row['electricity']);
                $sheet->setCellValue('E' . $rowCount, $row['water']);
                $sheet->setCellValue('F' . $rowCount, $row['tong_dien_nuoc']);
                $sheet->setCellValue('G' . $rowCount, $row['tong_dich_vu_khac']);
                $sheet->setCellValue('H' . $rowCount, $row['status']);
                $sheet->setCellValue('I' . $rowCount, $row['tong_tat_ca']);
                $rowCount++;
            }

            // Style the table with borders
            // $styleArray = array(
            //     'borders' => array(
            //         'allborders' => array(
            //             'style' => PHPExcel_Style_Border::BORDER_THIN
            //         )
            //     )
            // );
            // $sheet->getStyle('A1:I' . ($rowCount - 1))->applyFromArray($styleArray);

            // Save and output the Excel file
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

            // Delete the file after download
            
        }
    }


    function sua($id_service)
    {
        $this->view('LayoutDV', [
            'page' => 'dichvu_sua_v',
            'dulieu' => $this->dsdv->hddv_find($id_service, '')
        ]);
    }

    function suadl()
    {
        $dulieu = $this->dsdv->hddv_invoice();
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu3 = $this->dsdv->hddv_idP();
        if (isset($_POST['btnLuu'])) {


            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $electricity = $_POST['txtDien'];
            $water = $_POST['txtNuoc'];
            $created_day = $_POST['txtNgayTao'];
            $ended_day = $_POST['txtNgayKT'];
            $status = $_POST['txtTrangThai'];

            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->dsdv->hddv_upd($id_invoice, $id_room, $electricity, $water, $created_day, $ended_day, $status);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            // Gọi lại giao diện và truyền $dulieu ra


            $this->view('LayoutDV', [
                'page' => 'DanhsachHDDV_v',
                'dulieu' => $dulieu,
                'dulieu1' => $dulieu1,
                'dulieu3' => $dulieu3,


            ]);
        }
    }

    function xoa($id_service)
    {
        $kq = $this->dsdv->hddv_del($id_service);

        // Fetch the data after deletion
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu2 = $this->dsdv->hddv_invoice();
        $dulieu3 = $this->dsdv->hddv_idP();

        // Display the alert based on the result of deletion
        if ($kq) {
            echo "<script>
                    alert('Xóa thành công!');
                    window.location.href = 'http://localhost/De5/DachsachHDDV';
                  </script>";
        } else {
            echo "<script>
                    alert('Xóa thất bại!');
                    window.location.href = 'http://localhost/De5/DachsachHDDV';
                  </script>";
        }

        exit();
    }

    function themmoi()
    {

        // $dulieu = $this->dsdv->hddv_all();
        $dulieu1 = $this->dsdv->hddv_idP();
        $dulieu2 = $this->dsdv->hddv_invoice();


        if (isset($_POST['btnLuuDV'])) {

            $id_invoice = $_POST['txtMaHD'];
            $id_room = $_POST['txtMaPhong'];
            $electricity = $_POST['txtDien'];
            $water = $_POST['txtNuoc'];
            $created_day = $_POST['txtNgayTao'];
            $ended_day = $_POST['txtNgayKT'];
            $status = $_POST['txtTrangThai'];

            // Kiểm tra trùng mã
            $kq1 = $this->dsdv->check_trung_ma($id_invoice);
            if ($kq1) {
                echo "<script>
                    alert('Trùng mã!');
                    window.location.href = 'http://localhost/De5/DachsachHDDV';
                  </script>";
                exit();
            } else {
                // Gọi hàm thêm dl trong model
                $kq = $this->dsdv->hddv_ins($id_invoice, $id_room, $electricity, $water, $created_day, $ended_day, $status);

                if ($kq) {
                    echo "<script>
                        alert('Thêm mới thành công!');
                        window.location.href = 'http://localhost/De5/DachsachHDDV';
                      </script>";
                } else {
                    echo "<script>
                        alert('Thêm mới thất bại!');
                        window.location.href = 'http://localhost/De5/DachsachHDDV';
                      </script>";
                }
                exit();
            }


            // $dulieu = $this->dsdv->hddv_invoice();
            // $dulieu1 = $this->dsdv->hddv_idP();
            // $this->view('LayoutDV', [
            //     'page' => 'DanhsachHDDV_v',
            //     'dulieu1' => $dulieu1,


            // ]);
        }
    }
}
    
// }
