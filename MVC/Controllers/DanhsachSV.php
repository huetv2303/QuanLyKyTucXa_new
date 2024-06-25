<?php
class DanhsachSV extends controller
{
    private $dssv;

    function __construct()
    {
        $this->dssv = $this->model('SinhVien_m');
    }



    function Get_data()
    {
        $dulieu = $this->dssv->sinhvien_all();
        $this->view('Masterlayout', ['page' => 'DanhsachSV_v', 'dulieu' => $dulieu]);
    }



    function timkiem()
    {
        if (isset($_POST['btnTimKiem'])) {
            $tensv = $_POST['txtTenSinhVien'];
            $masv = $_POST['txtMaSinhVien'];
            $dulieu = $this->dssv->sinhvien_find( $masv,$tensv);
            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout', [
                'page' => 'DanhsachSV_v',
                'dulieu' => $dulieu,
                'tensv' => $tensv,
                'masv' => $masv
            ]);
        }

        // Kiểm tra xem người dùng có nhấn nút nhập Excel không
        if (isset($_POST['btnXuatExcel'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSSV');
            $rowCount = 1;
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã sinh viên');
            $sheet->setCellValue('C' . $rowCount, 'Họ tên');
            // $sheet->setCellValue('D' . $rowCount, 'Mã tòa');
            // $sheet->setCellValue('E' . $rowCount, 'Mã phòng');
            $sheet->setCellValue('D' . $rowCount, 'Email');
            $sheet->setCellValue('E' . $rowCount, 'Số điện thoại');
            $sheet->setCellValue('F' . $rowCount, 'Ngày sinh');
            $sheet->setCellValue('G' . $rowCount, 'Giới tính');
            $sheet->setCellValue('H' . $rowCount, 'CCCD');
            $sheet->setCellValue('I' . $rowCount, 'Địa chỉ');

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
            $sheet->getStyle('A1:I1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            //căn giữa
            $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $data = $this->dssv->sinhvien_all();

            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['maSinhVien']);
                $sheet->setCellValue('C' . $rowCount, $row['hoTen']);
                // $sheet->setCellValue('D' . $rowCount, $row['maToa']);
                // $sheet->setCellValue('E' . $rowCount, $row['maPhong']);
                $sheet->setCellValue('D' . $rowCount, $row['email']);
                $sheet->setCellValue('E' . $rowCount, $row['soDienThoai']);
                $sheet->setCellValue('F' . $rowCount, $row['ngaySinh']);
                $sheet->setCellValue('G' . $rowCount, $row['gioiTinh']);
                $sheet->setCellValue('H' . $rowCount, $row['cccd']);
                $sheet->setCellValue('I' . $rowCount, $row['diaChi']);
            }
            //Kẻ bảng 
            $styleAray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:' . 'I' . ($rowCount))->applyFromArray($styleAray);
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



    function sua($id)
    {
        $this->view('Masterlayout', [
            'page' => 'SinhVien_sua_v',
            'dulieu' => $this->dssv->sinhvien_find($id, '')
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $msv = $_POST['txtMaSinhVien'];
            // $matoa = $_POST['txtMaToa'];
            // $maphong = $_POST['txtMaPhong'];
            $ht = $_POST['txtHoTen'];
            $email = $_POST['txtEmail'];
            $sdt = $_POST['txtSoDienThoai'];
            $gt = $_POST['txtGioiTinh'];
            $ns = $_POST['txtNgaySinh'];
            $cccd = $_POST['txtCccd'];
            $dc = $_POST['txtDiaChi'];

            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->dssv->sinhvien_upd($msv, $ht, $email, $sdt, $ns, $gt, $cccd, $dc);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            //Gọi lại giao diện và truyền $dulieu ra
            $dulieu = $this->dssv->sinhvien_find('', '');
            $this->view('Masterlayout', [
                'page' => 'DanhsachSV_v',
                'dulieu' => $dulieu

            ]);
        }
    }

    function xoa($id)
    {
        $kq = $this->dssv->sinhvien_del($id);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        //Gọi lại giao diện và truyền $dulieu ra
        // $msv = $_POST['txtMaSinhVien'];
        // $tsv = $_POST['txtTenSinhVien'];

        $dulieu = $this->dssv->sinhvien_find('', '');
        $this->view('Masterlayout', [
            'page' => 'DanhsachSV_v',
            'dulieu' => $dulieu
        ]);
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
                $masv = $sheetData[$i]["A"];
                $hoten = $sheetData[$i]["B"];
                // $matoa = $sheetData[$i]["C"];
                // $maphong = $sheetData[$i]["D"];
                $email = $sheetData[$i]["C"];
                $sdt = $sheetData[$i]["D"];
                $ngaysinh = $sheetData[$i]["E"];
                $gioitinh = $sheetData[$i]["F"];
                $cccd = $sheetData[$i]["G"];
                $diachi = $sheetData[$i]["H"];

                $kq = $this->dssv->sinhvien_ins($masv, $hoten, $email, $sdt, $ngaysinh, $gioitinh, $cccd, $diachi);
            }
            if ($kq) {
                echo "<script>alert('Nhập thành công !!!')</script>";
            } else
                echo "<script>alert('Nhập thất bại, vui lòng thử lại !!!')</script>";
        }

        // Lấy dữ liệu và truyền ra
        $dulieu = $this->dssv->sinhvien_all();
        $this->view('MasterLayout', [
            'page' => 'DanhsachSV_v',
            'dulieu' => $dulieu,
        ]);
    }
}
