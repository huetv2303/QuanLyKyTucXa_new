<?php
class HopDongThem extends controller
{
    protected $hopdongthem;
    protected $dsnv;
    protected $nhanviens;

    public function __construct()
    {
        $this->hopdongthem = $this->model('HopDong_m');
        $this->dsnv = $this->model('NhanVien_m');
    }

    public function Get_data()
    {
        $nhanvien = $this->hopdongthem->nhanvien_all();
        // $sinhvien = $this->hopdongthem->sinhvien_available();
        $truongnhom = $this->hopdongthem->truongnhom_available();
        $phong = $this->hopdongthem->phong_all();
        $toa = $this->hopdongthem->toa_all();

        $this->view('Masterlayout', [
            'page' => 'HopDong_them_v',
            'nhanvien' => $nhanvien,
            // 'sinhvien' => $sinhvien,
            'truongnhom' => $truongnhom,
            'phong' => $phong,
            'toa' => $toa
        ]);
    }
    public function them()
    {
        if (isset($_POST['btnLuu'])) {
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $mtn = $_POST['txtMaTruongNhom'];
            $msv = $_POST['txtMaSinhVien'];
            $mt = $_POST['txtMaToa'];
            $mp = $_POST['txtMaPhong'];
            $start = $_POST['txtNgayBatDau'];
            $end = $_POST['txtNgayKetThuc'];
            $tp = $_POST['txtTienPhong'];
            $tt = 'Còn hạn';


            //check trùng mã kh

            $checkmhd = $this->hopdongthem->checkmahopdong($mhd);
            $checkmasv = $this->hopdongthem->checkmatn($mtn);
            // $checkphong = $this->hopdongthem->checkphong($mp);

            if ($checkmhd || $checkmasv || ($start > $end)) {
                if ($checkmhd) echo "<script>alert('Trùng mã hợp đồng')</script>";
                if ($checkmasv) echo "<script>alert('Trùng mã sinh viên')</script>";
                if ($start > $end) echo "<script>alert('Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu hợp đồng')</script>";
                $view = 'HopDong_them_v';
            } else {
                $kq = $this->hopdongthem->hopdong_ins($mhd, $mnv, $mtn, $mt, $mp, $start, $end, $tt);
                if ($kq) {
                    echo "<script>alert('Thêm mới thành công')</script>";
                    $view = 'HopDong_v';
                } else {
                    echo "<script>alert('Thêm mới thất bại')</script>";
                    $view = 'HopDong_them_v';
                }
            }
        }
        $dulieu = $this->hopdongthem->hopdong_all();
        $nhanvien = $this->hopdongthem->nhanvien_all();
        $truongnhom = $this->hopdongthem->truongnhom_available();
        $phong = $this->hopdongthem->phong_all();
        $toa = $this->hopdongthem->toa_all();
        $this->view('Masterlayout', [
            'page' => $view,
            // 'maHopDong' => $mhd,
            // 'maNhanVien' => $mnv,
            // 'maTruongNhom' => $mtn,
            // 'maSinhVien' => $msv,
            'maToa'=>$mt,
            'maPhong' => $mp,
            'ngayBatDau' => $start,
            'ngayKetThuc' => $end,
            'tienPhong'=> $tp,
            'tinhTrang' => $tt,
            'nhanvien' => $nhanvien,
            'truongnhom' => $truongnhom,
            'phong' => $phong,
            'toa' => $toa,
            'dulieu' => $dulieu
        ]);
    }

    function get_phong_by_toa()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->hopdongthem->get_phong_by_toa($maToa);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }

    // function get_tien_phong_by_phong()
    // {
    //     if (isset($_POST['maPhong'])) {
    //         $maPhong = $_POST['maPhong'];
    //         $result = $this->hopdongthem->get_tien_phong_by_phong($maPhong);
    //         $rooms = array();
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $rooms[] = $row;
    //         }
    //         echo json_encode($rooms);
    //     }
    // }

    function get_tien_phong_by_phong()
    {
        if (isset($_POST['maPhong'])) {
            $maPhong = $_POST['maPhong'];
            $result = $this->hopdongthem->get_tien_phong_by_phong($maPhong);

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
