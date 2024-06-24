<?php
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
            'dulieu' => $dulieu
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
}
