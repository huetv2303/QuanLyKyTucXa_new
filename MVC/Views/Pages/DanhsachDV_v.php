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
        <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachDV/themmoi" id="addServiceForm">
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
                                <button type="submit" class="btn btn-success" name="btnLuuDV" onclick="validateForm()">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Sửa -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachDV/suadl">
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
                                <input type="text" class="form-control" name="txtMaDV" id="txtMaDV" value="" readonly>
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
        <form action="http://localhost/QuanLyKyTucXa_new//DanhsachDV/import" enctype="multipart/form-data" method="post">

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nhập Excel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <td class="dv">
                                <div class="file">
                                    <input type="file" class="btn btn-outline-primary" name="txtfile">
                                    <button type="submit" class="btn btn-success" name="btnUpLoad">Lưu</button>
                                </div>
                            </td>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <!-- Tìm kiếm -->
        <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachDV/timkiem">
            <div style="padding: 40px 40px;" class="form-inline">
                <div class="head_timkiem">
                    <div>
                        <label style="width: 100px;">Mã dịch vụ</label>
                        <input placeholder="Tìm mã dịch vụ" type="text" id="txtMaDV" class="form-control" name="txtMaDV" value="<?php echo isset($_POST['txtMaDV']) ? htmlspecialchars($_POST['txtMaDV']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Tên dịch vụ</label>
                        <input placeholder="Tìm tên dịch vụ" type="text" id="txtTenDV" class="form-control" name="txtTenDV" value="<?php echo isset($_POST['txtTenDV']) ? htmlspecialchars($_POST['txtTenDV']) : ''; ?>">
                    </div>
                    <div>
                        <button type="submit" style="margin: 24px 0px;" class="btn btn-success" name="btnTimKiem" id="btnTimKiem"><i class="fa-solid fa-magnifying-glass">&nbsp;&nbsp;</i>Tìm Kiếm </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> Nhập excel</button>
                        <a href="http://localhost/QuanLyKyTucXa_new/DanhsachDV" style="margin: 24px 0px" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
                    </div>
                </div>

                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal"> <i class="fa-solid fa-plus"></i> Thêm mới </button>


                <table class="table table-striped table-hover">
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
                                    <td><?php echo htmlspecialchars(($data['page_number'] - 1) * $data['limit'] + $i) ?></td>
                                    <td><?php echo htmlspecialchars($row['id_service']) ?></td>
                                    <td><?php echo htmlspecialchars($row['name_service']) ?></td>
                                    <td><?php echo htmlspecialchars($row['price']) ?></td>
                                    <td><?php echo htmlspecialchars($row['unit']) ?></td>
                                    <td><?php echo htmlspecialchars($row['note']) ?></td>
                                    <td>
                                        <button onclick="updateDataDV('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i  class="fa-solid fa-pen-to-square"></i></button>
                                        <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new//DanhsachDV/xoa/<?php echo $row['id_service'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                        <!-- <a href="http://localhost/QuanLyKyTucXa_new//DanhsachDV/sua/" onclick="updateData('<?php echo htmlspecialchars(json_encode($row)) ?>')" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal"><i style="color: green; background: white;" class="fa-solid fa-pen-to-square"></i></a> -->
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>

                    </tbody>

                </table>
            </div>


        </form>
        <?php
        if (isset($_POST['btnTimKiem'])) {
        } else {

        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php if ($data['page_number'] <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($data['page_number'] > 1) echo "?page=" . ($data['page_number'] - 1);
                                                    else echo '#'; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $data['total_page']; $i++) { ?>
                        <li style="padding: 0px;" class="page-item <?php if ($data['page_number'] == $i) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo ($i); ?>"><?php echo ($i); ?></a>
                        </li>
                    <?php } ?>
                    <li style="padding: 0px;" class="page-item <?php if ($data['page_number'] >= $data['total_page']) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($data['page_number'] < $data['total_page']) echo "?page=" . ($data['page_number'] + 1);
                                                    else echo '#'; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
        }
        ?>

    </div>
</body>


</html>