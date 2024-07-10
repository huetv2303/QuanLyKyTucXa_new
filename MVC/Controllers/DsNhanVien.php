<?php
class DsNhanVien extends controller
{
    private $dsnv;
    function __construct()
    {
        $this->dsnv = $this->model('NhanVien_m');
    }


    function Get_data()
    {
        $dulieu = $this->dsnv->loadNhanVien();
        $this->view('Masterlayout', [
            'page' => 'DsNhanVien_v',
            'dulieu' => $dulieu,
            'matoa' => $this->dsnv->getMaToa()
        ]);
    }

    // Function tìm kiếm nhân viên theo mã và tên
    function Search()
    {
        if (isset($_POST['btnTimKiem'])) {
            $mnv = $_POST['txtMaNV'];
            $tnv = $_POST['txtTenNV'];
            $dulieu = $this->dsnv->searchNhanVien($mnv, $tnv);
            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout', [
                'page' => 'DsNhanVien_v',
                'dulieu' => $dulieu,
                'maNv' => $mnv,
                'tenNv' => $tnv
            ]);
        }

        // Kiểm tra xem người dùng có nhấn nút xuất Excel không
        if (isset($_POST['btnXuatExcel'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSLS');
            $rowCount = 1;
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'Số thứ tự');
            $sheet->setCellValue('B' . $rowCount, 'Mã nhân viên');
            $sheet->setCellValue('C' . $rowCount, 'Tên nhân viên');
            $sheet->setCellValue('D' . $rowCount, 'Giới tính');
            $sheet->setCellValue('E' . $rowCount, 'Ngày sinh');
            $sheet->setCellValue('F' . $rowCount, 'Địa chỉ');
            $sheet->setCellValue('G' . $rowCount, 'Số điện thoại');
            $sheet->setCellValue('H' . $rowCount, 'Mã tòa');

            //định dạng cột tiêu đề
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            //gán màu nền
            $sheet->getStyle('A1:H1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            //căn giữa
            $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $data = $this->dsnv->loadNhanVien();

            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount);
                $sheet->setCellValue('B' . $rowCount, $row['MaNhanVien']);
                $sheet->setCellValue('C' . $rowCount, $row['TenNhanVien']);
                $sheet->setCellValue('D' . $rowCount, $row['GioiTinh']);
                $sheet->setCellValue('E' . $rowCount, $row['NgaySinh']);
                $sheet->setCellValue('F' . $rowCount, $row['DiaChi']);
                $sheet->setCellValue('G' . $rowCount, $row['SoDienThoai']);
                $sheet->setCellValue('H' . $rowCount, $row['maToa']);
            }
            //Kẻ bảng 
            $styleAray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:' . 'C' . ($rowCount))->applyFromArray($styleAray);
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

        // Function thêm mới nhân viên vào
        if (isset($_POST['btnLuu'])) {
            $mnv = $_POST['txtMaNv'];
            $tnv = $_POST['txtTenNv'];
            $gt = $_POST['txtGioiTinh'];
            $ns = $_POST['txtNgaySinh'];
            $sdt = $_POST['txtSdt'];
            $dc = $_POST['txtDiaChi'];
            $matoa = $_POST['txtMaToa'];

            // Kiểm tra dữ liệu rỗng
            if ($mnv == '' || $tnv == '') {
                echo "<script>alert('Vui lòng nhập mã và tên nhân viên!')</script>";
            } else {
                // Kiểm tra trùng mã nhân viên
                $kq1 = $this->dsnv->ktraTrungMa($mnv);
                if ($kq1) {
                    echo "<script>alert('Trùng mã nhân viên!')</script>";
                } else {
                    // Gọi hàm thêm thêm nhân viên
                    $kq = $this->dsnv->insertNhanVien($mnv, $tnv, $gt, $ns, $dc, $sdt, $matoa);
                    if ($kq) {
                        echo "<script>alert('Thêm mới thành công!')</script>";
                    } else
                        echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }
            $dulieu = $this->dsnv->loadNhanVien();
            $this->view('Masterlayout', [
                'page' => 'DsNhanVien_v',
                'dulieu' => $dulieu
            ]);
        }
    }

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
                $gender = $sheetData[$i]["C"];
                $birth = $sheetData[$i]["D"];
                $address = $sheetData[$i]["E"];
                $phoneNumber = $sheetData[$i]["F"];
                $buildingCode = $sheetData[$i]["G"];
                $kq = $this->dsnv->insertNhanVien($id, $name, $gender, $birth, $address, $phoneNumber, $buildingCode);
            }
            if ($kq) {
                echo "<script>alert('Nhập thành công !!!')</script>";
            } else
                echo "<script>alert('Nhập thất bại, vui lòng thử lại !!!')</script>";
        }

        // Lấy dữ liệu và truyền ra
        $dulieu = $this->dsnv->loadNhanVien();
        $this->view('MasterLayout', [
            'page' => 'DsNhanVien_v',
            'dulieu' => $dulieu,
        ]);
    }

    // Function xóa nhân viên
    function Delete($mnv)
    {
        $kq = $this->dsnv->deleteNhanVien($mnv);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";

        //Gọi lại giao diện và truyền $dulieu ra
        $dulieu = $this->dsnv->searchNhanVien('', '');
        $this->view('Masterlayout', [
            'page' => 'DsNhanVien_v',
            'dulieu' => $dulieu
        ]);
    }

    // Function điều hướng và load dữ liệu nhân viên đẩy vào bảng
    function loadForm($mnv)
    {
        $this->view('Masterlayout', [
            'page' => 'NhanVien_sua_v',
            'dulieu' => $this->dsnv->searchNhanVien($mnv, ''),
            'matoa' => $this->dsnv->getMaToa()
        ]);
    }

    //Function cập nhật thông tin nhân viên
    function Update()
    {

        if (isset($_POST['btnCapNhat'])) {
            $mnv = $_POST['txtMaNv'];
            $tnv = $_POST['txtTenNv'];
            $gt = $_POST['cboGioiTinh'];
            $ns = $_POST['txtNgaySinh'];
            $dc = $_POST['txtDiaChi'];
            $sdt = $_POST['txtSdt'];
            $matoa = $_POST['txtMaToa'];

            // Gọi func sửa dữ liệu trong Model
            $kq = $this->dsnv->updateNhanVien($mnv, $tnv, $gt, $ns, $dc, $sdt, $matoa);
            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            //Gọi lại giao diện và truyền dữ liệu ra
            $dulieu = $this->dsnv->searchNhanVien('', '');
            $this->view('Masterlayout', [
                'page' => 'DsNhanVien_v',
                'dulieu' => $dulieu
            ]);
        }
        if (isset($_POST['btnBack'])) {
            $dulieu = $this->dsnv->searchNhanVien('', '');
            $this->view('Masterlayout', [
                'page' => 'DsNhanVien_v',
                'dulieu' => $dulieu
            ]);
        }
       
    }
}
