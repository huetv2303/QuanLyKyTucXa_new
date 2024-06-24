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
            margin-left: 100px
        }
    </style>
</head>

<body>
    <div class="content">

        <a class="text-black" href="http://localhost/qlktx/HopDong">
            << Quay lại</a>
                <br>

                <h2>Thêm mới</h2>
                <form action="http://localhost/qlktx/HopDongThem/them" method="post">
                    <table>
                        <tr>
                            <td class="lable_tb">
                                <label for="mhd" class="form-label">Mã hợp đồng:</label>
                            </td>
                            <td class="input_tb">
                                <input readonly style="width:700px" type="text" name="txtMaHopDong" class="form-control" id="mhd" value = "<?php if(isset($data['maHopDong'])) echo $data['maHopDong']?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nhanvien" class="form-label">Mã nhân viên:</label></td>
                            <td>
                                <select required  style="width:700px" class ="input_tb form-select" name="txtMaNhanVien" id="nhanvien" value = "<?php if(isset($data['manNhanVien'])) echo $data['manNhanVien']?>">
                                    <option value="">-----Chọn nhân viên-----</option>
                                    <?php
                                        if (isset($data['nhanvien']) && mysqli_num_rows($data['nhanvien']) > 0) {
                                            while ($c = mysqli_fetch_assoc($data['nhanvien'])) {
                                        ?>
                                                <option value="<?php echo $c['maNhanVien'] ?>" <?php if(isset($data['maNhanVien']) && ($c['maNhanVien'] == $data['maNhanVien'])) echo "selected"; ?>>
                                                <?php echo $c['tenNhanVien']; ?></option>
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
                                <select required style="width:700px" class ="input_tb form-select" name="txtMaSinhVien" id="sinhvien">
                                <option value="">-----Chọn sinh viên-----</option>
                                    <?php
                                        if (isset($data['sinhvien']) && mysqli_num_rows($data['sinhvien']) > 0) {
                                            while ($c = mysqli_fetch_assoc($data['sinhvien'])) {
                                        ?>
                                                <option value="<?php echo $c['maSinhVien'] ?>" <?php if(isset($data['maSinhVien']) && ($c['maSinhVien'] == $data['maSinhVien'])) echo "selected"; ?>><?php echo $c['hoTen'] ?></option>
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
                                <select required style="width:700px" class ="input_tb form-select" name="txtMaPhong" id="phong">
                                <option value="">-----Chọn phòng-----</option>
                                    <?php
                                        if (isset($data['phong']) && mysqli_num_rows($data['phong']) > 0) {
                                            while ($c = mysqli_fetch_assoc($data['phong'])) {
                                        ?>
                                                <option value="<?php echo $c['maPhong'] ?>" <?php if(isset($data['maPhong']) && ($c['maPhong'] == $data['maPhong'])) echo "selected"; ?>><?php echo $c['maPhong'] ?></option>
                                        <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nbd" class="form-label">Ngày bắt đầu:</label></td>
                            <td><input required type="date" name="txtNgayBatDau" class="form-control" id="nbd" value = "<?php if(isset($data['ngayBatDau'])) echo $data['ngayBatDau']?>"></td>
                        </tr>
                        <tr>
                            <td><label for="nkt" class="form-label">Ngày kết thúc:</label></td>
                            <td><input required type="date" name="txtNgayKetThuc" class="form-control" id="nkt" value = "<?php if(isset($data['ngayKetThuc'])) echo $data['ngayKetThuc']?>"></td>
                        </tr>
                        <tr>
                            <td><label for="ttp" class="form-label">Tình trạng phòng:</label></td>
                            <td><input readonly type="text" name="txtTinhTrang" class="form-control" value="Còn hạn" id="ttp"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" class="btn btn-primary" name="btnLuu" value="Thêm"></td>
                        </tr>
                    </table>
                </form>
    </div>
</body>

</html>