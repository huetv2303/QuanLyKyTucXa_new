<?php
class SinhVien extends controller
{
    public $sinhvien;

    function __construct()
    {
        $this->sinhvien = $this->model('SinhVien_m');
    }

    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'SinhVien_v'
        ]);
    }

    function themmoi()
    {
        if (isset($_POST['btnLuu'])) {
            $msv = $_POST['txtMaSinhVien'];
            $ht = $_POST['txtHoTen'];
            // $matoa = $_POST['txtMaToa'];
            // $maphong = $_POST['txtMaPhong'];
            $email = $_POST['txtEmail'];
            $sdt = $_POST['txtSoDienThoai'];
            $gt = $_POST['txtGioiTinh'];
            $ns = $_POST['txtNgaySinh'];
            $cccd = $_POST['txtCccd'];
            $dc = $_POST['txtDiaChi'];

            $kq1 = $this->sinhvien->check_trung_ma($msv);
            if ($kq1) {
                echo "<script>alert('Trùng mã sinh viên!')</script>";
            } else {
                $kq = $this->sinhvien->sinhvien_ins($msv, $ht, $email, $sdt, $ns, $gt, $cccd, $dc);

                if ($kq) {
                    echo "<script>alert('Thêm mới thành công!')</script>";
                } else {
                    echo "<script>alert('Thêm mới thất bại!')</script>";
                }
            }

            if (isset($_POST['btnLuu'])) {
                $dulieu = $this->sinhvien->sinhvien_all();

                $this->view('Masterlayout', [
                    'page' => 'DanhsachSV_v',
                    'dulieu' => $dulieu,
                    'msv' => $msv,
                    'hoten' => $ht,
                    // 'matoa' => $matoa,
                    // 'maphong' => $maphong,
                    'email' => $email,
                    'sdt' => $sdt,
                    'gt' => $gt,
                    'cccd' => $cccd,
                    'dc' => $dc
                ]);
            }
        }
    }

    function get_phong_by_toa()
    {
        if (isset($_POST['maToa'])) {
            $maToa = $_POST['maToa'];
            $result = $this->sinhvien->get_phong_by_toa($maToa);
            $rooms = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rooms[] = $row;
            }
            echo json_encode($rooms);
        }
    }

    function edit($maSinhVien)
    {
        $student = $this->sinhvien->get_student_by_id($maSinhVien);
        if (!$student) {
            echo "<p>Không tìm thấy sinh viên.</p>";
            return;
        }

        $toa = $this->sinhvien->get_all_toa();
        $phong = $this->sinhvien->get_phong_by_toa($student['maToa']);

        $this->view('Masterlayout', [
            'page' => 'SinhVien_sua_v',
            'student' => $student,
            'toa' => $toa,
            'phong' => $phong
        ]);
    }
}
