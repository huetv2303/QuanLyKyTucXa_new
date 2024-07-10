<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <form method="post" action="http://localhost/QuanLyKyTucXa_new/DanhsachSV/suadl">
        <div id="wrapper" style="height: -webkit-fill-available; padding-top: 10px;">
            <!-- <div class="header" style="color: #08449b">
                <h2>Sửa thông tin sinh viên</h2>
            </div> -->

            <div class="form-inline" style="width: 60%; margin-left: 220px; text-align: left;">
            <h2>Sửa thông tin sinh viên</h2>
                <?php
                if (isset($data['dulieu'])) {
                    if (mysqli_num_rows($data['dulieu']) > 0) {
                        while ($row = mysqli_fetch_array($data['dulieu'])) {
                ?>

                            <label>Mã sinh viên</label>
                            <input type="text" class="form-control dd1" name="txtMaSinhVien" readonly style="background-color: #0606063d" value="<?php echo $row['maSinhVien']; ?>">

                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ tên" name="txtHoTen" required value="<?php echo $row['hoTen']; ?>">

                            <!-- <label>Mã tòa</label>
                            <input type="text" class="form-control dd1"  name="txtMaToa" readonly style="background-color: #0606063d" value="<?php echo $row['maToa']; ?>">

                            <label>Mã phòng</label>
                            <input type="text" class="form-control dd1"  name="txtMaPhong" readonly style="background-color: #0606063d" value="<?php echo $row['maPhong']; ?>"> -->

                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Nhập email" name="txtEmail" required value="<?php echo $row['email']; ?>">

                            <label>Số điện thoại</label>
                            <input type="number" class="form-control" placeholder="Nhập số điện thoại" name="txtSoDienThoai" required value="<?php echo $row['soDienThoai']; ?>">

                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" placeholder="Nhập ngày sinh" name="txtNgaySinh" required value="<?php echo $row['ngaySinh']; ?>">

                            <label>Giới tính</label>
                            <br>
                            <select name="txtGioiTinh" id="" class="form-control" required>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                            <br>

                            <label>CCCD</label>
                            <input type="number" class="form-control" placeholder="Nhập cccd" name="txtCccd" required value="<?php echo $row['cccd']; ?>">

                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="txtDiaChi" required value="<?php echo $row['diaChi']; ?>">


                <?php
                        }
                    } else {
                        echo "<p>Không có dữ liệu sinh viên.</p>";
                    }
                } else {
                    echo "<p>Không có dữ liệu sinh viên.</p>";
                }
                ?>
                <br>
                <button type="submit" class="btn btn-success" name="btnLuu" style="margin-left: 400px;">Cập nhật</button>
            </div>
        </div>
    </form>
</body>

</html>