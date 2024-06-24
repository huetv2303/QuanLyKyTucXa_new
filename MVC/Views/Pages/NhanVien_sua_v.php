<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <form method="post" action="http://localhost/QuanLyKyTucXa_new/DsNhanVien/Update">
        <div class="form-group">
            <?php
            if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                while ($row = mysqli_fetch_array($data['dulieu'])) {
            ?>

                    <label>Mã nhân viên</label>
                    <input type="text" class="form-control" placeholder="Mã nhân viên" name="txtMaNv" value="<?php echo $row['MaNhanVien'] ?>" readonly>
                    <label>Tên nhân viên</label>
                    <input type="text" class="form-control" placeholder="Tên nhân viên" name="txtTenNv" value="<?php echo $row['TenNhanVien'] ?>">
                    <label>Giới tính</label>
                    <select class="form-control" name="cboGioiTinh">
                        <option value="">---Chọn giới tính---</option>
                        <option value="Nam" <?php if ($row['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if ($row['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                        <option value="Khác" <?php if ($row['GioiTinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
                    </select>
                    <label>Ngày sinh</label>
                    <input type="date" class="form-control" placeholder="Ngày sinh" name="txtNgaySinh" value="<?php echo $row['NgaySinh'] ?>">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="Địa chỉ" name="txtDiaChi" value="<?php echo $row['DiaChi'] ?>">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="Số điện thoại" name="txtSdt" value="<?php echo $row['SoDienThoai'] ?>">
                    <label>Mã tòa</label>
                    <input type="text" class="form-control" placeholder="Mã tòa" name="txtMaToa" value="<?php echo $row['maToa'] ?>">
            <?php
                }
            }
            ?>
            <br>
            <button type="submit" class="btn btn-primary" name="btnCapNhat">Cập nhật</button>
        </div>
    </form>
</body>

</html>