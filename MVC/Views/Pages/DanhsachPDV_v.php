<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dịch vụ</title>
</head>
<style>
    /* .modal-body input  {
        border-block-end-color: black;
    }

    .modal-body select  {
        border-block-end-color: black;
    } */
</style>

<body>
    <div class="main">
        <div class="header">
            <h3>Đăng ký dịch vụ</h3>
            <!-- Button trigger modal -->

            <!-- Modal -->
            <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachPDV/themmoi">

                <div class="modal-add">
                    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addServiceModalLabel">Đăng ký dịch vụ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <!-- <label>Mã Phòng</label>
                                            <input type="text" class="form-control" placeholder="Nhập mã dịch vụ" name="txtMaPhong" > -->
                                        <label>Mã tòa</label>
                                        <select name="txtMaToa" class="form-control maToa" id="maToa" required>
                                            <option value="">-------Chọn--------</option>
                                            <?php
                                            if (isset($data['toa']) && mysqli_num_rows($data['toa']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['toa'])) {
                                            ?>
                                                    <option value="<?php echo $c['maToa'] ?>"><?php echo $c['maToa'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                        <label>Mã phòng</label>
                                        <select name="txtMaPhong" class="form-control maPhong" id="maPhong" required>
                                            <option value="">-------Chọn--------</option>
                                        </select>

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

                                        <table>
                                            <thead>
                                                <td>Tháng</td>
                                                <td>
                                                    <p style="margin-left: 20px;">Năm</p>
                                                </td>
                                            </thead>

                                            <tbody>
                                                <td><input type="text" placeholder="Nhập tháng" class="form-control" name="txtThang" required></td>
                                                <!-- <td> <select name="" id="" class="form-control">
                                                        <option value="">------Chọn-------</option>
                                                        <?php
                                                        for ($t = 1; $t <= 12; $t++) {
                                                        ?>
                                                            <option value="<?php echo $t ?>"><?php echo $t ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td> -->
                                                <td><input style="margin-left: 20px; width: 225px;" type="text" placeholder="Nhập năm" class="form-control" name="txtNam" required></td>
                                            </tbody>
                                        </table>
                                        <br>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="btnLuu" onclick="VadlidateForm()">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <form method="post" action="http://localhost/QuanLyKyTucXa_new//DanhsachPDV/suadl">
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
                                <label>Mã tòa</label>
                                <select name="txtMaToa" class="form-control maToa" id="txtMaToa" required>
                                    <option value="">-------Chọn--------</option>
                                    <?php
                                    if (isset($data['toa1']) && mysqli_num_rows($data['toa1']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['toa1'])) {
                                    ?>
                                            <option value="<?php echo $c['maToa'] ?>"><?php echo $c['maToa'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <label>Mã phòng</label>
                                <select type name="txtMaPhong" class="form-control maPhong" id="txtMaPhong" required>
                                    <?php
                                    if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                                        while ($c = mysqli_fetch_assoc($data['phong'])) {
                                    ?>
                                            <option value="<?php echo $c['maPhong'] ?>"><?php echo $c['maPhong'] ?></option>
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
                                <table>
                                    <thead>
                                        <td>Tháng</td>
                                        <td>
                                            <p style="margin-left: 20px;">Năm</p>
                                        </td>
                                    </thead>

                                    <tbody>
                                        <td><input type="text" class="form-control" name="txtThang" id="txtThang" required></td>
                                        <td><input style="margin-left: 20px;  width: 225px;" type="text" class="form-control" name="txtNam" id="txtNam" required></td>
                                    </tbody>
                                </table>
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
                        <label style="width: 100px;">Mã dịch vụ</label>
                        <input type="text" placeholder="Tìm mã dịch vụ" class="form-control" name="txtMaDV" value="<?php echo isset($_POST['txtMaDV']) ? htmlspecialchars($_POST['txtMaDV']) : ''; ?>">
                    </div>
                    <div>
                        <label style="width: 100px;">Mã phòng</label>
                        <input type="text" placeholder="Tìm mã phòng" class="form-control" name="txtMaPhong" value="<?php echo isset($_POST['txtMaPhong']) ? htmlspecialchars($_POST['txtMaPhong']) : ''; ?>">

                    </div>
                    <div>
                        <label style="width: 50px;">Tháng</label>
                        <input style="width: 50px;" type="text" placeholder="Tìm tháng" class="form-control" name="txtThang" value="<?php echo isset($_POST['txtThang']) ? htmlspecialchars($_POST['txtThang']) : ''; ?>">
                        <!-- <select name="txtThang" id="" class="form-control">
                            <option value="">------Chọn-------</option>
                            <?php
                            for ($t = 1; $t <= 12; $t++) {
                            ?>
                                <option value="<?php echo $t ?>" <?php echo isset($_POST['txtThang']) && $_POST['txtThang'] ==  $t ? 'selected' : ''; ?>><?php echo $t ?></option>
                            <?php
                            }
                            ?>
                        </select> -->

                    </div>
                    <div>
                        <label style="width: 50px;">Năm</label>
                        <input style="width: 80px;" type="text" placeholder="Tìm năm" class="form-control" name="txtNam" value="<?php echo isset($_POST['txtNam']) ? htmlspecialchars($_POST['txtNam']) : ''; ?>">

                    </div>
                    <div>
                        <button type="submit" style="margin: 24px 0px" class="btn btn-success" name="btnTimKiem">Tìm kiếm</button>
                        <a href="http://localhost/QuanLyKyTucXa_new/DanhsachPDV" style="margin: 24px 0px" class="btn btn-success" name="btnReLoad"><i class="fa-solid fa-rotate-right"></i> Reload</a>
                    </div>
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal"> <i class="fa-solid fa-plus"></i> Thêm mới </button>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã Tòa</th>
                            <th>Mã phòng</th>
                            <th>Mã dịch vụ</th>
                            <th>Tháng</th>
                            <th>Năm</th>
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
                                <td><?php echo htmlspecialchars($row['maToa']) ?></td>
                                <td><?php echo htmlspecialchars($row['id_room']) ?></td>
                                <td><?php echo htmlspecialchars($row['id_service']) ?></td>
                                <td><?php echo htmlspecialchars($row['month']) ?></td>
                                <td><?php echo htmlspecialchars($row['year']) ?></td>
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
</body>

<script>
    $(document).ready(function() {
        $('.maToa').change(function() {
            var maToa = $(this).val();
            if (maToa != '') {
                $.ajax({
                    url: 'http://localhost/QuanLyKyTucXa_new/DanhsachPDV/get_phong_by_toa_hopdong',
                    method: 'POST',
                    data: {
                        maToa: maToa
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.maPhong').html('<option value="">-------Chọn--------</option>');
                        $.each(data, function(index, room) {
                            $('.maPhong').append('<option value="' + room.maPhong + '">' + room.maPhong + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            } else {
                $('.maPhong').html('<option value="">-------Chọn--------</option>');
            }
        });
    });
</script>

</html>