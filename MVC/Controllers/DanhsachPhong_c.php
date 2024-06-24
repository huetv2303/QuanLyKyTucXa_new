<?php
class DanhsachPhong_c extends controller
{
    private $ds;
    function __construct()
    {
        $this->ds = $this->model('Phong_m');
    }

    function Get_data()
    {
        $dulieu = $this->ds->all();
        $ma = $this->ds->toa_All();
        $ma1 = $this->ds->toa_All();
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'dulieu' => $dulieu,
            'ma' => $ma,// Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
            'ma1' => $ma1
        ]);
    }
    function import()
    {
        if (isset($_POST['btnUpLoad'])) {
            $file = $_FILES['txtfile']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objExcel = $objReader->load($file);
            //Lấy sheet hiện tại
            $sheetData = $objExcel->getActiveSheet()->toArray(null, true, true, true);
            $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();

            for ($i = 2; $i <= $highestRow; $i++) {
                $maphong = $sheetData[$i]["A"];
                $matoa = $sheetData[$i]["B"];
                $songuoi = $sheetData[$i]["C"];
                $tienphong = $sheetData[$i]["D"];
                $trangthai = $sheetData[$i]["E"];
                $kq = $this->ds->find($maphong, $matoa, $songuoi, $tienphong, $trangthai);
            }

            if ($maphong == '' || $matoa == '' || $songuoi == '' || $tienphong == '' || $trangthai) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            } else {
                //Kiểm tra trùng mã tác giả
                $kq1 = $this->ds->check_trung_ma($maphong);
                $kq2 = $this->ds->check_name($matoa);
                if ($kq1) {
                    echo "<script>alert('Mã dịch vụ đã tồn tại!')</script>";
                } else if ($kq2) {
                    echo "<script>alert(' Tên dịch vụ này đã tồn tại!')</script>";
                } else {
                    //gọi hàm thêm dl tacgia_ins trong model
                    $kq = $this->ds->find($maphong, $matoa, $songuoi, $tienphong, $trangthai);

                    if ($kq) {
                        echo "<script>alert('Import thành công!')</script>";
                    } else

                        echo "<script>alert('Import thất bại!')</script>";
                }
            }

        }
        $dulieu1 = $this->ds->find();
        $dulieu = $this->ds->all();
        $ma = $this->ds->toa_All();
        $ma1 = $this->ds->toa_All();
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'dulieu' => $dulieu,
            'ma' => $ma,// Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
            'ma1' => $ma1,
            'dulieu1' => $dulieu1,

        ]);


    }
    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $maphong = $_POST['txtTimkiem'];
            $matoa = $_POST['txtTimkiem'];
            $trangthai = $_POST['txtTimkiem'];
            // $tienphong=$_POST['txtTimkiem'];
            $dulieu = $this->ds->find($maphong, $matoa, $trangthai);
            $ma = $this->ds->toa_All();
            $ma1 = $this->ds->toa_All();
            //Gọi lại giao diện và truyền $dulieu ra
            $this->view('Masterlayout', [
                'page' => 'DanhsachPhong_v',
                'dulieu' => $dulieu,
                'maphong' => $maphong,
                'matoa' => $matoa,
                'trangthai' => $trangthai,
                'ma' => $ma,
                'ma1' => $ma1,

            ]);
        }
        // Kiểm tra xem người dùng có nhấn nút nhập Excel không
        if (isset($_POST['btnXuatExcel'])) {
            //code xuất excel
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('DSLS');
            $rowCount = 1;
            //Tạo tiêu đề cho cột trong excel
            $sheet->setCellValue('A' . $rowCount, 'Số thứ tự');
            $sheet->setCellValue('B' . $rowCount, 'Mã phòng');
            $sheet->setCellValue('C' . $rowCount, 'Mã tòa');
            $sheet->setCellValue('D' . $rowCount, 'Số người');
            $sheet->setCellValue('E' . $rowCount, 'Tiền phòng');
            $sheet->setCellValue('F' . $rowCount, 'Trạng thái');
           
            //định dạng cột tiêu đề
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            
            //gán màu nền
            $sheet->getStyle('A1:C1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            //căn giữa
            $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $data = $this->ds->Get_data();

            while ($row = mysqli_fetch_array($data)) {
                $rowCount++;
                $sheet->setCellValue('A' . $rowCount, $rowCount);
                $sheet->setCellValue('B' . $rowCount, $row['maPhong']);
                $sheet->setCellValue('C' . $rowCount, $row['maToa']);
                $sheet->setCellValue('D' . $rowCount, $row['soNguoi']);
                $sheet->setCellValue('E' . $rowCount, $row['tienPhong']);
                $sheet->setCellValue('F' . $rowCount, $row['trangThai']);
               
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



    }



    function xoa($maphong)
    {
        $kq = $this->ds->delete($maphong);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";

        $dulieu = $this->ds->all();


        $ma = $this->ds->toa_All();
        $ma1 = $this->ds->toa_All();
        //Gọi lại giao diện và truyền $dulieu ra
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'dulieu' => $dulieu,
            'ma' => $ma,
            'ma1' => $ma1,

        ]);
    }
    function sua($maphong)
    {
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'dulieu' => $this->ds->find2($maphong),
            'ma' => $this->ds->toa_All(), // Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
        ]);
    }
    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $maphong = $_POST['txtMaphong'];
            $matoa = $_POST['txtMatoa'];
            $songuoi = $_POST['txtSonguoi'];
            $tienphong = $_POST['txtTienphong'];
            $trangthai = $_POST['txtTrangthai'];

            // Kiểm tra dữ liệu trống
            if (empty($maphong) || empty($matoa) || empty($songuoi) || empty($tienphong) || empty($trangthai)) {
                echo "<script>alert('Không để trống dữ liệu !')</script>";

                $dulieu = $this->ds->find($maphong, $matoa, $songuoi, $tienphong, $trangthai);
                $this->view('Masterlayout', [
                    'page' => 'DanhsachPhong_v',
                    'dulieu' => $dulieu,
                    'ma' => $this->ds->toa_All(),
                    'maphong' => $maphong,
                    'matoa' => $matoa,
                    'songuoi' => $songuoi,
                    'tienphong' => $tienphong,
                    'trangthai' => $trangthai,
                ]);
            } else {
                // Gọi hàm update dữ liệu trong model
                $kq = $this->ds->update($maphong, $matoa, $songuoi, $tienphong, $trangthai);

                if ($kq) {
                    echo "<script>alert('Sửa thành công!')</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!')</script>";
                }

                // Lấy lại tất cả dữ liệu để hiển thị
                $dulieu = $this->ds->all();
                $ma = $this->ds->toa_All();
                $ma1 = $this->ds->toa_All();
                $this->view('Masterlayout', [
                    'page' => 'DanhsachPhong_v',
                    'dulieu' => $dulieu,
                    'ma' => $ma,
                    'ma1' => $ma1,
                    // 'maphong' => $maphong,
                    // 'matoa' => $matoa,
                    // 'songuoi' => $songuoi,
                    // 'tienphong' => $tienphong,
                    // 'trangthai' => $trangthai,
                ]);
            }
        }
        //Gọi lại giao diện và truyền $dulieu ra
    }

    
}
?>