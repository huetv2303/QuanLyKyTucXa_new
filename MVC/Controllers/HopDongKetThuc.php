<?php
class HopDongKetThuc extends controller
{
    protected $hopdongketthuc;
    public function Get_data()
    {
        $dulieu = $this->hopdongketthuc->hopdonggiahan_all(); //load toàn bộ danh sách hợp đồng có trạng thái là hết hạn
        $this->view('Masterlayout', [
            'page' => 'HopDongKetThuc_v',
            'dulieu' => $dulieu
        ]);
    }

    public function __construct()
    {
        $this->hopdongketthuc = $this->model('HopDong_m');
    }



    public function ketthuc($mp)
    {

        $nophidv = $this->hopdongketthuc->check_no_phi_dv($mp);
        $notienphong  = $this->hopdongketthuc->check_no_tien_phong($mp);

        if ($notienphong || $nophidv) {
            if ($notienphong) echo "<script>alert('Chưa thanh toán tiền phòng, không thể kết thúc hợp đồng')</script>";
            if ($nophidv) echo "<script>alert('Chưa thanh toán phí dịch vụ, không thể kết thúc hợp đồng')</script>";
        }
        else
        {
            $this->hopdongketthuc->hopdong_ketthuc($mp);
            echo "<script>alert('Kết thúc hợp đồng thành công rực rỡ😍😍')</script>";
        }


        $dulieu = $this->hopdongketthuc->hopdonggiahan_all();
        //Goi lai giao dien va truyen $duleiu ra
        $this->view('Masterlayout', [
            'page' => 'HopDongKetThuc_v',
            'dulieu' => $dulieu,
        ]);
    }



    public function timkiem()
    {
        //code nút tìm kiếm
        if (isset($_POST['btnTimkiem'])) {
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $msv = $_POST['txtMaTruongNhom'];
            $mp = $_POST['txtMaPhong'];

            $dulieu = $this->hopdongketthuc->hopdonghethan_find($mhd, $mnv, $msv, $mp);
            $this->view('Masterlayout', [
                'page' => 'HopDongKetThuc_v',
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

            $data = $this->hopdongketthuc->hopdonghethan_find($mhd, $mnv, $msv, $mp);

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
