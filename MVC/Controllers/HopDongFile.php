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
        
        function themmoi(){
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
                    $mp=$sheetData[$i]["D"];
                    $start=$sheetData[$i]["E"]; 
                    $end=$sheetData[$i]["F"];
                    $tt=$sheetData[$i]["G"];
                    $this->hopdongfile->hopdong_ins($mhd, $mnv, $msv, $mp, $start, $end, $tt);
                }

                echo "<script>alert('Thêm mới thành công!')</script>";
                $this->view('MasterLayout',[
                    'page'=>'HopDong_file_v'
                ]);
            }
        }

    }


?>