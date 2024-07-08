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
}
