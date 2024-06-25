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
        $sinhvien = $this->hopdonggiahan->sinhvien_all();
        $phong = $this->hopdonggiahan->phong_all();
        $this->view('Masterlayout', [
            'page' => 'HopDongGiaHan_giahan_v',
            'dulieu' => $this->hopdonggiahan->hopdong_find($mhd, '', '', ''),
            'nhanvien' => $nhanvien,
            'sinhvien' => $sinhvien,
            'phong' => $phong
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
}
