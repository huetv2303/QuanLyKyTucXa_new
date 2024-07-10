<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý gửi xe</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    #txtMaSv {
        margin-left: 100px;
        width: 300px;
    }

    #txtTenSv {
        width: 300px;
        margin-left: 10px;
    }

    #btnTimKiem {
        margin-left: 20px;
    }

    #btnThemMoi {
        margin-left: 10px;
    }

    #btnNhapExcel {
        margin-left: 100px;
    }
</style>

<body>
    <div class="main">
        <div class="header">
            <h3 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Danh sách sinh viên gửi xe</h3>
        </div>
        <br>
        <div class="form-inline" style="text-align: center;">
            <table style="margin: auto;">
                <tr>
                    <form method="post" action="http://localhost/QuanLyKyTucXa_new/QLyGuiXe/search">
                        <td>
                            <input placeholder="Nhập mã sinh viên" type="text" id="txtMaSv" class="form-control" name="txtMaSV" value="<?php if (isset($data['maNv'])) echo $data['maNv'] ?>">
                        </td>

                        <td>
                            <input placeholder="Nhập tên sinh viên" type="text" id="txtTenSv" class="form-control" name="txtTenSV" value="<?php if (isset($data['tenNv'])) echo $data['tenNv'] ?>">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary" name="btnTimKiem" id="btnTimKiem"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm Kiếm </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="btnThemMoi"><i class="fa-solid fa-plus">&nbsp;&nbsp;</i>Thêm Mới</button>
                        </td>
                </tr>
            </table>
            <br>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExcel" id="btnNhapExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Nhập Excel</button>
            <button type="submit" class="btn btn-success" name="btnXuatExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Xuất Excel</button>
            </form>
        </div>
        <br>
        <table class="table table-hover" border="1px solid black" style="width: 95%; margin-left: 30px;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Mã phòng</th>
                    <th>Mã tòa</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ngày bắt đầu</th>
                    <th>Loại xe</th>
                    <th>Biển số xe</th>
                    <th>Chức năng</th>
                </tr>
            </thead>

            <!--Table body  -->
            <tbody>
                <?php
                if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                ?>
                        <tr>
                            <td><?php echo (++$i) ?></td>
                            <td><?php echo $row['ID'] ?></td>
                            <td><?php echo $row['studentName'] ?></td>
                            <td><?php echo $row['roomCode'] ?></td>
                            <td><?php echo $row['buildingCode'] ?></td>
                            <td><?php echo $row['phoneNumber'] ?></td>
                            <td>
                                <marquee behavior="" direction="left">
                                    <p><?php echo $row['email'] ?></p>
                                </marquee>
                            </td>
                            <td><?php echo $row['registerDate'] ?></td>
                            <td><?php echo $row['typeOfVehicle'] ?></td>
                            <td><?php echo $row['plate'] ?></td>
                            <td style="width: 200px;">
                                <a href="http://localhost/QuanLyKyTucXa_new/QLyGuiXe/update_load/<?php echo $row['ID'] ?>" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square">&nbsp;&nbsp;</i>Sửa</a> &nbsp;
                                <a onclick="return confirm('Bạn có muốn xóa nhân viên này không ?')" href="http://localhost/QuanLyKyTucXa_new/QLyGuiXe/DeleteInfo/<?php echo $row['ID'] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash">&nbsp;&nbsp;</i>Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="http://localhost/QuanLyKyTucXa_new/QLyGuiXe/Insert" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">THÊM MỚI SINH VIÊN ĐĂNG KÝ GỬI XE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Mã sinh viên :</label>
                            <!-- <select name="txtID" id="ID" class="form-control"> -->
                            <?php
                            //if (isset($data['id']) && mysqli_num_rows($data['id']) > 0) {
                            // while ($row = mysqli_fetch_assoc($data['id'])) {
                            ?>
                            <!-- <option value="<?php echo $row['maSinhVien'] ?>"><?php echo $row['maSinhVien'] ?></option> -->
                            <?php
                            //  }
                            //}
                            ?>
                            <!-- </select> -->
                            <input type="text" class="form-control" placeholder="Nhập mã sinh viên" name="txtID" require>
                            <label>Tên sinh viên :</label>
                            <input type="text" class="form-control" placeholder="Nhập họ tên" name="txtTenSv" require id="TenSV">
                            <label>Mã phòng :</label>
                            <input type="text" class="form-control" placeholder="Nhập mã phòng" name="txtPhong" require id="maPhong">
                            <label>Mã tòa :</label>
                            <input type="text" class="form-control" placeholder="Chọn mã tòa" name="txtMaToa" require id="maToa">
                            <label>Số điện thoại :</label>
                            <input type="number" class="form-control" placeholder="Nhập số điện thoại" name="txtSdt" require id="Sdt">
                            <label>Email :</label>
                            <input type="text" class="form-control" placeholder="Nhập email" name="txtEmail" require id="email">
                            <label>Ngày đăng ký :</label>
                            <input type="date" class="form-control" placeholder="Chọn ngày đăng ký" name="txtDate" require>
                            <label>Loại xe :</label>
                            <select name="txtType" id="" class="form-control">
                                <option value="">--- Chọn loại xe</option>
                                <option value="Xe máy">Xe máy</option>
                                <option value="Xe máy điện">Xe máy điên</option>
                                <option value="Ô tô">Ô tô</option>
                                <option value="Xe đạp">Xe đạp</option>
                            </select>
                            <label>Biển kiểm soát :</label>
                            <input type="text" class="form-control" placeholder="Nhập biển số xe" name="txtPlate" require>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" name="btnLuu">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal choose file Excel -->
    <form action="http://localhost/QuanLyKyTucXa_new/QLyGuiXe/ImportExcel" method="post" enctype="multipart/form-data">
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