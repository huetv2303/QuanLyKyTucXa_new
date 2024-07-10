<?php
class NopTienPhong extends controller
{
    public $noptienphong;

    function __construct()
    {
        $this->noptienphong = $this->model('NopTienPhong_m');
    }

    function Get_data()
    {
        $toa_sua = $this->noptienphong->get_all_toa();
        $dulieu = $this->noptienphong->noptienphong_all();
        $maphong = $this->noptienphong->get_all_phong();
        $maphong_sua = $this->noptienphong->get_all_phong();
        $this->view('Masterlayout', [
            'page' => 'NopTienPhong_v',
            'maphong' => $maphong,
            'dulieu' => $dulieu,
            'toa_sua' => $toa_sua,
            'maphong_sua' => $maphong_sua
        ]);
    }

    function themmoi()
    {
        if (isset($_POST['btnLuu'])) {
            $mgd = $_POST['txtMaGiaoDich'];
            $maphong = $_POST['txtMaPhong'];
            $matoa = $_POST['txtMaToa'];

            $tienphong = $_POST['txtTienPhong'];
            $thang = $_POST['txtThang'];
            $nam = $_POST['txtNam'];
            $ngaytao = $_POST['txtNgayTao'];
            $ngayhethan = $_POST['txtNgayKT'];
            $trangthai = $_POST['txtTrangThai'];

            $kq1 = $this->noptienphong->check_trung_ma($mgd);
            if ($kq1) {
                echo "<script>alert('Trùng mã gd!')</script>";
            } else {
                $kq = $this->noptienphong->noptienphong_ins($mgd, $matoa, $maphong, $tienphong, $thang, $nam, $ngaytao, $ngayhethan, $trangthai);

                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else {
                    echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }

            if (isset($_POST['btnLuu'])) {
                $dulieu = $this->noptienphong->noptienphong_all();

                $this->view('Masterlayout', [
                    'page' => 'NopTienPhong_v',
                    'dulieu' => $dulieu,
                    'mgd' => $mgd,
                    'maphong' => $maphong,
                    // 'matoa' => $matoa,
                    // 'maphong' => $maphong,
                    'tienphong' => $tienphong,
                    'ngayhethan' => $ngayhethan
                ]);
            }
        }
    }

    function get_phong_by_toa()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->noptienphong->get_phong_by_toa($maToa);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }

    function get_tienphong_by_phong()
    {
        if (isset($_POST['maPhong'])) {
            $maPhong = $_POST['maPhong'];
            $tienPhong = $this->noptienphong->get_tienphong_by_phong($maPhong);
            echo json_encode(['tienPhong' => $tienPhong]);
        }
    }



    function edit($maSinhVien)
    {
        $student = $this->noptienphong->get_student_by_id($maSinhVien);
        if (!$student) {
            echo "<p>Không tìm thấy sinh viên.</p>";
            return;
        }

        $toa = $this->noptienphong->get_all_toa();
        $phong = $this->noptienphong->get_phong_by_toa($student['maToa']);

        $this->view('Masterlayout', [
            'page' => 'NopTienPhong_v',
            'student' => $student,
            'toa' => $toa,
            'phong' => $phong
        ]);
    }

    function sua($mgd)
    {
        $this->view('MasterLayout', [
            'page' => 'NopTienPhong_v',
            'dulieu' => $this->noptienphong->hddv_find($mgd, '')
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $mgd = $_POST['txtMaGiaoDich'];
            $maphong = $_POST['txtMaPhong'];
            $tienphong = $_POST['txtTienPhong'];
            $matoa = $_POST['txtMaToa'];
            $ngaytao = $_POST['txtNgayTao'];
            $ngayhethan = $_POST['txtNgayHetHan'];
            $thang = $_POST['txtThang'];
            $nam = $_POST['txtNam'];
            $trangthai = $_POST['txtTrangThai'];

            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->noptienphong->noptienphong_upd($mgd, $matoa, $maphong, $tienphong, $thang, $nam, $ngaytao, $ngayhethan, $trangthai);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";
        }
        $dulieu = $this->noptienphong->noptienphong_find('', '');
        $this->view('Masterlayout', [
            'page' => 'NopTienPhong_v',
            'dulieu' => $dulieu,
            'matoa' => $matoa,
            'maphong' => $maphong

        ]);
    }

    function xoa($mgd)
    {
        $kq = $this->noptienphong->noptienphong_del($mgd);


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

        $dulieu4 = $this->noptienphong->noptienphong_find('','');
        $this->view('MasterLayout', [
            'page' => 'NopTienPhong_v',
            'dulieu' => $dulieu4
        ]);

        exit();
    }

    function timkiem()
    {
        if (isset($_POST['btnTimKiem'])) {
            $mgd = $_POST['txtMaGiaoDich'];
            $maphong = $_POST['txtMaPhong'];
            $dulieu = $this->noptienphong->noptienphong_find($mgd, $maphong);
            $dulieu1 = $this->noptienphong->idP();
            $dulieu3 = $this->noptienphong->idP();

            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout', [
                'page' => 'NopTienPhong_v',
                'dulieu' => $dulieu,
                'dulieu1' => $dulieu1,
                'dulieu3' => $dulieu3,
                'mgd' => $mgd,
                'maphong' => $maphong
            ]);
        }

        // Kiểm tra xem người dùng có nhấn nút nhập Excel không
        if (isset($_POST['btnXuatHoaDon'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('HoaDonTienPhong');
            $rowCount = 1;
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã phòng');
            $sheet->setCellValue('C' . $rowCount, 'Mã giao dịch');
            $sheet->setCellValue('D' . $rowCount, 'Tiền phòng');
            $sheet->setCellValue('E' . $rowCount, 'Trạng thái');

        
            //định dạng cột tiêu đề
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);

      
            //gán màu nền
            $sheet->getStyle('A1:E1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            //căn giữa
            $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB

            $magiaodich = $_POST['MaGiaoDich1'];
            $maphong = $_POST['MaPhong1'];
            $dulieu = $this->noptienphong->noptienphong_find($magiaodich, $maphong);

            while ($row = mysqli_fetch_array($dulieu)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['maPhong']);
                $sheet->setCellValue('C' . $rowCount, $row['maGiaoDich']);
                $sheet->setCellValue('D' . $rowCount, $row['tienPhong']);
                $sheet->setCellValue('E' . $rowCount, $row['trangThai']);
            

            }
            //Kẻ bảng 
            $styleAray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:' . 'E' . ($rowCount))->applyFromArray($styleAray);
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
}
