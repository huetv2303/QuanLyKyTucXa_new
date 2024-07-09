<?php
class Toa_c extends controller
{
    private $ds;
    function __construct()
    {
        $this->ds = $this->model('Toa_m');
    }

    function Get_data()
    {
        $dulieu = $this->ds->all();
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu' => $dulieu,
        ]);
    }

    function xoa($matoa)
    {
        $kq2 = $this->ds->checktrungma3($matoa);
        $kq3= $this->ds->checktrungma4($matoa);
        
        if ($kq2|| $kq3)
            echo "<script>alert('Tồn tại các mục con chứa tòa!')</script>";
        else{
            $kq = $this->ds->delete($matoa);
            if ($kq)
                echo "<script>alert('Xóa thành công!')</script>";
            else
                echo "<script>alert('Xóa thất bại!')</script>";

        }
            
        
        $dulieu = $this->ds->all();
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu' => $dulieu,
        ]);
    }

    function sua($matoa)
    {
        $dulieu = $this->ds->find3($matoa);
        $this->view('Masterlayout', [
            'page' => 'Toa_v',
            'dulieu' => $this->ds->all(),
            'dulieu_sua' => $dulieu
        ]);
    }

    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            $matoa = $_POST['txtMatoa'];
            $sophong = $_POST['txtSophong'];

            if (empty($matoa) || empty($sophong)) {
                echo "<script>alert('Không để trống dữ liệu !')</script>";

                $dulieu = $this->ds->find3($matoa);
                $this->view('Masterlayout', [
                    'page' => 'Toa_v',
                    'dulieu' => $this->ds->all(),
                    'dulieu_sua' => $dulieu
                ]);
            } else {
                $kq = $this->ds->update($matoa, $sophong);

                if ($kq) {
                    echo "<script>alert('Sửa thành công!')</script>";
                } else {
                    echo "<script>alert('Sửa thất bại!')</script>";
                }

                $dulieu = $this->ds->all();
                $this->view('Masterlayout', [
                    'page' => 'Toa_v',
                    'dulieu' => $dulieu,
                ]);
            }
        }
    }

    function lien_ket($matoa)
    {
        $dulieu = $this->ds->find3($matoa);
        $this->view('Masterlayout', [
            'page' => 'Chitiettoa_v',
            'dulieu1' => $this->ds->ds_nv($matoa),
            'dulieu' => $dulieu,
        ]);
    }
}
?>