<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<style>
    label{
        margin-left: 300px;
    }
    input, select{
        margin-left: 300px;
    }
    #text{
        width: 500px;
    }
</style>
<body>
    <div class="main">
        <form method="post" action="http://localhost/QuanLyKyTucXa_new/DsNhanVien/Update">
            <div class="form-group">
                <?php
                if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                    while ($row = mysqli_fetch_array($data['dulieu'])) {
                ?>
                        <label style="margin-top: 20px;">Mã nhân viên</label>
                        <input type="text" class="form-control" placeholder="Mã nhân viên" name="txtMaNv" value="<?php echo $row['MaNhanVien'] ?>" readonly id="text">
                        <label>Tên nhân viên</label>
                        <input type="text" class="form-control" placeholder="Tên nhân viên" name="txtTenNv" value="<?php echo $row['TenNhanVien'] ?>" id="text" readonly>
                        <label>Giới tính</label>
                        <select class="form-control" name="cboGioiTinh" id="text">
                            <option value="">---Chọn giới tính---</option>
                            <option value="Nam" <?php if ($row['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if ($row['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                            <option value="Khác" <?php if ($row['GioiTinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
                        </select>
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control" placeholder="Ngày sinh" name="txtNgaySinh" value="<?php echo $row['NgaySinh'] ?>" id="text">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="txtDiaChi" value="<?php echo $row['DiaChi'] ?>" id="text">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="txtSdt" value="<?php echo $row['SoDienThoai'] ?>" id="text">
                        <label>Mã tòa</label>
                        <select name="txtMaToa" class="form-control" id="text">
                            <option value="A" <?php if ($row['maToa'] == 'A') echo 'selected'; ?>>A</option>
                            <option value="B" <?php if ($row['maToa'] == 'B') echo 'selected'; ?>>B</option>
                            <option value="C" <?php if ($row['maToa'] == 'C') echo 'selected'; ?>>C</option>
                        </select>
                <?php
                    }
                }
                ?>
                <br>
                <button type="submit" class="btn btn-primary" name="btnCapNhat" style="margin-left: 300px;">Cập nhật</button>
                <button type="submit" class="btn btn-primary" name="btnBack">Quay lại</button>
            </div>
        </form>
    </div>
</body>

</html>