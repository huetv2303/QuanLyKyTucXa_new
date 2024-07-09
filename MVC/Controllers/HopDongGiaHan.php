<?php
class HopDongGiaHan extends controller
{
    protected $hopdonggiahan;
    public function Get_data()
    {
        $dulieu = $this->hopdonggiahan->hopdonggiahan_all(); //load toàn bộ danh sách hợp đồng
        $this->view('Masterlayout', [
            'page' => 'HopDongGiaHan_v',
            'dulieu' => $dulieu
        ]);
    }

    public function __construct()
    {
        $this->hopdonggiahan = $this->model('HopDong_m');
    }

    public function giahan($mhd)
    {
        $nhanvien = $this->hopdonggiahan->nhanvien_all();
        $truongnhom = $this->hopdonggiahan->truongnhom_all();
        $phong = $this->hopdonggiahan->phong_all();
        $toa = $this->hopdonggiahan->toa_all();
        $this->view('Masterlayout', [
            'page' => 'HopDongGiaHan_giahan_v',
            'dulieu' => $this->hopdonggiahan->hopdong_find($mhd, '', '', ''),
            'nhanvien' => $nhanvien,
            'truongnhom' => $truongnhom,
            'phong' => $phong,
            'toa' => $toa
        ]);
    }

    public function giahanhd()
    {
        if (isset($_POST['btnLuu'])) {
            $mhd = $_POST['txtMaHopDong'];
            $end = $_POST['txtNgayKetThuc'];
            $giahan = $_POST['txtNgayGiaHan'];

            if ($end >= $giahan) echo "<script>alert('Ngày gia hạn thêm phải lớn hơn ngày kết thúc hợp đồng!')</script>";
            else {
                $kq = $this->hopdonggiahan->hopdonggiahan_giahan($mhd, $giahan);
                if ($kq) {
                    echo "<script>alert('Gia hạn hợp đồng thành công')</script>";
                } else {
                    echo "<script>alert('Gia hạn thất bại')</script>";
                }
                //Gọi lại giao diện và truyền $dulieu ra
                $dulieu = $this->hopdonggiahan->hopdonggiahan_all();
                $this->view('Masterlayout', [
                    'page' => 'HopDongGiaHan_v',
                    'dulieu' => $dulieu
                ]);
            }
            $this->giahan($mhd);
        }
    }




    public function timkiem()
    {
        //code nút tìm kiếm
        if (isset($_POST['btnTimkiem'])) {
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $msv = $_POST['txtMaTruongNhom'];
            $mp = $_POST['txtMaPhong'];

            $dulieu = $this->hopdonggiahan->hopdonghethan_find($mhd, $mnv, $msv, $mp);
            $this->view('Masterlayout', [
                'page' => 'HopDongGiaHan_v',
                'dulieu' => $dulieu,
                'maHopDong' => $mhd,
                'maNhanVien' => $mnv,
                'maSinhVien' => $msv,
                'maPhong' => $mp
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
            $sheet->setCellValue('E' . $rowCount, 'Mã phòng');
            $sheet->setCellValue('F' . $rowCount, 'Ngày bắt dầu');
            $sheet->setCellValue('G' . $rowCount, 'Ngày kết thúc');
            $sheet->setCellValue('H' . $rowCount, 'Tình trạng');


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
            $sheet->getStyle('A1:H1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('b9e0c1');
            //căn giữa
            $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //bôi đậm dòng tiêu đề
            $sheet->getStyle('A1:H1')->getFont()->setBold(true);

            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $msv = $_POST['txtMaTruongNhom'];
            $mp = $_POST['txtMaPhong'];

            $data = $this->hopdonggiahan->hopdong_find($mhd, $mnv, $msv, $mp);

            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount - 1);
                $sheet->setCellValue('B' . $rowCount, $row['maHopDong']);
                $sheet->setCellValue('C' . $rowCount, $row['MaNhanVien']);
                $sheet->setCellValue('D' . $rowCount, $row['maTruongNhom']);
                $sheet->setCellValue('E' . $rowCount, $row['maPhong']);
                $sheet->setCellValue('F' . $rowCount, $row['ngayBatDau']);
                $sheet->setCellValue('G' . $rowCount, $row['ngayKetThuc']);
                $sheet->setCellValue('H' . $rowCount, $row['tinhTrang']);
            }
            //Kẻ bảng 
            $styleAray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:' . 'H' . ($rowCount))->applyFromArray($styleAray);
            //căn giữa cột stt
            $sheet->getStyle('A2:A' . ($rowCount))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


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
}
