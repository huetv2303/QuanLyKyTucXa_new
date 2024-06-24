<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gia hạn hợp đồng</title>
</head>

<body>
    <div class="main">
        <div>
            <h3 class="header">Danh sách hợp đồng hết hạn</h3>
            <form class="content1" action="http://localhost/QuanLyKyTucXa_new/HopDongGiaHan/timkiem" class="text-center padd" method="post"> <!-- form tìm kiếm -->
                <table class="text-center">
                    <tr>
                        <td>
                            <label class="dd2" for="">Mã hợp đồng</label>
                        </td>
                        <td>
                            <input type="text" name="txtMaHopDong" placeholder="" class="form-control inputSearch" value="<?php if (isset($data['maHopDong'])) echo $data['maHopDong'] ?>">
                        </td>
                        <td>
                            <label for="">Mã nhân viên</label>
                        </td>
                        <td>
                            <input type="text" name="txtMaNhanVien" placeholder="" class="form-control inputSearch" value="<?php if (isset($data['maNhanVien'])) echo $data['maNhanVien'] ?>">
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="">Mã sinh viên</label>
                        </td>
                        <td>
                            <input type="text" name="txtMaSinhVien" placeholder="" class="form-control inputSearch" value="<?php if (isset($data['maSinhVien'])) echo $data['maSinhVien'] ?>">
                        </td>
                        <td>
                            <label for="">Mã phòng</label>
                        </td>
                        <td>
                            <input type="text" name="txtMaPhong" placeholder="" class="form-control inputSearch" value="<?php if (isset($data['maPhong'])) echo $data['maPhong'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="submit" class="btn btn-primary" name="btnTimkiem">Tìm kiếm</button>
                        </td>
                    </tr>
                </table>

            </form>

            <table class="table table-striped">
                <thead>
                    <tr class="thead-light">
                        <th>STT</th>
                        <th>Mã HĐ</th>
                        <th>Mã NV</th>
                        <th>Mã SV</th>
                        <th>Mã phòng</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Tình trạng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0) {
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($data['dulieu'])) {
                    ?>
                            <tr>
                                <td><?php echo (++$i) ?></td>
                                <td><?php echo $row['maHopDong'] ?></td>
                                <td><?php echo $row['maNhanVien'] ?></td>
                                <td><?php echo $row['maSinhVien'] ?></td>
                                <td><?php echo $row['maPhong'] ?></td>
                                <td><?php echo $row['ngayBatDau'] ?></td>
                                <td><?php echo $row['ngayKetThuc'] ?></td>
                                <td><?php echo $row['tinhTrang'] ?></td>
                                <td>
                                    <!-- <a href="">Xóa</a> -->
                                    <a href="http://localhost/QuanLyKyTucXa_new/HopDongGiaHan/giahan/<?php echo $row['maHopDong'] ?>" class="btn btn-outline-success">Gia hạn</a>

                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>