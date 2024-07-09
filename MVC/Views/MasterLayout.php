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

    <link rel="stylesheet" href="http://localhost/QuanLyKyTucXa_new/Public/CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="http://localhost/QuanLyKyTucXa_new/Public/CSS/master.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="http://localhost/QuanLyKyTucXa_new/Public/CSS/style.css?v= <?php echo time() ?>">
    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v= <?php echo time() ?>"> </script>

    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v=1"> </script>
    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/phong.js?v=1"> </script>

    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v= <?php echo time() ?>"> </script>

    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/XemSV_js.js?v= <?php echo time() ?>"> </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="http://localhost/QuanLyKyTucXa_new/Public/CSS/l1.css">
    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js?v=<?php echo time(); ?>"></script>
    <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/phong.js?v=1"></script>
    <script src="https:/cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <div class="d-flex">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img style="width:200px; height: 130px" src="https://utt.edu.vn/home/images/stories/logo-utt-border.png" alt="">
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
                         <li><a href="http://localhost/QuanLyKyTucXa_new/NhomSV">Danh sách nhóm sv</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#tablesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Quản lý hợp đồng</a>
                    <ul class="collapse list-unstyled" id="tablesSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/HopDong">Danh sách hợp đồng</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/HopDongThem">Thêm mới hợp đồng</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/HopDongGiaHan">Gia hạn hợp đồng</a></li>                      
                        <li><a href="http://localhost/QuanLyKyTucXa_new/HopDongKetThuc">Kết thúc hợp đồng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#dataPresentationSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dịch vụ</a>
                    <ul class="collapse list-unstyled" id="dataPresentationSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachPDV">Đăng ký dịch vụ</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachDN">Điện nước</a></li>
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachDV/">Dịch vụ khác</a></li>
                        <li><a href="http://localhost//QuanLyKyTucXa_new/QLyGuiXe">Dịch vụ gửi xe</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#invoiceSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Quản lý hóa đơn</a>
                    <ul class="collapse list-unstyled" id="invoiceSubmenu">
                        <li><a href="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV">Hóa đơn dịch vụ</a></li>
                        <li><a href="http://localhost//QuanLyKyTucXa_new/NopTienPhong">Nộp tiền phòng</a></li>
                        <li><a href="http://localhost//QuanLyKyTucXa_new/HoaDonGuiXe">Hóa đơn gửi xe</a></li>
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
            <header class="header1">
                <!-- <div class="header_1" >
                </div> -->
                <p></p>
                <!-- <marquee behavior="" direction="right"><h1>Quản lý ký túc xá</h1></marquee> -->
                <h1>Quản lý ký túc xá</h1>
                <div class="out">
                <i style="color:#0A9DE2" class="fa-solid fa-right-from-bracket"></i>
                <a  href="http://localhost/QuanLyKyTucXa_new/DangNhap"></i>Thoát</a>
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
