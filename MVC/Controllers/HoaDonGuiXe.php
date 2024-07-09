<?php
class HoaDonGuiXe extends controller
{
    private $hdgx;
    function __construct()
    {
        $this->hdgx = $this->model('HoaDonGuiXe_m');
    }

    //  Func chuyển trang và lấy dữ liệu
    function Get_data()
    {
        $dulieu = $this->hdgx->load_Data();
        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $dulieu
        ]);
    }

    // Func thêm mới dữ liệu
    function Insert()
    {
        $mhd = $_POST['txtBillCode'];
        $id = $_POST['txtID'];
        $name = $_POST['txtName'];
        $month = $_POST['txtMonth'];
        $price = $_POST['txtPrice'];
        $day = $_POST['txtDay'];
        $type = $_POST['txtType'];
        $plate = $_POST['txtPlate'];
        $status = $_POST['txtStatus'];
        $note = $_POST['txtNote'];

        // Kiểm tra xem người dùng có nhập đủ thông tin không
        if ($id == '' || $name == '') {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
        } else {
            // Kiểm tra trùng mã nhân viên
            $kq = $this->hdgx->Check($id);
            if ($kq) {
                echo "<script>alert('Mã hóa đơn đã tồn tại !!!')</script>";
            } else {
                // Gọi hàm thêm 
                $result = $this->hdgx->insert_Data($mhd, $id, $name, $month, $price, $day, $type, $plate, $status, $note);
                if ($result) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else
                    echo "<script>alert('Thêm mới thất bại!')</script>";
            }
        }
        $dulieu = $this->hdgx->load_Data();
        $this->view('MasterLayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $dulieu
        ]);
    }

    // Func sửa dữ liệu hóa đơn
    function Update($mhd)
    {
        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_sua_v',
            'dulieu' => $this->hdgx->search_Data($mhd, '', '')
        ]);
    }

    function UpdateData()
    {
        if (isset($_POST['btnCapNhat'])) {
            $mhd = $_POST['txtBillCode'];
            $month = $_POST['txtMonth'];
            $price = $_POST['txtPrice'];
            $day = $_POST['txtDay'];
            $status = $_POST['txtStatus'];
            $note = $_POST['txtNote'];

            // Gọi func sửa dữ liệu trong Model
            $kq = $this->hdgx->update_Data($mhd, $month, $price, $day, $status, $note);
            if ($kq) {
                echo "<script>alert('Sửa thành công!')</script>";
            } else
                echo "<script>alert('Sửa thất bại!')</script>";

            //Gọi lại giao diện và truyền dữ liệu ra
            $dulieu = $this->hdgx->load_Data();
            $this->view('Masterlayout', [
                'page' => 'HoaDonGuiXe_v',
                'dulieu' => $dulieu
            ]);
        }

        // Kiểm tra xem người dùng có nhấn vào nút Quay lại không
        if (isset($_POST['btnBack'])) {
            $dulieu = $this->hdgx->load_Data();
            $this->view('Masterlayout', [
                'page' => 'HoaDonGuiXe_v',
                'dulieu' => $dulieu
            ]);
        }
    }

    // Func xóa thông tin hóa đơn
    function Delete($mhd)
    {
        $kq = $this->hdgx->delete_Data($mhd);
        if ($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";

        //Gọi lại giao diện và truyền $dulieu ra
        $dulieu = $this->hdgx->load_Data();
        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $dulieu
        ]);
    }

    // Func tìm kiếm hóa đơn
    function Search()
    {
        $mhd = $_POST['txtBillCode'];
        $id = $_POST['txtID'];
        $status = $_POST['txtStatus'];

        $this->view('Masterlayout', [
            'page' => 'HoaDonGuiXe_v',
            'dulieu' => $this->hdgx->search_Data($mhd, $id, $status)
        ]);
    }
}
