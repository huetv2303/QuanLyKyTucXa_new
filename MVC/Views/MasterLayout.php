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
    <link rel="stylesheet" href="http://localhost/QuanLyKyTucXa_new/Public/CSS/style.css?v= <?php echo time() ?>">
    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v=1"> </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    
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
</head>


<body>
    <div class="container-fluid">
        <!-- Start: Header -->
        <div id="header1">
            <!-- <img src="https://utt.edu.vn/uploads/images/site/1447346709LOGO_GTVT.png" alt="LOGO UTT"> -->
            <div id="nav1">
                <ul class="nav navbar justify-content bg-light ">
                    <img style="width : 200px;" src="https://utt.edu.vn/uploads/images/site/1447346709LOGO_GTVT.png" alt="LOGO UTT">

                    <li class="nav-item">
                        <a class="nav-link" href="#">Trang chủ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Quản lí phòng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Quản lí sinh viên</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Quản lí hợp đồng</a>
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
                        <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
                            Chính #1
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <a href="" class="btn">Chuc nang 1</a>
                            <a href="" class="btn">Chuc nang 2</a>
                            <a href="" class="btn">Chuc nang 3</a>
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
                            <a href="http://localhost/QuanLyKyTucXa_new/HopDong" class="btn">Danh sách hợp đồng</a>
                            <a href="" class="btn">Chuc nang 2</a>
                            <a href="" class="btn">Chuc nang 3</a>
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
                            <a href="http://localhost/QuanLyKyTucXa_new/DanhsachPDV" class="btn">Đăng ký dịch vụ</a>
                            <a href="http://localhost/QuanLyKyTucXa_new/DanhsachDN" class="btn">Điện nước</a>
                            <a href="http://localhost/QuanLyKyTucXa_new/DanhsachDV" class="btn">Dịch vụ khác</a>
                            <a href="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV" class="btn">Hóa đơn dịch vụ</a>
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
                            <a href="http://localhost/QuanLyKyTucXa_new/TKNuoc" class="btn">Thống kê nước</a>
                            <a href="" class="btn">Chuc nang 2</a>
                            <a href="" class="btn">Chuc nang 3</a>
                        </div>
                    </div>
                </div>
            </div>



            <div id="content-right1">
                <?php
                // echo "Masterlayout";
                include_once './MVC/Views/Pages/' . $data['page'] . '.php';
                ?>
            </div>
        </div>
        <!-- End: Content -->
    </div>
</body>

</html>