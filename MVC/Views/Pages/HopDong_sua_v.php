<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hợp đồng mới</title>
    <style>
        .lable_tb {
            width: 200px;
        }

        .input_tb {
            width: 350px;
        }

        .dd1 {
            margin-left: 100px;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="content">
        <br>
        <a style="margin: 20px;" class="text-black content1" href="http://localhost:9090/QuanLyKyTucXa_new/HopDong">
            << Quay lại</a>
                <br>
                <div class="header">
                    <h3>Sửa hợp đồng</h3>
                </div>
                <form class = "content1" action="http://localhost:9090/QuanLyKyTucXa_new/HopDong/suadl" method="post">
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        while ($row = mysqli_fetch_array($data['dulieu'])) {
                    ?>
                            <table>
                                <tr>
                                    <td class="lable_tb">
                                        <label for="mhd" class="form-label">Mã hợp đồng:</label>
                                    </td>
                                    <td class="input_tb">
                                        <input readonly style="width:700px" type="text" name="txtMaHopDong" class="form-control" id="mhd" value="<?php echo $row['maHopDong'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="nhanvien" class="form-label">Mã nhân viên:</label></td>
                                    <td>
                                        <select required style="width:700px" class="input_tb form-select" name="txtMaNhanVien" id="nhanvien" value="<?php echo $row['ManNhanVien'] ?>">
                                            <option value="">-----Chọn nhân viên-----</option>
                                            <?php
                                            if (isset($data['nhanvien']) && mysqli_num_rows($data['nhanvien']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['nhanvien'])) {
                                            ?>
                                                    <option value="<?php echo $c['MaNhanVien'] ?>" <?php if ($c['MaNhanVien'] == $row['maNhanVien']) echo "selected"; ?>>
                                                        <?php echo $c['TenNhanVien']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="sinhvien" class="form-label">Mã sinh viên:</label></td>
                                    <td>
                                        <select required style="width:700px" class="input_tb form-select" name="txtMaSinhVien" id="sinhvien">
                                            <option value="">-----Chọn sinh viên-----</option>
                                            <?php
                                            if (isset($data['sinhvien']) && mysqli_num_rows($data['sinhvien']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['sinhvien'])) {
                                            ?>
                                                    <option value="<?php echo $c['maSinhVien'] ?>" <?php if ($c['maSinhVien'] == $row['maSinhVien']) echo "selected"; ?>><?php echo $c['hoTen'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="phong" class="form-label">Mã phòng:</label></td>
                                    <td>
                                        <select required style="width:700px" class="input_tb form-select" name="txtMaPhong" id="phong">
                                            <option value="">-----Chọn phòng-----</option>
                                            
                                            <?php
                                            if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                                                while ($c = mysqli_fetch_assoc($data['phong'])) {
                                            ?>
                                                    <option value="<?php echo $c['maPhong'] ?>" <?php if ($c['maPhong'] == $row['maPhong']) echo "selected"; ?>><?php echo $c['maPhong'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="nbd" class="form-label">Ngày bắt đầu:</label></td>
                                    <td><input required type="date" name="txtNgayBatDau" class="form-control" id="nbd" value="<?php echo $row['ngayBatDau'] ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="nkt" class="form-label">Ngày kết thúc:</label></td>
                                    <td><input required type="date" name="txtNgayKetThuc" class="form-control" id="nkt" value="<?php echo $row['ngayKetThuc'] ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="ttp" class="form-label">Tình trạng phòng:</label></td>
                                    <td><select required style="width:700px" class="input_tb form-select" name="txtTinhTrang" id="">
                                        <option value="Còn hạn" <?php if ($row['tinhTrang'] == "Còn hạn") echo "selected";?>>Còn hạn</option>
                                        <option value="Hết hạn" <?php if ($row['tinhTrang'] == "Hết hạn") echo "selected";?>>Hết hạn</option>
                                    </select></td>
                                    
                                </tr>
                        <?php
                        }
                    }
                        ?>
                        <tr>
                            <td colspan="2"><input type="submit" class="btn btn-primary" name="btnLuu" value="Sửa"></td>
                        </tr>
                            </table>
                </form>
    </div>
</div>
</body>

</html>