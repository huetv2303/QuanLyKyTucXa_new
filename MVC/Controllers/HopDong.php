<?php
class HopDong extends controller
{
    protected $hopdong;
    public function __construct()
    {
        $this->hopdong = $this->model('HopDong_m');
    }

    public function Get_data()
    {
        
        $dulieu = $this->hopdong->hopdong_all(); //load toàn bộ danh sách hợp đồng
        $this->view('Masterlayout', [
            'page' => 'HopDong_v',
            'dulieu' => $dulieu,
            // 'nhanvien' => $nhanvien,
            // 'sinhvien' => $sinhvien,
            // 'phong' => $phong
        ]);
    }

    public function xoa($mhd)
    {
        $kq2 = $this->hopdong-> update_ctphong();
        $kq = $this->hopdong->hopdong_del($mhd);
        // $kq = FALSE;
        $kq = $this->hopdong->hopdong_del($mhd);
        if ($kq) echo "<script>alert('xoa thành công')</script>";
        else echo "<script>alert('xoa thất bai')</script>";


        $dulieu = $this->hopdong->hopdong_all();
        //Goi lai giao dien va truyen $duleiu ra
        $this->view('Masterlayout', [
            'page' => 'HopDong_v',
            'dulieu' => $dulieu,
        ]);
    }
    
    public function sua($mhd){
        $nhanvien = $this->hopdong->nhanvien_all();
        // $sinhvien = $this->hopdong->sinhvien_all();
        $phong = $this->hopdong->phong_all();
        $truongnhom = $this->hopdong->truongnhom_all();
        $phong = $this->hopdong->phong_all();
        $toa = $this->hopdong->toa_all();
        $this->view('Masterlayout', [
            'page' => 'HopDong_sua_v',
            'dulieu' => $this->hopdong->hopdong_find($mhd, '','',''),
            'nhanvien' => $nhanvien,
            'truongnhom' => $truongnhom,
            'phong' => $phong,
            'toa' => $toa,
        ]);
    }

    public function suadl(){
        if (isset($_POST['btnLuu'])) {
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            // $msv = $_POST['txtMaTruongNhom'];
            $mt = $_POST['txtMaToa'];
            $mp = $_POST['txtMaPhong'];
            $start = $_POST['txtNgayBatDau'];
            $end = $_POST['txtNgayKetThuc'];
            $tt = $_POST['txtTinhTrang'];

            $kq = $this->hopdong->hopdong_upd($mhd, $mnv, $mt, $mp, $start, $end, $tt);
            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            
            // header("Location: http://localhost/QuanLyKyTucXa_new/HopDong");
            // Gọi lại giao diện và truyền $dulieu ra
            $dulieu = $this->hopdong->hopdong_all();
            $this->view('Masterlayout', [
                'page' => 'HopDong_v',
                'dulieu' => $dulieu
            ]);
        }
    }

    public function timkiem(){
        //code nút tìm kiếm
        if (isset($_POST['btnTimkiem'])) {
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $msv = $_POST['txtMaTruongNhom'];
            $mp = $_POST['txtMaPhong'];

            $dulieu = $this->hopdong->hopdong_find($mhd, $mnv, $msv, $mp);
            $this->view('Masterlayout', [
                'page' => 'HopDong_v',
                'dulieu' => $dulieu,
                'maHopDong'=> $mhd,
                'maNhanVien'=>$mnv,
                'maSinhVien'=>$msv,
                'maPhong'=>$mp
            ]);
        }

        //code nút xuất excel
        if (isset($_POST['btnXuatExcel'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('Danh sach');
            $rowCount = 1;
            
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'STT');
            $sheet->setCellValue('B' . $rowCount, 'Mã Hợp đồng');
            $sheet->setCellValue('C' . $rowCount, 'Mã Nhân viên');
            $sheet->setCellValue('D' . $rowCount, 'Mã trưởng nhóm');
            $sheet->setCellValue('E' . $rowCount, 'Mã toà');
            $sheet->setCellValue('F' . $rowCount, 'Mã phòng');
            $sheet->setCellValue('G' . $rowCount, 'Ngày bắt dầu');
            $sheet->setCellValue('H' . $rowCount, 'Ngày kết thúc');
            $sheet->setCellValue('I' . $rowCount, 'Tình trạng');
            

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

            //gán màu nền
            $sheet->getStyle('A1:I1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('b9e0c1');
            //căn giữa
            $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //bôi đậm dòng tiêu đề
            $sheet->getStyle('A1:I1')->getFont()->setBold(true); 
            
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $msv = $_POST['txtMaTruongNhom'];
            $mp = $_POST['txtMaPhong'];

            $data = $this->hopdong->hopdong_find($mhd, $mnv, $msv, $mp);

            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['maHopDong']);
                $sheet->setCellValue('C' . $rowCount, $row['MaNhanVien']);
                $sheet->setCellValue('D' . $rowCount, $row['maTruongNhom']);
                $sheet->setCellValue('E' . $rowCount, $row['maToa']);
                $sheet->setCellValue('F' . $rowCount, $row['maPhong']);
                $sheet->setCellValue('G' . $rowCount, $row['ngayBatDau']);
                $sheet->setCellValue('H' . $rowCount, $row['ngayKetThuc']);
                $sheet->setCellValue('I' . $rowCount, $row['tinhTrang']);
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
            //căn giữa cột stt
            $sheet->getStyle('A2:A'.($rowCount))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

            
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'DanhSachHopDong.xlsx';
            $objWriter->save($fileName);

            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Type: application/vnd.openxlmformatsofficedocument.speadsheetml.sheet');
            // header('Content-Type: application/vnd.ms-excel');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: no-cache');
            readfile($fileName);
        }
    }


    function get_phong_by_toa()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->hopdong->get_phong_by_toa($maToa);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }
    function get_tien_phong_by_phong()
    {
        if (isset($_POST['maPhong'])) {
            $maPhong = $_POST['maPhong'];
            $result = $this->hopdong->get_tien_phong_by_phong($maPhong);

            // Assuming the result returns only one row with 'tienPhong' column
            if ($row = mysqli_fetch_assoc($result)) {
                $response = array('tienPhong' => $row['tienPhong']);
                echo json_encode($response);
            } else {
                // Handle the case where no data is found
                echo json_encode(array('tienPhong' => null));
            }
        }
    }

}
