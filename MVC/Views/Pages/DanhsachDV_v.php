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



        </div>
        <!-- Thêm mới -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DachsachDV/themmoi" id="addServiceForm">
            <!-- Modal -->
            <div class="modal-add">
                <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addServiceModalLabel">Thêm dịch vụ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <h4>Thêm dịch vụ</h4>

                                    <label for="txtMaDV">Mã dịch vụ</label>
                                    <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaDV" id="txtMaDV1" required>
                                    <span class="error-message" id="errorTxtMaDV"></span>
                                    <br>

                                    <label for="txtTenDV">Tên dịch vụ</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên dịch" name="txtTenDV" id="txtTenDV1" required>
                                    <span class="error-message" id="errorTxtTenDV"></span>
                                    <br>
                                    <label for="txtGia">Giá</label>
                                    <input type="text" class="form-control" placeholder="Nhập giá" name="txtGia" id="txtGia1" required>
                                    <span class="error-message" id="errorTxtGia"></span>
                                    <br>
                                    <label for="txtDonVi">Đơn vị</label>
                                    <input type="text" class="form-control" placeholder="Nhập đơn vị" name="txtDonVi" id="txtDonVi1" required>
                                    <span class="error-message" id="errorTxtDonVi"></span>
                                    <br>
                                    <label for="txtGhiChu">Ghi chú</label>
                                    <input type="text" class="form-control" placeholder="Nhập ghi chú" name="txtGhiChu" id="txtGhiChu1">
                                    <span class="error-message" id="errorTxtGhiChu"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnLuuDV" onclick="validateForm()">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Sửa -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachDV/suadl">
            <!-- Modal -->
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa dịch vụ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã dịch vụ</label>
                                <input type="text" class="form-control" name="txtMaDV" id="txtMaDV" value="" disabled>
                                <label>Tên dịch vụ</label>
                                <input type="text" class="form-control" name="txtTenDV" id="txtTenDV" value="">
                                <label>Giá</label>
                                <input type="text" class="form-control" name="txtGia" id="txtGia" value="">
                                <label>Đơn vị</label>
                                <input type="text" class="form-control" name="txtDonVi" id="txtDonVi" value="">
                                <label>Ghi chú</label>
                                <input type="text" class="form-control" name="txtGhiChu" id="txtGhiChu" value="">
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

        <!-- Nhập excel -->
        <form action="http://localhost/QuanLyKyTucXa_new/DanhsachDV/import" enctype="multipart/form-data" method="post">
            <label for="myFile2"></label>
            <table>
                <tr>
                    <td class="dv">
                        <div class="file">
                            <input type="file" class="btn btn-outline-primary" name="txtfile">
                            <button type="submit" class="btn btn-primary" name="btnUpLoad">Lưu</button>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Thêm mới </button>
                    </td>
                </tr>
            </table>
        </form>

        <!-- Tìm kiếm -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachDV/timkiem">
            <div class="form-inline">
                <table>
                    <tr>
                        <td>
                            <label style="width: 100px;">Mã dịch vụ</label>
                            <input placeholder="Nhập mã nhân viên" type="text" id="txtMaDV" class="form-control" name="txtMaDV" value="<?php if (isset($data['id_service'])) echo $data['id_service'] ?>">
                        </td>

                        <td>
                            <label style="width: 100px;">Tên dịch vụ</label>
                            <input placeholder="Nhập tên nhân viên" type="text" id="txtTenDV" class="form-control" name="txtTenDV" value="<?php if (isset($data['name_service'])) echo $data['name_service'] ?>">
                        </td>
                        <td>
                            <div></div>
                            <button type="submit" class="btn btn-primary" name="btnTimKiem" id="btnTimKiem"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm Kiếm </button>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã dịch vụ</th>
                        <th>Tên dịch vụ</th>
                        <th>Giá</th>
                        <th>Đơn vị</th>
                        <th>Ghi chú</th>
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
                                <td><?php echo htmlspecialchars($row['id_service']) ?></td>
                                <td><?php echo htmlspecialchars($row['name_service']) ?></td>
                                <td><?php echo htmlspecialchars($row['price']) ?></td>
                                <td><?php echo htmlspecialchars($row['unit']) ?></td>
                                <td><?php echo htmlspecialchars($row['note']) ?></td>

                                <td>
                                    <button onclick="updateData('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i style="color: green; background: white;" class="fa-solid fa-pen-to-square"></i></button>
                                    <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new/DanhsachDV/xoa/<?php echo $row['id_service'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                    <!-- <a href="http://localhost/QuanLyKyTucXa_new/DanhsachDV/sua/" onclick="updateData('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i style="color: green; background: white;" class="fa-solid fa-pen-to-square"></i></a> -->
                                </td>

                            </tr>
                    <?php

                        }
                    }
                    ?>
                </tbody>
            </table>
    </div>
</body>
<script>
    function validateForm() {
        var maDV = document.getElementById('txtMaDV1').value;
        var tenDV = document.getElementById('txtTenDV1').value;
        var gia = document.getElementById('txtGia1').value;
        var donVi = document.getElementById('txtDonVi1').value;

        var valid = true;

        if (maDV.trim() === '') {
            document.getElementById('errorTxtMaDV').textContent = 'Mã dịch vụ không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtMaDV').textContent = '';
        }

        if (tenDV.trim() === '') {
            document.getElementById('errorTxtTenDV').textContent = 'Tên dịch vụ không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtTenDV').textContent = '';
        }

        if (gia.trim() === '') {
            document.getElementById('errorTxtGia').textContent = 'Giá không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtGia').textContent = '';
        }

        if (donVi.trim() === '') {
            document.getElementById('errorTxtDonVi').textContent = 'Đơn vị không được để trống';
            valid = false;
        } else {
            document.getElementById('errorTxtDonVi').textContent = '';
        }

        return valid;
    }
</script>

</html>