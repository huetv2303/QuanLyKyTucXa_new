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
            <h3>Danh sách điện nước</h3>
            <!-- Button trigger modal -->

        </div>
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachDN/suadl">
            <!-- Modal -->
            <div class="modal-update">
                <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editServiceModalLabel">Sửa dịch vụ điện nước</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Mã dịch vụ</label>
                                <input type="text" class="form-control" name="txtMaDV" id="txtMaDV" value="" readonly>
                                <label>Tên dịch vụ</label>
                                <input type="text" class="form-control" name="txtTenDV" id="txtTenDV" value="" readonly>
                                <label>Giá</label>
                                <input type="text" class="form-control" name="txtGia" id="txtGia" value="">
                                <label>Đơn vị</label>
                                <input type="text" class="form-control" name="txtDonVi" id="txtDonVi" value="">
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
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachDN/timkiem">
            <div class="form-inline">
                <!-- <label style="width: 100px;">Mã dịch vụ</label>
            <input type="text" placeholder="Tìm mã dịch vụ" class="form-control" name="txtMaDV" >
            <label style="width: 100px;">Tên dịch vụ</label>
            <input type="text" placeholder="Tìm tên dịch vụ" class="form-control" name="txtTenDV">
            <button type="submit" style="margin: 30px 0px" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button> -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã dịch vụ</th>
                            <th>Tên dịch vụ</th>
                            <th>Giá</th>
                            <th>Đơn vị</th>
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

                                    <td>
                                        <!-- htmlspecialchars dùng để các chuỗi chứa ký tự đặc biệt không gây ra vấn đề bảo mật khi được nhúng vào HTML. -->
                                        <button onclick="updateDataDN('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i class="fa-solid fa-pen-to-square"></i></button>
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

</html>