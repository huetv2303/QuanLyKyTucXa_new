<?php
class NhomSV extends controller
{
    public $nhomsinhvien;

    function __construct()
    {
        $this->nhomsinhvien = $this->model('NhomSV_m');
    }

    function Get_data()
    {
        $toa_sua = $this->nhomsinhvien->get_all_toa();
        $dulieu = $this->nhomsinhvien->nhomsinhvien_all();
        $maphong = $this->nhomsinhvien->get_all_phong();
        $maphong_sua = $this->nhomsinhvien->get_all_phong();
        $this->view('Masterlayout', [
            'page' => 'NhomSV_v',
            'maphong' => $maphong,
            'dulieu' => $dulieu,
            'toa_sua' => $toa_sua,
            'maphong_sua' => $maphong_sua
        ]);
    }

    function themmoi()
    {
        if (isset($_POST['btnLuu'])) {
            $manhom = $_POST['txtMaNhom'];
            $matruongnhom = $_POST['txtMaTruongNhom'];
            $maphong = $_POST['txtMaPhong'];
            // $soluong = $_POST['txtSoLuong'];

            $kq1 = $this->nhomsinhvien->check_trung_ma($manhom);
            if ($kq1) {
                echo "<script>alert('Trùng mã gd!')</script>";
            } else {
                $kq = $this->nhomsinhvien->nhomsinhvien_ins($manhom, $matruongnhom, $maphong, 0);

                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else {
                    echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }

            if (isset($_POST['btnLuu'])) {
                $dulieu = $this->nhomsinhvien->nhomsinhvien_all();

                $this->view('Masterlayout', [
                    'page' => 'NhomSV_v',
                    'dulieu' => $dulieu,
                    'manhom' => $manhom,
                    'maphong' => $maphong
                    // 'matoa' => $matoa,
                    // 'maphong' => $maphong,
                ]);
            }
        }
    }



     function get_masv_by_nhom()
    {
        if (isset($_POST['maNhom'])) {
            $manhom = $_POST['maNhom'];
            $result = $this->nhomsinhvien->get_masv_by_nhom($manhom);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }



    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $manhom = $_POST['txtMaNhom'];
            $matruongnhom = $_POST['txtMaTruongNhom'];
            $maphong = $_POST['txtMaPhong'];


            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->nhomsinhvien->nhomsinhvien_upd($manhom, $matruongnhom, $maphong);

            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";
        }
        $dulieu = $this->nhomsinhvien->nhomsinhvien_find('', '');
        $this->view('Masterlayout', [
            'page' => 'NhomSV_v',
            'dulieu' => $dulieu,
            // 'matoa' => $matoa,
            'maphong' => $maphong

        ]);
    }

    function update_nhomsv_ttsv()
    {
        if (isset($_POST['btnLuuGomNhom'])) {
            $masv = $_POST['txtMaSinhVien'];
            $manhom = $_POST['txtMaNhom'];

            $result = $this->nhomsinhvien->dem_sv_trongnhom($manhom);

            $row = mysqli_fetch_assoc($result);
            $dem = (int)$row['COUNT(*)']; // Sử dụng tên cột đúng
            
            if ($dem > 7) {
                echo "<script>alert('Nhóm này đã đầy sinh viên!')</script>";
            } else {
                // Gọi hàm sửa dl tacgia_udp trong model
                $kq = $this->nhomsinhvien->update_nhomsv_ttsv($masv, $manhom);
                $upSoLuong = $this->nhomsinhvien->update_soluong($manhom, $dem + 1);
                
                if ($kq) {
                    echo "<script>alert('Gom nhóm thành công!')</script>";
                } else {
                    echo "<script>alert('Gom nhóm thất bại!')</script>";
                }
            }
        }

        $dulieu = $this->nhomsinhvien->nhomsinhvien_find('', '');
        $this->view('Masterlayout', [
            'page' => 'NhomSV_v',
            'dulieu' => $dulieu,
            // 'matoa' => $matoa,
            // 'maphong' => $maphong
        ]);
    }

    function xoa_sv_khoi_nhom()
    {
        if (isset($_POST['btnXoa'])) {
            $masv = $_POST['txtMaSinhVien'];
            $manhom = $_POST['txtMaNhom'];

            $result = $this->nhomsinhvien->dem_sv_trongnhom($manhom);

            $row = mysqli_fetch_assoc($result);
            $dem = (int)$row['COUNT(*)']; // Sử dụng tên cột đúng
            var_dump($dem);
            
            if ($dem <= 0) {
                echo "<script>alert('Nhóm này không có sinh viên!')</script>";
            } else {
       
                $kq = $this->nhomsinhvien->xoa_sv_khoi_nhom($masv);
                $upSoLuong = $this->nhomsinhvien->update_soluong($manhom, $dem - 1);
                
                if ($kq) {
                    echo "<script>alert('Xóa sinh viên khỏi nhóm thành công!')</script>";
                } else {
                    echo "<script>alert('Xóa sinh viên khỏi nhóm thất bại!')</script>";
                }
            }
        }

        $dulieu = $this->nhomsinhvien->nhomsinhvien_find('', '');
        $this->view('Masterlayout', [
            'page' => 'NhomSV_v',
            'dulieu' => $dulieu,
            // 'matoa' => $matoa,
            // 'maphong' => $maphong
        ]);
    }


    function xoa($manhom)
    {
        $kq = $this->nhomsinhvien->nhomsinhvien_del($manhom);


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
        $dulieu_xoa = $this->nhomsinhvien->nhomsinhvien_all();
        $this->view('MasterLayout', [
            'page' => 'NhomSV_v',
            'dulieu' => $dulieu_xoa,
        ]);

        exit();
    }

    function timkiem()
    {
        if (isset($_POST['btnTimKiem'])) {
            $manhom = $_POST['txtMaNhom'];
            $maphong = $_POST['txtMaPhong'];
            $dulieu = $this->nhomsinhvien->nhomsinhvien_find($manhom, $maphong);
            $dulieu1 = $this->nhomsinhvien->idP();
            $dulieu3 = $this->nhomsinhvien->idP();

            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout', [
                'page' => 'NhomSV_v',
                'dulieu' => $dulieu,
                'dulieu1' => $dulieu1,
                'dulieu3' => $dulieu3,
                'manhom' => $manhom,
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
            $dulieu = $this->nhomsinhvien->nhomsinhvien_find($magiaodich, $maphong);

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
