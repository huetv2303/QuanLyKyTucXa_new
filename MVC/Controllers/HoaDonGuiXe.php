<?php
class HoaDonGuiXe extends controller
{
    private $hdgx;
    function __construct()
    {
        $this->hdgx = $this->model('HoaDonGuiXe_m');
    }

    //  Func chuyển trang và lấy dữ liệu
    function Get_data()
    {
        $dulieu = $this->hdgx->load_Data();
        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $dulieu,
            'id' => $this->hdgx->get_ID()
        ]);
    }

    // Func thêm mới dữ liệu
    function Insert()
    {
        $mhd = $_POST['txtBillCode'];
        $id = $_POST['txtID'];
        $name = $_POST['txtName'];
        $month = $_POST['txtMonth'];
        $price = $_POST['txtPrice'];
        $day = $_POST['txtDay'];
        $type = $_POST['txtType'];
        $plate = $_POST['txtPlate'];
        $status = $_POST['txtStatus'];
        $note = $_POST['txtNote'];

        // Kiểm tra xem người dùng có nhập đủ thông tin không
        if ($id == '' || $name == '') {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
        } else {
            // Kiểm tra trùng mã nhân viên
            $kq = $this->hdgx->Check($id);
            if ($kq) {
                echo "<script>alert('Mã hóa đơn đã tồn tại !!!')</script>";
            } else {
                // Gọi hàm thêm 
                $result = $this->hdgx->insert_Data($mhd, $id, $name, $month, $price, $day, $type, $plate, $status, $note);
                if ($result) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else
                    echo "<script>alert('Thêm mới thất bại!')</script>";
            }
        }
        $dulieu = $this->hdgx->load_Data();
        $this->view('MasterLayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $dulieu,
            'id' => $this->hdgx->get_ID()
        ]);
    }

    // Func sửa dữ liệu hóa đơn
    function Update($mhd)
    {
        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_sua_v',
            'dulieu' => $this->hdgx->search_Data($mhd, '', ''),
            'id' => $this->hdgx->get_ID()
        ]);
    }

    function UpdateData()
    {
        if (isset($_POST['btnCapNhat'])) {
            $mhd = $_POST['txtBillCode'];
            $month = $_POST['txtMonth'];
            $price = $_POST['txtPrice'];
            $day = $_POST['txtDay'];
            $status = $_POST['txtStatus'];
            $note = $_POST['txtNote'];

            // Gọi func sửa dữ liệu trong Model
            $kq = $this->hdgx->update_Data($mhd, $month, $price, $day, $status, $note);
            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            //Gọi lại giao diện và truyền dữ liệu ra
            $dulieu = $this->hdgx->load_Data();
            $this->view('Masterlayout', [
                'page' => 'HoaDonGuiXe_v',
                'dulieu' => $dulieu,
                'id' => $this->hdgx->get_ID()
            ]);
        }

        // Kiểm tra xem người dùng có nhấn vào nút Quay lại không
        if (isset($_POST['btnBack'])) {
            $dulieu = $this->hdgx->load_Data();
            $this->view('Masterlayout', [
                'page' => 'HoaDonGuiXe_v',
                'dulieu' => $dulieu,
                'id' => $this->hdgx->get_ID()
            ]);
        }
    }

    // Func xóa thông tin hóa đơn
    function Delete($mhd)
    {
        $kq = $this->hdgx->delete_Data($mhd);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";

        //Gọi lại giao diện và truyền $dulieu ra
        $dulieu = $this->hdgx->load_Data();
        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $dulieu,
            'id' => $this->hdgx->get_ID()
        ]);
    }

    // Func tìm kiếm hóa đơn
    function Search()
    {
        $mhd = $_POST['txtBillCode'];
        $id = $_POST['txtID'];
        $status = $_POST['txtStatus'];

        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $this->hdgx->search_Data($mhd, $id, $status),
            'id' => $this->hdgx->get_ID()
        ]);
    }

    // Func in hóa đơn
    function ExportExcel()
    {
        //code xuất excel
        $objExcel = new PHPExcel();
        $objExcel->setActiveSheetIndex(0);
        $sheet = $objExcel->getActiveSheet()->setTitle('HD');
        $rowCount = 1;
        //Tạo tiêu đề cho cột trong excel
        $sheet->setCellValue('A' . $rowCount, 'Mã hóa đơn');
        $sheet->setCellValue('B' . $rowCount, 'Mã sinh viên');
        $sheet->setCellValue('C' . $rowCount, 'Tên sinh viên');
        $sheet->setCellValue('D' . $rowCount, 'Tháng');
        $sheet->setCellValue('E' . $rowCount, 'Thành tiền');
        $sheet->setCellValue('F' . $rowCount, 'Ngày lập');
        $sheet->setCellValue('G' . $rowCount, 'Loại xe');
        $sheet->setCellValue('H' . $rowCount, 'Biển số xe');
        $sheet->setCellValue('I' . $rowCount, 'Trạng thái');
        $sheet->setCellValue('J' . $rowCount, 'Ghi chú');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        //gán màu nền
        $sheet->getStyle('A1:J1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
        //căn giữa
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB

        $mhd = $_POST['MaHD1'];
        $id = $_POST['MaSV1'];
        $dulieu = $this->hdgx->search_Data($mhd, $id, '');
        while ($row = mysqli_fetch_array($dulieu)) {
            $rowCount++;
            $sheet->setCellValue('A' . $rowCount, $row['billCode']);
            $sheet->setCellValue('B' . $rowCount, $row['ID']);
            $sheet->setCellValue('C' . $rowCount, $row['studentName']);
            $sheet->setCellValue('D' . $rowCount, $row['month']);
            $sheet->setCellValue('E' . $rowCount, $row['price']);
            $sheet->setCellValue('F' . $rowCount, $row['invoiceDate']);
            $sheet->setCellValue('G' . $rowCount, $row['vehicle']);
            $sheet->setCellValue('H' . $rowCount, $row['plate']);
            $sheet->setCellValue('I' . $rowCount, $row['status']);
            $sheet->setCellValue('J' . $rowCount, $row['note']);
        }
        //  Kẻ bảng 
        $styleAray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $sheet->getStyle('A1:' . 'J' . ($rowCount))->applyFromArray($styleAray);
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
