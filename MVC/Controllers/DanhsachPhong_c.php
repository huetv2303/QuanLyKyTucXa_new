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
        $update = $this->ds->update_ctphong();
        $dulieu = $this->ds->all();
        $ma = $this->ds->toa_All();
        $ma1 = $this->ds->toa_All();
        $this->view('Masterlayout', [
            'page' => 'DanhsachPhong_v',
            'update' => $update,
            'dulieu' => $dulieu,
            'ma' => $ma,// Lấy tất cả dữ liệu từ bảng lớp học, nếu bài bạn là phòng thì đây là tòa
            'ma1' => $ma1
        ]);
    }
    
    function timkiem()
    {
        if (isset($_POST['btnTimkiem'])) {
            $maphong = $_POST['txtTimkiem'];
            $matoa = $_POST['txtTimkiem'];
            $trangthai = isset($_POST['txtTimkiem2']) ? $_POST['txtTimkiem2'] : "";
            // $tienphong=$_POST['txtTimkiem'];
            $dulieu = $this->ds->find_radio($maphong, $matoa, $trangthai);
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
        //xuất excel//
        if(isset($_POST['btnXuat'])){
            $objExcel = new PHPExcel();
            $objExcel->setActiveSheetIndex(0);
            $sheet = $objExcel->getActiveSheet()->setTitle('Danh sách');
            $rowCount = 1;
        
            // Tạo tiêu đề cho cột trong Excel
            $sheet->setCellValue('A'.$rowCount, 'STT');
            $sheet->setCellValue('B'.$rowCount, 'Mã phòng');
            $sheet->setCellValue('C'.$rowCount, 'Mã tòa');
            $sheet->setCellValue('D'.$rowCount, 'Số người');
            $sheet->setCellValue('E'.$rowCount, 'Tiền phòng');
            $sheet->setCellValue('F'.$rowCount, 'Trạng thái');
            // Định dạng cột tiêu đề
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
        
            // Gán màu nền
            $sheet->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
            // Căn giữa
            $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
            // Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
            $maphong = $_POST['txtTimkiem'];
            $matoa = $_POST['txtTimkiem'];
            $trangthai = $_POST['txtTimkiem'];
            $dulieu = $this->ds->find($maphong, $matoa, $trangthai);
        
            if ($dulieu && mysqli_num_rows($dulieu) > 0) {
                while ($row = mysqli_fetch_array($dulieu)) {
                    $rowCount++;
                    $sheet->setCellValue('A'.$rowCount, $rowCount - 1); // sửa lại giá trị của STT cho đúng
                    $sheet->setCellValue('B'.$rowCount, $row['maPhong']);
                    $sheet->setCellValue('C'.$rowCount, $row['maToa']);
                    $sheet->setCellValue('D'.$rowCount, $row['soNguoi']);
                    $sheet->setCellValue('E'.$rowCount, $row['tienPhong']);
                    $sheet->setCellValue('F'.$rowCount, $row['trangThai']);
                }
            } else {
                // Handle the case where no data is found
                echo "<script>alert('Không có dữ liệu để xuất');</script>";
                return;
            }
        
            // Kẻ bảng 
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheet->getStyle('A1:' . 'F' . ($rowCount))->applyFromArray($styleArray);
        
            $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
            $fileName = 'Danh sách.xlsx';
            $objWriter->save($fileName);
        
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Length: ' . filesize($fileName));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: no-cache');
            readfile($fileName);
            exit;
        }
        ///////  Nhập     //////
        if (isset($_POST['btnNhap'])) {
            if (empty($_FILES['txtfile']['name'])) {
                echo "<script>alert('Vui lòng chọn file!')</script>";
            } elseif ($_FILES['txtfile']['size'] == 0) {
                echo "<script>alert('File không được để trống!')</script>";
            } else {
                $file = $_FILES['txtfile']['tmp_name'];
                // require 'PHPExcel/IOFactory.php';  // Đảm bảo bạn đã bao gồm thư viện PHPExcel

                try {
                    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                    $objExcel = $objReader->load($file);
                    $sheetData = $objExcel->getActiveSheet()->toArray(null, true, true, true);
                    $highestRow = $objExcel->setActiveSheetIndex(0)->getHighestRow();
                    $importSuccess = true;

                    for ($i = 2; $i <= $highestRow; $i++) {
                        $maphong = $sheetData[$i]["A"];
                        $matoa = $sheetData[$i]["B"];
                        $songuoi = $sheetData[$i]["C"];
                        $tienphong = $sheetData[$i]["D"];
                        $trangthai = $sheetData[$i]["E"];
                        if (empty($maphong) || empty($matoa) || empty($songuoi) || empty($tienphong) || empty($trangthai)) {
                            echo "<script>alert('Vui lòng điền đầy đủ thông tin ở hàng {$i}!')</script>";
                            $importSuccess = false;
                            continue;
                        }

                        // Kiểm tra trùng mã 
                        $kq1 = $this->ds->checktrungma2($maphong,$matoa);
                        if ($kq1) {
                            echo "<script>alert('Mã phòng ở hàng {$i} đã tồn tại!')</script>";
                            $importSuccess = false;
                            continue;
                        } else {
                            // Gọi hàm thêm dữ liệu insert trong model
                            $kq = $this->ds->insert($maphong,$matoa,$songuoi,$tienphong,$trangthai);
                            if (!$kq) {
                                echo "<script>alert('Import thất bại ở hàng {$i}!')</script>";
                                $importSuccess = false;
                            }
                        }
                    }

                    if ($importSuccess) {
                        echo "<script>alert('Import thành công!')</script>";
                    } else {
                        echo "<script>alert('Có lỗi xảy ra khi import! Vui lòng kiểm tra lại.')</script>";
                    }
                } catch (Exception $e) {
                    echo "<script>alert('Có lỗi xảy ra khi xử lý file: ".$e->getMessage()."')</script>";
                }
            }
        }
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
    function lien_ket($hopdong)
    {

        $dulieu = $this->ds->find3($hopdong);
        $this->view('Masterlayout', [
            'page' => 'Chitietphong_v',
            'dulieu1' => $this->ds->ds_sinhvien($hopdong),
            'dulieu' => $dulieu,
        ]);
    }
    

    
}
?>