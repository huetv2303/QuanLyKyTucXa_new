<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dịch vụ</title>

</head>

<body>
    <div class="main">
        <div class="header">
            <h3>Danh sách dịch vụ</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal"> Thêm </button>

            <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/themmoi" id="addInvoiceForm">
                <!-- Modal -->
                <div class="modal-add">
                    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="addServiceModalLabel">Thêm hóa đơn</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="txtMaHD">Mã hóa đơn:</label>
                                        <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaHD" id="txtMaHD1" required>
                                        <span class="error-message" id="errorTxtMaHD"></span>
                                        <br>

                                        <label for="txtMaPhong">Chọn mã phòng:</label>
                                        <select name="txtMaPhong" class="form-control" id="txtMaPhong1" required>
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['dulieu1'])) {
                                            ?>
                                                    <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="error-message" id="errorTxtMaPhong"></span>
                                        <br>

                                        <label for="txtDien">Điện:</label>
                                        <input type="number" class="form-control" placeholder="Nhập giá" name="txtDien" id="txtDien1" required>
                                        <span class="error-message" id="errorTxtDien"></span>
                                        <br>

                                        <label for="txtNuoc">Nước:</label>
                                        <input type="number" class="form-control" placeholder="Nhập đơn vị" name="txtNuoc" id="txtNuoc1" required>
                                        <span class="error-message" id="errorTxtNuoc"></span>
                                        <br>

                                        <label for="txtNgayTao">Ngày tạo:</label>
                                        <input type="date" class="form-control" name="txtNgayTao" id="txtNgayTao1" required>
                                        <span class="error-message" id="errorTxtNgayTao"></span>
                                        <br>

                                        <label for="txtNgayKT">Hạn nộp:</label>
                                        <input type="date" class="form-control" name="txtNgayKT" id="txtNgayKT1">
                                        <span class="error-message" id="errorTxtNgayKT"></span>
                                        <br>

                                        <label for="txtTrangThai">Trạng thái:</label>
                                        <!-- <input type="text" class="form-control" placeholder="Nhập trạng thái" name="txtTrangThai" id="txtTrangThai1" required>
                                        <span class="error-message" id="errorTxtTrangThai"></span> -->

                                        <select name="txtTrangThai" class="form-control" id="txtTrangThai1" required>
                                            <option value="">------Chọn------</option>
                                            <option value="Đã thanh toán">Đã thanh toán</option>
                                            <option value="Chưa thanh toán">Chưa thanh toán</option>
                                        </select>
                                        <span class="error-message" id="errorTxtTrangThai"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnLuu" onclick="validateForm()">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/suadl">
            <!-- Modal -->
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa hóa đơn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã hóa đơn:</label>
                                <input type="text" class="form-control" name="txtMaHD" id="txtMaHD" value="" readonly>
                                <label>Mã phòng</label>
                                <select name="txtMaPhong" class="form-control" id="txtMaPhong">
                                    <?php
                                    if (isset($data['dulieu3']) && mysqli_num_rows($data['dulieu3']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['dulieu3'])) {
                                    ?>
                                            <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <label>Điện</label>
                                <input type="number" class="form-control" name="txtDien" id="txtDien" value="">
                                <label>Nước</label>
                                <input type="number" class="form-control" name="txtNuoc" id="txtNuoc" value="">
                                <label>Ngày tạo</label>
                                <input type="date" class="form-control" name="txtNgayTao" id="txtNgayTao" value="">
                                <label>Hạn nộp</label>
                                <input type="date" class="form-control" name="txtNgayKT" id="txtNgayKT" value="">
                                <label>Trạng thái</label>
                                <select name="txtTrangThai" class="form-control" id="txtTrangThai" required>
                                    <option value="Đã thanh toán">Đã thanh toán</option>
                                    <option value="Chưa thanh toán">Chưa thanh toán</option>
                                    <option value="Nợ">Nợ</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="btnLuu" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--Hóa đơn  -->
        <form action="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/timkiem" method="POST">
            <div class="modal fade" id="ExPortModal" tabindex="-1" aria-labelledby="ExPortModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ExPortModalLabel">Hóa đơn dịch vụ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body mx-4">
                                    <div class="container">
                                        <div class="row">
                                            <ul class="list-unstyled">
                                                <li class="text-black" id="MaPhong"></li>
                                                <li class="text-muted mt-1" id="MaHD"><span class="text-black"></li>
                                                <input type="hidden" name="MaPhong1" id="MaPhong1" value="">
                                                <input type="hidden" name="MaHD1" id="MaHD1" value="">
                                            </ul>
                                            <hr>
                                            <div class="col-xl-10">
                                                <p style="margin: 0;">Số Điện</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="Dien"><span>kWh</span></p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Số Nước</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="Nuoc"></p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Tổng điện nước</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TongDN"></p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Tổng dịch vụ khác</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TongDV"></p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Trạng thái</p>
                                            </div>
                                            <div class="col-xl-12">
                                                <p class="float-end" id="TrangThai"></p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
                                        <div class="row text-black">
                                            <div class="col-x1-12">
                                                <p class="float-end fw-bold" id="Tong">Total:</p>
                                            </div>
                                            <hr style="border: 2px solid black;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" name="btnXuat"><i class="fa-solid fa-file-invoice"></i> In hóa đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/timkiem">
            <div class="form-inline">
                <div class="head_timkiem">
                    <div>
                        <label style="width: 100px;">Mã hóa đơn</label>
                        <input type="text" placeholder="Tìm mã dịch vụ" class="form-control" name="txtMaHD" value="<?php echo isset($_POST['txtMaHD']) ? htmlspecialchars($_POST['txtMaHD']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Mã phòng</label>
                        <input type="text" placeholder="Tìm tên dịch vụ" class="form-control" name="txtMaPhong" value="<?php echo isset($_POST['txtMaPhong']) ? htmlspecialchars($_POST['txtMaPhong']) : ''; ?>">

                    </div>
                    <div>
                        <button type="submit" style="margin: 24px 0px" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button>
                    </div>
                </div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã hóa đơn</th>
                                <th>Mã phòng</th>
                                <th>Tổng điện nước</th>
                                <th>Tổng dịch vụ khác</th>
                                <th>Tổng</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                                while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($i++) ?></td>
                                        <td><?php echo htmlspecialchars($row['id_invoice']) ?></td>
                                        <td><?php echo htmlspecialchars($row['id_room']) ?></td>
                                        <td style="display:none;"><?php echo htmlspecialchars($row['electricity']) ?></td>
                                        <td style="display:none;"><?php echo htmlspecialchars($row['water']) ?></td>
                                        <td style="display:none;"><?php echo htmlspecialchars($row['created_day']) ?></td>
                                        <td style="display:none;"><?php echo htmlspecialchars($row['ended_day']) ?></td>
                                        <td><?php echo htmlspecialchars($row['tong_dien_nuoc']) ?></td>
                                        <td><?php echo htmlspecialchars($row['tong_dich_vu_khac']) ?></td>
                                        <td><?php echo htmlspecialchars($row['tong_tat_ca']) ?></td>
                                        <td><?php echo htmlspecialchars($row['status']) ?></td>
                                        <td>
                                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExPortModal" onclick="updateDataExportHDDV('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-solid fa-file-invoice"></i></a>
                                            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal" onclick="updateDataHDDV('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new/DanhsachHDDV/xoa/<?php echo $row['id_invoice'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </form>
    </div>

</body>
<script>
    function validateForm() {
        var maHD = document.getElementById('txtMaHD1').value;
        var maPhong = document.getElementById('txtMaPhong1').value;
        var dien = document.getElementById('txtDien1').value;
        var nuoc = document.getElementById('txtNuoc1').value;
        var ngayTao = document.getElementById('txtNgayTao1').value;
        var trangThai = document.getElementById('txtTrangThai1').value;

        var valid = true;

        if (maHD.trim() === '') {
            document.getElementById('errorTxtMaHD').textContent = 'Mã hóa đơn không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtMaHD').textContent = '';
        }

        if (maPhong.trim() === '') {
            document.getElementById('errorTxtMaPhong').textContent = 'Vui lòng chọn mã phòng';
            valid = false;
        } else {
            document.getElementById('errorTxtMaPhong').textContent = '';
        }

        if (dien.trim() === '' || isNaN(dien) || parseInt(dien) < 0) {
            document.getElementById('errorTxtDien').textContent = 'Giá trị điện không hợp lệ';
            valid = false;
        } else {
            document.getElementById('errorTxtDien').textContent = '';
        }

        if (nuoc.trim() === '' || isNaN(nuoc) || parseInt(nuoc) < 0) {
            document.getElementById('errorTxtNuoc').textContent = 'Giá trị nước không hợp lệ';
            valid = false;
        } else {
            document.getElementById('errorTxtNuoc').textContent = '';
        }

        if (ngayTao.trim() === '') {
            document.getElementById('errorTxtNgayTao').textContent = 'Ngày tạo không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtNgayTao').textContent = '';
        }


        if (trangThai.trim() === '') {
            document.getElementById('errorTxtTrangThai').textContent = 'Trạng thái không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtTrangThai').textContent = '';
        }

        return valid;
    }
</script>

</html>