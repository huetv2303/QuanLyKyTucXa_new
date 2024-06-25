
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="http://localhost/QuanLyKyTucXa_new/Public/JS/DichVu_js.js"> </script> -->
    <title>Quản lý dịch vụ</title>
</head>

<body>
    <div class="main">
        <div class="header">
            <h3>Đăng ký dịch vụ</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal"> Thêm </button>

            <!-- Modal -->
            <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPDV/themmoi">

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
                                        <!-- <label>Mã Phòng</label>
                                            <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaPhong" > -->
                                        <label>Chọn mã phòng</label>
                                        <select name="txtMaPhong" class="form-control" id="txtMaPhong1" required>
                                            <option value="">-------Chọn--------</option>
                                            <?php

                                            if (isset($data['dulieu2']) && mysqli_num_rows($data['dulieu2']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['dulieu2'])) {
                                            ?>
                                                    <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="error-message" id="errorTxtMaPhong"></span>
                                        <br>
                                        <!-- <label>Mã dịch vụ</label>
                                            <input type="text" class="form-control" placeholder="Nhập tên dịch" name="txtMaDV" > -->
                                        <label>Chọn dịch vụ</label>
                                        <select name="txtMaDV" class="form-control" id="txtMaDV1" required>
                                            <option value="">-------Chọn--------</option>
                                            <?php

                                            if (isset($data['dulieu1']) && mysqli_num_rows($data['dulieu1']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['dulieu1'])) {
                                            ?>
                                                    <option value="<?php echo $c['id_service'] ?>"><?php echo $c['name_service'] ?></option>
                                            <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                        <span class="error-message" id="errorTxtMaDV"></span>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="btnLuu" onclick="VadlidateForm()">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPDV/suadl">
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
                                <label>ID</label>
                                <input type="text" class="form-control" name="txtID" id="txtID" value="" readonly>
                                <label>Mã phòng</label>
                                <select name="txtMaPhong" class="form-control" id="txtMaPhong">
                                    <?php

                                    if (isset($data['dulieu4']) && mysqli_num_rows($data['dulieu4']) > 0) {
                                        while ($row = mysqli_fetch_assoc($data['dulieu4'])) {
                                    ?>
                                            <option value="<?php echo $row['maPhong'] ?>"><?php echo $row['maPhong'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <label>Dịch vụ</label>
                                <select name="txtMaDV" class="form-control" id="txtMaDV">
                                    <?php

                                    if (isset($data['dulieu3']) && mysqli_num_rows($data['dulieu3']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['dulieu3'])) {
                                    ?>
                                            <option value="<?php echo $c['id_service'] ?>"><?php echo $c['name_service'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
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
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPDV/timkiem">
            <div class="form-inline">
                <div class="head_timkiem">
                    <div>
                        <label style="width: 100px;">Mã phòng</label>
                        <input type="text" name="txtMaPhong" placeholder="Mã Phòng" class="form-control" value="<?php echo isset($_POST['txtMaPhong']) ? htmlspecialchars($_POST['txtMaPhong']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Mã dịch vụ</label>
                        <input type="text" name="txtMaDV" placeholder="Mã Dịch Vụ" class="form-control" value="<?php echo isset($_POST['txtMaDV']) ? htmlspecialchars($_POST['txtMaDV']) : ''; ?>">
                    </div>
                    <div>
                        <button type="submit" style="margin: 24px 0px;" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã phòng</th>
                            <th>Mã dịch vụ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']) ?></td>
                                <td><?php echo htmlspecialchars($row['id_room']) ?></td>
                                <td><?php echo htmlspecialchars($row['id_service']) ?></td>
                                <td>

                                    <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal" onclick="updateDataPDV('<?php echo htmlspecialchars(json_encode($row)) ?>')"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa dịch vụ này không?');" href="http://localhost/QuanLyKyTucXa_new/DanhsachPDV/xoa/<?php echo $row['id'] ?>" class="btn btn-outline-danger"><i style="color: red;" class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>
                        <?php
                        }
                        // }
                        ?>
                    </tbody>
                </table>
            </div>
</body>
<script>
    function VadlidateForm() {
        var id_room = document.getElementById('txtMaPhong1').value;
        var id_service = document.getElementById('txtMaDV1').value;

        var valid = true;

        if (id_room.trim() === '') {
            document.getElementById('errorTxtMaPhong').textContent = 'Vui lòng chọn mã phòng';
            valid = false;
        } else {
            document.getElementById('errorTxtMaPhong').textContent = '';
        }

        if (id_service.trim() === '') {
            document.getElementById('errorTxtMaDV').textContent = 'Vui lòng chọn dịch vụ';
            valid = false;
        } else {
            document.getElementById('errorTxtMaPhong').textContent = '';
        }

        return valid;
    }
</script>

</html>
