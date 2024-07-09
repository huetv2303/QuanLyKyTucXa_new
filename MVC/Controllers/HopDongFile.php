<?php
    class hopdongfile extends controller{
        protected $hopdongfile;
        public function Get_data(){
            $this->view('Masterlayout',[
                'page'=>'HopDong_file_v'
            ]);
        }

        public function __construct() {
            $this->hopdongfile = $this->model('HopDong_m');
        }
        
        function nhapexcel(){
            if (isset($_POST['btnUpload'])){
                $file=$_FILES['txtFile']['tmp_name'];
                $objReader=PHPExcel_IOFactory::createReaderForFile($file);
                $objExcel=$objReader->load($file);
                //Lấy sheet hiện tại
                $sheet=$objExcel->getSheet(0);
                $sheetData=$sheet->toArray(null,true,true,true);

                // print_r($sheetData);

                for($i=2;$i<=count($sheetData);$i++){
                    $mhd=$sheetData[$i]["A"];
                    $mnv=$sheetData[$i]["B"];
                    $msv=$sheetData[$i]["C"];
                    $mt=$sheetData[$i]["D"];
                    $mp=$sheetData[$i]["E"];
                    $start=$sheetData[$i]["F"]; 
                    $end=$sheetData[$i]["G"];
                    $tt = 'Còn hạn';
                    $this->hopdongfile->hopdong_ins($mhd, $mnv, $msv, $mt, $mp, $start, $end, $tt);
                }

                echo "<script>alert('nhập file excel thành công!')</script>";
                $this->view('MasterLayout',[
                    'page'=>'HopDong_file_v'
                ]);
            }
        }

    }


?>