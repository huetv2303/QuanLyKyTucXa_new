<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thông tin sinh viên</title>
    <style>
        #dd1 {
            text-align: center;
        }

        /* #wrapper {
            padding: 50px;
            background-color: #0dcaf02b;
            height: 100%;
            position: absolute;
            width: 87%;
        } */

        #wrapper {
            padding: 50px;
            background-color: #0dcaf02b;
            min-height: 100vh;
            /* Đảm bảo phần tử có chiều cao tối thiểu */
            width: 87%;
            overflow: auto;
            /* Cho phép cuộn nếu nội dung vượt quá chiều cao */
        }

        /* .form-inline {
            border-radius: 20px;
            background-color: white;
            padding: 40px;
            text-align: left;
        } */

        /* .container-fluid {
            padding: 0px;
        } */

        #tableTimKiem {
            margin-left: 400px;
            margin-bottom: 10px;
            margin-top: 10px;
        }



        #inputTenSinhVien {
            margin-left: 10px;
        }
    </style>
</head>


<body>
    <div id="wrapper" style="height: -webkit-fill-available;">
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachSV/timKiem">
            <div  style="color: #08449b">
            </div>

            <div class="form-inline">

                <table id="tableThem" style="width: 100%">
                    <tr>
                        <td style="float: left;">
                            <h2>Quản lý thông tin sinh viên</h2>
                        </td>
                        <td style="float: right;  margin: 10px">
                            <button type="submit" class="btn btn-success" name=""><a href="http://localhost/QuanLyKyTucXa_new/SinhVien" style="text-decoration: none; color:white">Thêm mới</a></button>
                        </td>

                        <td style="float: right; margin: 10px">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExcel" id="btnNhapExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Nhập Excel</button>
                        </td>

                        <td style="float: right;  margin: 10px">
                            <button type="submit" class="btn btn-success" name="btnXuatExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Xuất Excel</button>
                        </td>
                    </tr>
                </table>

                <table id="tableTimKiem">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="txtTenSinhVien" placeholder="Tên sinh viên">
                        </td>

                        <td>
                            <input type="text" class="form-control" id="inputTenSinhVien" name="txtMaSinhVien" placeholder="Mã sinh viên">
                        </td>
                    </tr>
                </table>



                <button type="submit" class="btn btn-primary" name="btnTimKiem" style="margin-bottom: 20px; margin-right: 10px; margin-left: 580px;">Tìm kiếm</button>

                <table class="table table-striped" style="text-align: center;">

                    <tr style="background: #e9e6e6;">
                        <th>Mã sinh viên</th>
                        <th>Họ tên</th>
                        <!-- <th>Mã tòa</th>
                        <th>Mã phòng</th> -->
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>CCCD</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>



                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    ?>
                            <tr>
                                <td><?php echo $row['maSinhVien'] ?></td>
                                <td><?php echo $row['hoTen'] ?></td>
                                <!-- <td><?php echo $row['maToa'] ?></td>
                                <td><?php echo $row['maPhong'] ?></td> -->
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['soDienThoai'] ?></td>
                                <td><?php echo $row['ngaySinh'] ?></td>
                                <td><?php echo $row['gioiTinh'] ?></td>
                                <td><?php echo $row['cccd'] ?></td>
                                <td><?php echo $row['diaChi'] ?></td>


                                <td>
                                    <a href="http://localhost/QuanLyKyTucXa_new/DanhsachSV/sua/<?php echo $row['maSinhVien'] ?>" class="btn btn-outline-primary">Sửa</a> &nbsp;
                                    <a onclick="return confirm('Bạn có muốn xóa sinh viên này không?');" href="http://localhost/QuanLyKyTucXa_new/DanhsachSV/xoa/<?php echo $row['maSinhVien'] ?>" class="btn btn-outline-danger">Xóa</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>


                </table>

            </div>
        </form>
    </div>

    <!-- Modal choose file Excel -->
    <form action="http://localhost/QuanLyKyTucXa_new/DanhsachSv/ImportExcel" method="post" enctype="multipart/form-data">
        <div class="modal" id="modalExcel">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">CHỌN FILE EXCEL</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="txtFile">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" name="btnNhapDL">Nhập dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>