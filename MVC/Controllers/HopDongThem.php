<?php
class HopDongThem extends controller
{
    protected $hopdongthem;
    protected $nhanviens;

    public function __construct()
    {
        $this->hopdongthem = $this->model('HopDong_m');
    }

    public function Get_data()
    {
        $nhanvien = $this->hopdongthem->nhanvien_all();
        $sinhvien = $this->hopdongthem->sinhvien_available();
        $phong = $this->hopdongthem->phong_available();
        $this->view('Masterlayout', [
            'page' => 'HopDong_them_v',
            'nhanvien' => $nhanvien,
            'sinhvien' => $sinhvien,
            'phong' => $phong
        ]);
    }
    public function them()
    {
        if (isset($_POST['btnLuu'])) {
            $mhd = $_POST['txtMaHopDong'];
            $mnv = $_POST['txtMaNhanVien'];
            $msv = $_POST['txtMaSinhVien'];
            $mp = $_POST['txtMaPhong'];
            $start = $_POST['txtNgayBatDau'];
            $end = $_POST['txtNgayKetThuc'];
            $tt = $_POST['txtTinhTrang'];


            //check trùng mã kh

            $checkmhd = $this->hopdongthem->checkmahopdong($mhd);
            $checkmasv = $this->hopdongthem->checkmasv($msv);
            $checkphong = $this->hopdongthem->checkphong($mp);

            if ($checkmhd || $checkmasv || $checkphong || ($start > $end)) {
                if ($checkmhd) echo "<script>alert('Trùng mã hợp đồng')</script>";
                if ($checkmasv) echo "<script>alert('Trùng mã sinh viên')</script>";
                if ($checkphong) echo "<script>alert('Trùng mã phòng')</script>";
                if ($start > $end) echo "<script>alert('Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu hợp đồng')</script>";
            } else {
                $kq = $this->hopdongthem->hopdong_ins($mhd, $mnv, $msv, $mp, $start, $end, $tt);
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
        $sinhvien = $this->hopdongthem->sinhvien_available();
        $phong = $this->hopdongthem->phong_available();
        $this->view('Masterlayout', [
            'page' => $view,
            'maHopDong' => $mhd,
            'maNhanVien' => $mnv,
            'maSinhVien' => $msv,
            'maPhong' => $mp,
            'ngayBatDau' => $start,
            'ngayKetThuc' => $end,
            'tinhTrang' => $tt,
            'nhanvien' => $nhanvien,
            'sinhvien' => $sinhvien,
            'phong' => $phong,
            'dulieu' => $dulieu
        ]);
    }
}
