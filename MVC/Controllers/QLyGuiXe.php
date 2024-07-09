<?php

use PhpOffice\PhpSpreadsheet\Calculation\Database\DVar;

class QLyGuiXe extends controller
{
    private $dvgx;

    function __construct()
    {
        $this->dvgx = $this->model('QLyGuiXe_m');
    }

    function Get_data()
    {
        $dulieu = $this->dvgx->getData();
        $this->view('Masterlayout', [
            'page' => 'QLyGuiXe_v',
            'dulieu' => $dulieu,
            'id' => $this->dvgx->getID()
        ]);
    }

    // Func kiểm tra xem người dùng có nhấn vào nút tìm kiếm hay không
    function search()
    {
        if (isset($_POST['btnTimKiem'])) {
            $id = $_POST['txtMaSV'];
            $name = $_POST['txtTenSV'];
            $dulieu = $this->dvgx->searchData($id, $name);
            $this->view('Masterlayout', [
                'page' => 'QLyGuiXe_v',
                'dulieu' => $dulieu
            ]);
        }
        
        // Kiểm tra xem người dùng có nhấn nút nhập Excel không
        if (isset($_POST['btnXuatExcel'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSGX');
            $rowCount = 1;
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'Số thứ tự');
            $sheet->setCellValue('B' . $rowCount, 'Mã sinh viên');
            $sheet->setCellValue('C' . $rowCount, 'Tên sinh viên');
            $sheet->setCellValue('D' . $rowCount, 'Mã phòng');
            $sheet->setCellValue('E' . $rowCount, 'Mã tòa');
            $sheet->setCellValue('F' . $rowCount, 'Số điện thoại');
            $sheet->setCellValue('G' . $rowCount, 'Email');
            $sheet->setCellValue('H' . $rowCount, 'Ngày bắt đầu');
            $sheet->setCellValue('I' . $rowCount, 'Loại xe');
            $sheet->setCellValue('J' . $rowCount, 'Biển số xe');

            //định dạng cột tiêu đề
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
            $data = $this->dvgx->getData();

            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['ID']);
                $sheet->setCellValue('C' . $rowCount, $row['studentName']);
                $sheet->setCellValue('D' . $rowCount, $row['roomCode']);
                $sheet->setCellValue('E' . $rowCount, $row['buildingCode']);
                $sheet->setCellValue('F' . $rowCount, $row['phoneNumber']);
                $sheet->setCellValue('G' . $rowCount, $row['email']);
                $sheet->setCellValue('H' . $rowCount, $row['registerDate']);
                $sheet->setCellValue('I' . $rowCount, $row['typeOfVehicle']);
                $sheet->setCellValue('J' . $rowCount, $row['plate']);
            }
            //Kẻ bảng 
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

    function getInfo($maSV)
    {
        return $this->dvgx->getInfo($maSV);
    }

    // Func điều hướng đến trang sửa
    function update_load($id)
    {

        $this->view('Masterlayout', [
            'page' => 'GuiXe_sua_v',
            'dulieu' => $this->dvgx->searchData($id, '')
        ]);
    }

    function updateData()
    {
        if (isset($_POST['btnCapNhat'])) {
            $msv = $_POST['txtMaSv'];
            $sdt = $_POST['txtSdt'];
            $email = $_POST['txtEmail'];
            $date = $_POST['txtDate'];
            $type = $_POST['txtType'];
            $plate = $_POST['txtPlate'];

            // Gọi func sửa dữ liệu trong Model
            $kq = $this->dvgx->update($msv, $sdt, $email, $date, $type, $plate);
            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            //Gọi lại giao diện và truyền dữ liệu ra
            $dulieu = $this->dvgx->getData();
            $this->view('Masterlayout', [
                'page' => 'QLyGuiXe_v',
                'dulieu' => $dulieu
            ]);
        }

        // Kiểm tra xem người dùng có nhấn vào nút Quay lại không
        if (isset($_POST['btnBack'])) {
            $dulieu = $this->dvgx->getData();
            $this->view('Masterlayout', [
                'page' => 'QLyGuiXe_v',
                'dulieu' => $dulieu
            ]);
        }
    }

    // Func để xóa thông tin đăng kí gửi xe của sinh viên
    function DeleteInfo($msv)
    {
        $kq = $this->dvgx->delete($msv);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";

        //Gọi lại giao diện và truyền $dulieu ra
        $dulieu = $this->dvgx->getData();
        $this->view('Masterlayout', [
            'page' => 'QLyGuiXe_v',
            'dulieu' => $dulieu
        ]);
    }

    // Func nhập file Excel
    function ImportExcel()
    {
        if (isset($_POST['btnNhapDL'])) {
            $file = $_FILES['txtFile']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objExcel = $objReader->load($file);
            //Lấy sheet hiện tại
            $sheetData = $objExcel->getActiveSheet()->toArray(null, true, true, true);
            $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

            for ($i = 2; $i <= $highestRow; $i++) {
                $id = $sheetData[$i]["A"];
                $name = $sheetData[$i]["B"];
                $room = $sheetData[$i]["C"];
                $building = $sheetData[$i]["D"];
                $phone = $sheetData[$i]["E"];
                $email = $sheetData[$i]["F"];
                $date = $sheetData[$i]["G"];
                $vehicle = $sheetData[$i]["H"];
                $plate = $sheetData[$i]["I"];
                $kq = $this->dvgx->insert($id, $name, $room, $building, $phone, $email, $date, $vehicle, $plate);
            }
            if ($kq) {
                echo "<script>alert('Nhập thành công !!!')</script>";
            } else
                echo "<script>alert('Nhập thất bại, vui lòng thử lại !!!')</script>";
        }

        // Lấy dữ liệu và truyền ra
        $dulieu = $this->dvgx->getData();
        $this->view('MasterLayout', [
            'page' => 'QLyGuiXe_v',
            'dulieu' => $dulieu
        ]);
    }

    // Func để xuất file Excel
    function ExportExcel()
    {

    }

    // Func để thêm mới sinh viên đăng ký gửi xe
    function Insert()
    {
        $id = $_POST['txtID'];
        $name = $_POST['txtTenSv'];
        $room = $_POST['txtPhong'];
        $building = $_POST['txtMaToa'];
        $phone = $_POST['txtSdt'];
        $email = $_POST['txtEmail'];
        $date = $_POST['txtDate'];
        $vehicle = $_POST['txtType'];
        $plate = $_POST['txtPlate'];

        if ($id == '' || $name == '') {
            echo "<script>alert('Vui lòng nhập mã và tên sinh viên!')</script>";
        } else {
            // Kiểm tra trùng mã nhân viên
            $kq = $this->dvgx->Check($id);
            if ($kq) {
                echo "<script>alert('Sinh viên đã đăng ký gửi xe !!!')</script>";
            } else {
                // Gọi hàm thêm thêm
                $result = $this->dvgx->insert($id, $name, $room, $building, $phone, $email, $date, $vehicle, $plate);
                if ($result) {
                    echo "<script>alert('Đăng ký thành công!')</script>";
                } else
                    echo "<script>alert('Đăng ký thất bại!')</script>";
            }
        }
        $dulieu = $this->dvgx->getData();
        $this->view('MasterLayout', [
            'page' => 'QLyGuiXe_v',
            'dulieu' => $dulieu
        ]);
    }
}
