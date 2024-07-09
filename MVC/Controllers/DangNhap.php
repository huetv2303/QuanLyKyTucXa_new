<?php
class DangNhap extends controller{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('DangNhap_m');
    }

    function Get_data()
    {
        $this->view('Login', [
            'page' => 'DangNhap_v',

        ]);
    }
    function Authenticate()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->dsdv->account($username, $password);

            if ($result->num_rows > 0) {
                // Đăng nhập thành công
               
                header('Location: http://localhost/QuanLyKyTucXa_new/Home');
            } else {
                // Đăng nhập thất bại
                $this->view('Login', [
                    'page' => 'DangNhap_v',
                    'error' => 'Tài khoản hoặc mật khẩu không hợp lệ!'
                ]);
            }
        }
    }
    

}