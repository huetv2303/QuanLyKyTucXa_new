<?php 
class Toa_c extends controller{
    private $ds;
    function __construct()
    {
        $this->ds=$this->model('Toa_m');
    }

    function Get_data(){
        $matoa=$_POST['txtMatoa'];
        $ma = $this->ds->all();
        $dulieu = $this->ds->update($matoa);
        $soluong=
        $this->view('Masterlayout',[
            'page'=>'Toa_v',
            'dulieu'=>$dulieu,
            'ma'=>$ma,


    ]);
    }  

    
    // function thongtin(){
    //     if(isset($_POST['btnThongtin'])){
    //         $matoa=$_POST['txtMatoa'];
    //         $sonv=$_POST['txtSonv'];
    //         $tennv=$_POST['txtTennv'];
    //         $sdt=$_POST['txtSDT'];
    //         $dulieu=$this->ds->all();
    //         $dulieu=$this->ds->update($matoa,$sonv,$tennv,$sdt);
    //         //Gọi lại giao diện và truyền $dulieu ra
    //         $this->view('Masterlayout',[
    //             'page'=>'Toa_v',
    //             'dulieu'=>$dulieu,
    //             'matoa'=>$matoa,
    //             'sonv'=>$sonv,
    //             'tennv'=>$tennv,
    //             'sdt'=>$sdt,
    //         ]);
    //     }
       
          
    // }
          
    
    
     

    function xoa($matoa){
        $kq=$this->ds->delete($matoa);
        if($kq)
            echo "<script>alert('Xóa thành công!')</script>";
        else
            echo "<script>alert('Xóa thất bại!')</script>";
        
        $dulieu=$this->ds->all();
        $this->view('Masterlayout',[
            'page'=>'Toa_v',
            'dulieu'=>$dulieu,
        ]);
    }
    
   
}
?>