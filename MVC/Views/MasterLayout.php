<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý ký túc xá</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7c35a47a4f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="http://localhost:9090/QuanLyKyTucXa_new/Public/CSS/style.css?v= <?php echo time() ?>">
    <script src="http://localhost:9090/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v= <?php echo time() ?>"> </script>


    <script src="http://localhost:9090/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v=1"> </script>
    <script src="http://localhost:9090/QuanLyKyTucXa_new/Public/JS/phong.js?v=1"> </script>

    <script src="http://localhost:9090/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v= <?php echo time() ?>"> </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="http://localhost:9090/QuanLyKyTucXa_new/Public/CSS/l1.css">
    
    
    <link rel="stylesheet" href="/Public/CSS/masterlayout.css">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .color-hover {
            color: #e43f32;
        }

        #nav1 ul {
            background-color: #212526;
        }

        #nav1 a {
            color: #000000;
            font-weight: 500;
        }

        #nav1 a:hover {
            color: #e43f32;
        }

        #menu-left1 {
            float: left;
            width: 20%;
            width: 210px;
        }

        #menu-left1 img {
            width: 100%;
        }

        #menu-left1 .main-list {
            background: #dddddd;
            font-weight: 500;
            text-align: left;
        }


        #content-right1 {
            float: left;
            width: 80%;
        }

        #content-right1 .textbox1 {
            width: 200px;
        }

        #content-right1 .label1 {
            width: 80px;
        }

        #content-right1 .label2 {
            width: 60px;
        }


    </style>

    <link rel="stylesheet" href="http://localhost:9090/QuanLyKyTucXa_new/Public/CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="http://localhost:9090/QuanLyKyTucXa_new/Public/CSS/master.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="http://localhost:9090/QuanLyKyTucXa_new/Public/CSS/l1.css">
    <script src="http://localhost:9090/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v=<?php echo time(); ?>"></script>
    <script src="http://localhost:9090/QuanLyKyTucXa_new/Public/JS/phong.js?v=1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
<<<<<<< HEAD
    <div class="container-fluid">
        <!-- Start: Header -->
        <div id="header1">
            <!-- <img src="https://utt.edu.vn/uploads/images/site/1447346709LOGO_GTVT.png" alt="LOGO UTT"> -->
            <div id="nav1">
                <ul class="nav navbar justify-content bg-light ">
                   <a href="http://localhost:9090/QuanLyKyTucXa_new/Home" ><img style="width : 300px;" src="https://utt.edu.vn/uploads/images/site/1447346709LOGO_GTVT.png" alt="LOGO UTT">
                   </a> 
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="http://localhost:9090/QuanLyKyTucXa_new/Home">Trang chủ</a> -->

                         <h1>Quản lý ký túc xá</h1>
                    </li>

                    

                    

                    <li class="nav-item">
                        <a class="nav-link" href="#">Thoát</a>

                    </li>

                </ul>
            </div>
        </div>
        <!-- End: Header -->

        <!-- Start: Content -->
        <div id="content1">
            <div id="menu-left1">
                <!-- <img src="https://utt.edu.vn/uploads/images/site/1447346709LOGO_GTVT.png" alt="LOGO UTT"> -->

                <div class="card">
                    <div class="card-header">
                        <a class="btn" data-bs-toggle="collapse" href="#collapseFive">
                            Ký túc xá
                        </a>
                    </div>
                    <div id="collapseFive" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/Toa_c" class="btn">Danh sách tòa</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DanhsachPhong_c" class="btn">Danh sách phòng</a>
                         
                        </div>
                    </div>
                </div>

                
                <div class="card">
                    <div class="card-header">
                        <a class="btn" data-bs-toggle="collapse" href="#collapseSix">
                            Quản lý thông tin
                        </a>
                    </div>
                    <div id="collapseSix" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DsNhanVien" class="btn">Danh sách nhân viên</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DanhsachSV" class="btn">Danh sách sinh viên</a>
                         
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a class="btn" data-bs-toggle="collapse" href="#collapseTwo">
                            Quản lý hợp đồng
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">

                            <a href="http://localhost:9090/QuanLyKyTucXa_new/HopDong" class="btn">Danh sách hợp đồng</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/HopDongGiaHan" class="btn">Gia hạn hợp đồng</a>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a class="btn" data-bs-toggle="collapse" href="#collapseThree">
                            Dịch vụ
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">

                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DanhsachPDV" class="btn">Đăng ký dịch vụ</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DanhsachDN" class="btn">Điện nước</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DanhsachDV" class="btn">Dịch vụ khác</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/DanhsachHDDV" class="btn">Hóa đơn dịch vụ</a>

                        </div>
                    </div>
                </div>

                

                <div class="card">
                    <div class="card-header">
                        <a class="btn" data-bs-toggle="collapse" href="#collapseFour">
                            Thống kê
                        </a>
                    </div>
                    <div id="collapseFour" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/TKNuoc" class="btn">Thống kê nước</a>
                            <a href="http://localhost:9090/QuanLyKyTucXa_new/TKDien" class="btn">Thống kê điện</a>
                        </div>
                    </div>
                </div>

    <div class="d-flex">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img style="width:200px; height: 130px" src="https://th.bing.com/th/id/R.e86a2f7c0d27cb5c409a7b3f3a315fe8?rik=uKc2dRGoVuQNWA&riu=http%3a%2f%2futt.edu.vn%2fhome%2fimages%2fstories%2flogo-utt-border.png&ehk=xwQfVRyFndxbb5TeE0GZhK6TfE%2fZO6f0UtTKNHkKLko%3d&risl=&pid=ImgRaw&r=0" alt="">
            </div>

            <hr >
            <ul class="menu list-unstyled">
                <li>
                    <a href="http://localhost/QuanLyKyTucXa_new/Home"  aria-expanded="false" >Home</a>
                    
                </li>
                
                <li>
                    <a href="#formsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Quản lý</a>
                    <ul class="collapse list-unstyled" id="formsSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/Toa_c">Danh sách tòa</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachPhong_c">Danh sách phòng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#uiElementsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Quản lý thông tin</a>
                    <ul class="collapse list-unstyled" id="uiElementsSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DsNhanVien">Danh sách nhân viên</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachSV">Danh sách sinh viên</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#tablesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Quản lý hợp đồng</a>
                    <ul class="collapse list-unstyled" id="tablesSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/HopDong">Danh sách hợp đồng</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/HopDongGiaHan">Gia hạn hợp đồng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#dataPresentationSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dịch vụ</a>
                    <ul class="collapse list-unstyled" id="dataPresentationSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachPDV">Đăng ký dịch vụ</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachDN">Điện nước</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachDV/">Dịch vụ khác</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV">Hóa đơn dịch vụ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#layoutsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Thống kê</a>
                    <ul class="collapse list-unstyled" id="layoutsSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/TKNuoc">Thống kê nước</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/TKDien">Thống kê điện</a></li>
                    </ul>
                </li>
                
            </ul>
        </aside>
        <main class="main-content flex-grow-1">
            <header class="header">
                <div class="header-content d-flex justify-content-between align-items-center">
                    <h1>Quản lý ký túc xá</h1>
                </div>
            </header>
            <section id="content-right1">
                <?php
                // Include the specific page content
                include_once './MVC/Views/Pages/' . $data['page'] . '.php';
                ?>
            </section>
        </main>
    </div>
    <script src="scripts.js"></script>
</body>

</html>
