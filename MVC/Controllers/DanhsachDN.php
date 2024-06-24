<?php
class DanhsachDN extends controller{
    private $dsdv;

    function __construct()
    {
        $this->dsdv = $this->model('DienNuoc_m');
    }

    function Get_data()
    {
        $dulieu = $this->dsdv->dichvuDN_all();
        
        $this->view('MasterLayout', [
            'page' => 'DanhsachDN_v',
            'dulieu' => $dulieu,

        ]);

        $this->view('MasterLayout', ['page' => 'DanhsachDN_v']);

        // if(isset($_POST['btnadd'])){
        // $this->view('MasterLayout', [
        //             'page' => 'DichVu_v'
        //       ]);
        // }      
    }


    function suadl()
    {
        if (isset($_POST['btnLuu'])) {
            
            $id_service = $_POST['txtMaDV'];
            $name = $_POST['txtTenDV'];
            $price = $_POST['txtGia'];
            $unit = $_POST['txtDonVi'];
            //gọi hàm sủa dl tacgia_udp trong model
            $kq = $this->dsdv->dichvuDN_upd($id_service,$name, $price, $unit);

          
                    //gọi hàm thêm dl tacgia_ins trong model
                    if ($kq) {
                        echo "<script>alert('Sửa thành công!')</script>";
                    } else
                        echo "<script>alert('Sửa thất bại!')</script>";
                
            }
           

            // Gọi lại giao diện và truyền $dulieu ra
           
            $dulieu = $this->dsdv->dichvuDN_all();
            $this->view('MasterLayout', [
                'page' => 'DanhsachDN_v',
                'dulieu' => $dulieu,
                
            ]);
        
    } 
}