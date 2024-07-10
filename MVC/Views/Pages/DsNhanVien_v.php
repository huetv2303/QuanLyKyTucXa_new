<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>

</head>
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    #txtMaNv {
        margin-left: 100px;
        width: 300px;
    }

    #txtTenNv {
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
        margin-left: 400px;
    }

    .form-inline{
        text-align: center;
    }
</style>

<body>
    <div class="main">
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DsNhanVien/Search">
            <div>
                <div class="header">
                    <h3>Danh sách nhân viên</h3>
                </div>
                <br>
                <div class="form-inline">
                    <table style="margin: auto;">
                        <tr>
                            <td>
                                <input placeholder="Nhập mã nhân viên" type="text" id="txtMaNv" class="form-control" name="txtMaNV" value="<?php if (isset($data['maNv'])) echo $data['maNv'] ?>">
                            </td>

                            <td>
                                <input placeholder="Nhập tên nhân viên" type="text" id="txtTenNv" class="form-control" name="txtTenNV" value="<?php if (isset($data['tenNv'])) echo $data['tenNv'] ?>">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="btnTimKiem" id="btnTimKiem"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm Kiếm </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="btnThemMoi"><i class="fa-solid fa-plus">&nbsp;&nbsp;</i>Thêm Mới</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExcel" id="btnNhapExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Nhập Excel</button>
                <button type="submit" class="btn btn-success" name="btnXuatExcel"><i class="fa-regular fa-file-excel">&nbsp;&nbsp;</i>Xuất Excel</button>
                <br>
                <br>
                <table class="table table-hover" border="1px solid black" style="width: 90%; margin-left: 70px;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Nhân Viên</th>
                            <th>Tên Nhân Viên</th>
                            <th>Giới Tính</th>
                            <th>Ngày Sinh</th>
                            <th>Địa Chỉ</th>
                            <th>Số Điện thoại</th>
                            <th>Chức Năng</th>
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
                                    <td><?php echo $row['MaNhanVien'] ?></td>
                                    <td><?php echo $row['TenNhanVien'] ?></td>
                                    <td><?php echo $row['GioiTinh'] ?></td>
                                    <td><?php echo $row['NgaySinh'] ?></td>
                                    <td><?php echo $row['DiaChi'] ?></td>
                                    <td><?php echo $row['SoDienThoai'] ?></td>
                                    <td style="width: 200px;">

                                        <a href="http://localhost/QuanLyKyTucXa_new/DsNhanVien/loadForm/<?php echo $row['MaNhanVien'] ?>" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square">&nbsp;&nbsp;</i>Sửa</a> &nbsp;
                                        <a onclick="return confirm('Bạn có muốn xóa nhân viên này không ?')" href="http://localhost/QuanLyKyTucXa_new/DsNhanVien/Delete/<?php echo $row['MaNhanVien'] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash">&nbsp;&nbsp;</i>Xóa</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">THÊM NHÂN VIÊN</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mã Nhân Viên :</label>
                        <input type="text" class="form-control" placeholder="Nhập mã" name="txtMaNv" require>
                        <label>Họ và Tên :</label>
                        <input type="text" class="form-control" placeholder="Nhập họ tên" name="txtTenNv" require>
                        <label>Giới tính:</label>
                        <select class="form-control" name="txtGioiTinh">
                            <option>--- Chọn giới tính ---</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                        <label>Ngày Sinh :</label>
                        <input type="date" class="form-control" placeholder="Chọn ngày sinh" name="txtNgaySinh">
                        <label>Địa Chỉ :</label>
                        <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="txtDiaChi">
                        <label>Số Điện Thoại :</label>
                        <input type="number" class="form-control" placeholder="Nhập số điện thoại" name="txtSdt" require>
                        <label>Mã Tòa :</label>
                        <!-- <input type="text" class="form-control" placeholder="Nhập phân khu" name="txtMaToa" require> -->
                         <select name="txtMaToa" id="" require class="form-control">
                            <option value="">--- Chọn mã tòa ---</option>
                            <?php
                            if(isset($data['matoa']) && mysqli_num_rows($data['matoa']) > 0){
                                while($matoa = mysqli_fetch_array($data['matoa'])){
                                    ?>
                                    <option value="<?php echo $matoa['maToa']?>"><?php echo $matoa['maToa']?></option>
                                    <?php
                                }
                            }
                            ?>
                         </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" name="btnLuu">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <!-- Modal choose file Excel -->
    <form action="http://localhost/QuanLyKyTucXa_new/DsNhanVien/ImportExcel" method="post" enctype="multipart/form-data">
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