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
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DachsachDV/themmoi">
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

                                    <label>Mã dịch vụ</label>
                                    <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaDV">
                                    <label>Tên dịch vụ</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên dịch" name="txtTenDV">
                                    <label>Giá</label>
                                    <input type="text" class="form-control" placeholder="Nhập giá" name="txtGia">
                                    <label>Đơn vị</label>
                                    <input type="text" class="form-control" placeholder="Nhập đơn vị" name="txtDonVi">
                                    <label>Ghi chú</label>
                                    <input type="text" class="form-control" placeholder="Nhập ghi chú" name="txtGhiChu">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnLuuDV">Lưu</button>
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
                                <input type="text" class="form-control" name="txtMaDV" id="txtMaDV" value="">
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
                            <button style="padding-rigt: 300px" type="submit" class="btn btn-primary" name="btnUpLoad">Lưu</button>
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

</html>